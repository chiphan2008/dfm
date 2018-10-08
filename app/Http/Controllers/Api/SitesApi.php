<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Company;
use App\Models\Status;
use App\Models\Device;
use App\Models\DeviceData;
use App\Models\DeviceAttachment;
use App\Models\Product;
use App\Models\ProductRent;
use App\Models\ProductType;
use App\Models\ProductStatus;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;


class SitesApi extends Controller
{
    /**
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * @var App\Geolocation\PermissionService;
     */
    protected $permission;

    /**
     * Construct 
     *
     * @param Request $request
     * @param Auth $auth
     * @param PermissionService $permission
     */
    public function __construct(Request $request,  Auth $auth, PermissionService $permission)
    {
        $this->request = $request;
        $this->auth = $auth;   
        $this->permission = $permission;           
    }

    /**
     * Caculator distance between two location
     *
     * @param double $lat1
     * @param double $lng1
     * @param double $lat2
     * @param double $lng2
     * @return double
     */
    protected function distance($lat1, $lng1, $lat2, $lng2) 
    {
        $theta = $lng1 - $lng2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        return ($miles * 1.609344 * 1000); // kilomet -> m
    }

    /**
     * Check equal name two product
     *
     * @param array $product_1
     * @param array $product_2
     * @return bool
     */
    protected function equalName($product_1, $product_2) 
    {
        if ($product_1['name'] != $product_2['name']) 
            return 0;

        return 1;
    }

    /**
     * Check equal format two product
     *
     * @param array $format_1
     * @param array $format_2
     * @return bool
     */
    protected function equalFormat($format_1, $format_2) 
    {
        if ($format_1['value_1'] != $format_2['value_1'])
            return 0;

        if ($format_1['value_2'] != $format_2['value_2']) 
            return 0;

        if ($format_1['value_3'] != $format_2['value_3']) 
            return 0;

        return 1;
    }

    /**
     * Caculator lat lng in data receive
     *
     * @param string $payload_cleartext
     * @return array
     */
    protected function getLatLng($payload_cleartext) 
    {
        //Get lat and lng in data receive
        $ascii = '';
        for($i = 0; $i < strlen($payload_cleartext); $i += 2) {
            $ascii .= chr(hexdec(substr($payload_cleartext, $i, 2)));
        }
        $result = explode(';', $ascii);
        return $result;
    }

    /**
     * Set properties in format
     *
     * @param array $result
     * @param array $valid
     * @param array $data
     * @return void
     */
    protected function setFormatProperties(&$result, $valid, $data) 
    {
        array_push($result['product_match'], $data['product']);
        array_push($result['product_id'], $data['product']->id);

        if ($valid['name'] && $valid['format']) {

            //exists name and format
            $result['n_product'] += 1;
        } else {

            //not exists format or first time setup
            $result['value_1'] = $data['format']['value_1'];
            $result['value_2'] = $data['format']['value_2'];
            $result['value_3'] = $data['format']['value_3'];
            $result['n_product'] = 1;
        }
    }

    /**
     * Check product in Location or not
     *
     * @param object $product
     * @param object $location
     * @return bool
     */
    protected function inLocation($product, $location)
    {
        //check valid product
        if (!isset($product)) return false;

        $device_attach = DeviceAttachment::where('product_id', $product->id)->first();

        //check valid device attach product
        if (!$device_attach) return false;

        $device = Device::where('id', $device_attach->device_id)->first();

        //check exists device by product
        if (!$device) return false;
        $distance = $this->distance($location->lat, $location->lng, $device->lat, $device->lng);
    
        //product in location
        if (0 <= $distance && $distance <= $location->max_radius) return true;
        
        return false;
    }

    /**
     * Operation timeRentProduct
     *
     * @param integer $productId
     * @return integer
     */
    protected function timeRentProductById($productId) 
    {
        $timeRentProduct = 0;

        // Get product
        $product = Product::find($productId);

        if (isset($product)) {
            // Get product rent latest
            $product_rent = ProductRent::where('product_id', $product->id)
                                    ->orderBy('created_at', 'desc')
                                    ->first();

            if (isset($product_rent) && $product_rent->expired_date != null) {

                // time expired
                $expiredDate = strtotime($product_rent->expired_date->format('Y-m-d 23:59:59'));

                // time rent 
                $rentDate = strtotime($product_rent->rent_date->format('Y-m-d 00:00:00'));

                // time transfer
                $transferDate = $product_rent->transfer_numofdate;

                // time (day) rent product
                $timeRentProduct = ($expiredDate - ($rentDate + 86400 * $transferDate + 86400)) / 86400;   

                // Check valid day rent product
                if ($timeRentProduct == 0) $timeRentProduct = 1;
                else if ($timeRentProduct < 0) $timeRentProduct = 0;
            }
        }
        return round($timeRentProduct);
    }

    /**
     * Operation get product, set properties
     *
     * @param object $site
     * @return array
     */
    protected function getProducts($site)
    {
        //get product in company
        $products = Product::where('company_id', $site->company_id)->get();

        if (count($products) <= 0) return [];

        //get time rent all product
        $time_rent = $this->getTimeRent($products);

        if ($time_rent == null 
        || $time_rent['min_date'] == null 
        || $time_rent['max_date'] == null) return [];

        //set product rent and product type
        $productsInCompany = $this->setProductsType($products, $site);
        $productsInCompany = $this->setProductsRent($productsInCompany);

        if (count($productsInCompany) <= 0) return [];

        //range min -> max all products in company
        //return result[[product]]
        $productsInSite = [];

        while (strtotime($time_rent['min_date']) < strtotime($time_rent['max_date'])) {

            //get product in site in a day
            $productsId = $this->getProductsByDay($time_rent['min_date'], $site);
            array_push($productsInSite, $productsId);

            //next day
            $time_rent['min_date']->addHours(24);
        }
        //for each result, calc & update properties
        $productsInCompany = $this->setProperties($productsInCompany, $productsInSite);

        return $productsInCompany;
    }

    /**
     * Operation set properties for all products
     *
     * @param array $pic
     * @param array $listId
     * @return array
     */
    protected function setProperties($pic, $listId) 
    {
        $n_pic = count($pic);
        for ($format = 0; $format < $n_pic; $format++) {

            $chantiertotal_temp = 0;
            $total_value3 = 0;
            $format_pic = $pic[$format]['properties'];
            $n_format_pic = count($format_pic);

            for ($item = 0; $item < $n_format_pic; $item++) {

                $jour_temp = 0;
                $base = $format_pic[$item]['n_product'] * $format_pic[$item]['rent_min_max'];
                $ct = $base > 0 ?  (1 / $base) : 0;
                $n_list = count($listId);
                $n_product_pic = count($format_pic[$item]['product_id']);
                $rent_min_today = $format_pic[$item]['rent_min_today'];

                //for each id in one day
                $n_list = count($listId);
                $iterator = 0;

                foreach ($listId as &$list) {
                    
                    $nb_produit_temp = 0;
                    ++$iterator;

                    foreach($list as $key => $value) {
                        for ($p = 0; $p < $n_product_pic; $p++) {
                            if ($format_pic[$item]['product_id'][$p] == $value) {
                                $nb_produit_temp += 1;

                                //today
                                if ($iterator == $n_list) {
                                    $pic[$format]['properties'][$item]['jour'] += $ct;

                                    //nb_produit
                                    $pic[$format]['properties'][$item]['nb_produit'] += 1;

                                    //products status 
                                    $product = Product::where('id', $value)->first();
                                    $status = $product->product_status_id;

                                    if (!in_array($status, $pic[$format]['alerts']))
                                        array_push($pic[$format]['alerts'], $status);
                                }
                                //remove in list id a day
                                unset($list[$key]); 
                            }
                        } //end one day
                        $jour_temp = $jour_temp + $ct * $nb_produit_temp;
                    }
                    unset($list); //unset reference
                }
                //end all days
                //calc rotation chantier
                $chantier = $rent_min_today > 0 ? ($jour_temp / $rent_min_today) : 0;
                $pic[$format]['properties'][$item]['chantier'] = $chantier;

                //calcrotation chantier total temp
                $value3 = explode(" ", $format_pic[$item]['value_3']);
                $format_m = isset($value3[0]) && isset($value3[1]) ? $value3[0] : 0;

                //calc number m2, ml each format
                if (isset($value3[1])) {
                    if ($value3[1] == "ml") {
                        $pic[$format]['properties'][$item]['ml'] = $value3[0] * $pic[$format]['properties'][$item]['nb_produit'];
                    } else {
                        $pic[$format]['properties'][$item]['m2'] = $value3[0] * $pic[$format]['properties'][$item]['nb_produit'];
                    }
                }

                $chantiertotal_temp += $chantier * $format_m;
                $total_value3 += $format_m;
            } 
            //end all format
            //calc rotation chantier total
            $pic[$format]['chantier_total'] = $total_value3 > 0 ? ($chantiertotal_temp / $total_value3) : 0;
        }
        return $pic;
    }

    /**
     *  Get product in site and set product rent type
     *
     * @param string $date
     * @param object $site
     * @return array
     */
    protected function getProductsByDay($date, $site) 
    {
        $productsId = [];

        //time once day
        $from = date($date);
        $to   = date($date->format('Y-m-d').' 23:59:59');

        //get all data receive latest in day by id 
        $devices_data = DeviceData::whereBetween('created_at', [$from, $to])
                        ->groupBy('device_id')
                        ->orderBy('created_at', 'desc')
                        ->get();

        //select payload_cleartext and deveui
        preg_match_all('/((?<=payload_cleartext\\\":\\\")(.*?)(?=\\\",))|((?<=deveui\\\":\\\")(.*?)(?=\\\",))/i', json_encode($devices_data), $matchs);

        //find device match
        $n_matchs = count($matchs[0]);
        for ($idx = 1; $idx < $n_matchs; $idx+=2) {

            //find device by deveui
            $device = Device::where('dev_eui', $matchs[0][$idx])->first();   

            //get lat, lng by payload_cleartext
            $latlng = $this->getLatLng($matchs[0][$idx-1]);
            $device_lat = isset($latlng[0]) && is_numeric(trim($latlng[0])) ? trim($latlng[0]) : null;
            $device_lng = isset($latlng[1]) && is_numeric(trim($latlng[1])) ? trim($latlng[1]) : null;

            //check exists device or lat, lng
            if ($device_lat == null || $device_lng == null || $device == null) continue;

            // Calcular distance between 2 point                  
            $distance = $this->distance($site->lat, $site->lng, $device_lat, $device_lng);
            if (0 <= $distance && $distance <= $site->max_radius) {
                
                //exists product attach, push id product into array return
                $device_attach = DeviceAttachment::where('device_id', $device->id)->first();
                
                if ($device_attach == null) continue;
                
                array_push($productsId, $device_attach->product_id);
            }                   
        }
        return $productsId;
    }

    /**
     *  Operation get time rent each products in company
     *
     * @param array $products
     * @return array
     */
    protected function getTimeRent($products) 
    {
        $result = [
            "min_date" => null,
            "max_date" => null
        ];

        if (!isset($products)) return null;
        
        $today = Carbon::now();
        $t_today = strtotime($today);
        $rent_date_max = $rent_date_min = $time_default = Carbon::create(1970, 01, 01, 0);

        foreach ($products as $product) {

            $product_rent = ProductRent::where('product_id', $product->id)->first();

            //check exists product in product rent
            //and valid value
            if ($product_rent == null || $product_rent['expired_date'] == null) continue;

            $exp_date = $product_rent['expired_date'];
            $t_exp = strtotime($exp_date);

            if ($t_exp >= $t_today) {

                //set time max product rent
                if ($t_exp > strtotime($rent_date_max)) {
                    $rent_date_max = $exp_date;
                }

                //set time min product rent
                $day = $this->timeRentProductById($product->id);
                $rent_date = $rent_date_max->copy()->subDays($day);

                if (strtotime($rent_date_min) <= 0) {
                    $rent_date_min = $rent_date;
                } else if (strtotime($rent_date) < strtotime($rent_date_min)) {
                    $rent_date_min = $rent_date;
                }
            }
        }
        //check valid set time min, time max
        if ($rent_date_min == $time_default || $rent_date_min == $rent_date_max)
            return null;

        $result['min_date'] = $rent_date_min->addDay()->setTime(00, 00, 00);
        $result['max_date'] = $today->setTime(23, 59, 59);

        return $result;
    }

    /**
     * Operation set time rent all products
     *
     * @param array $products
     * @return array
     */
    protected function setProductsRent($products) 
    {
        if (!isset($products)) return [];
        
        $n_pic = count($products);
        for ($i = 0; $i < $n_pic; $i++) {

            $format = $products[$i]['properties'];
            $n_format = count($format);
            for ($j = 0; $j < $n_format; $j++) {
                
                $rent_date_min = strtotime(Carbon::create(1970, 01, 01, 0));
                $rent_date_max = strtotime(Carbon::create(1970, 01, 01, 0));
                $today = strtotime(Carbon::now()->format('Y-m-d 23:59:59'));

                $product = $format[$j]['product_match'];
                $n_product = count($product);

                for ($k = 0; $k < $n_product; $k++) {

                    $p_rent = ProductRent::where('product_id', $product[$k]->id)->first();

                    //check valid product rent data
                    if ($p_rent == null 
                    || $p_rent['expired_date'] == null
                    || $p_rent['rent_date'] == null 
                    || $p_rent['transfer_numofdate'] == null
                    ) continue;

                    $expired_date = strtotime($p_rent['expired_date']->format('Y-m-d 23:59:59'));

                    $rent_date = strtotime($p_rent['rent_date']->format('Y-m-d 00:00:00'));

                    $transfer_date = $p_rent['transfer_numofdate'];

                    //calc time max product rent
                    if ($rent_date_max < $expired_date) {
                        $rent_date_max = $expired_date;
                    } 

                    //calc time min product rent
                    $start_date = $rent_date + 86400 + $transfer_date * 86400;

                    if ($rent_date_min > $start_date || $rent_date_min <= 0) {      
                        $rent_date_min = $start_date;
                    }
                }
                //end format
                $rent_min_max = round(($rent_date_max - $rent_date_min) / 86400);
                $rent_min_today = round(($today - $rent_date_min) / 86400);

                $products[$i]['properties'][$j]['rent_min_max'] = $rent_min_max;
                $products[$i]['properties'][$j]['rent_min_today'] = $rent_min_today;
            }
        }
        return $products;
    }

    /**
     * Operation set product type all product in site
     *
     * @param array $products
     * @param object $site
     * @return array
     */
    protected function setProductsType($products, $site)
    {
        //check exists products
        if (!isset($products)) return [];

        $today = strtotime(Carbon::now());
        $result = [];
        foreach ($products as $product) {

            if ($this->inLocation($product, $site)) {
                
                // get relation data
                // get product rent and product type
                $p_rent = ProductRent::where('product_id', $product->id)->first();
                $p_type = ProductType::where('id', $product->product_type_id)->first();

                if ($p_rent == null || $p_type == null || $p_rent['expired_date'] == null)
                    continue;

                //verify time rent product for display
                $expired_date = strtotime($p_rent['expired_date']->format('Y-m-d 23:59:59'));
                if ($expired_date > $today) {

                    // setup format 
                    $p_format = array(
                        "id" => 1,
                        "value_1" => null,
                        "value_2" => null,
                        "value_3" => null,
                        "m2" => 0,
                        "ml" => 0,
                        "nb_produit" => 0,
                        "n_product" => null,
                        "jour" => 0,
                        "chantier" => 0,
                        "rent_min_max" => 0,
                        "rent_min_today" => 0,
                        "product_id" => array(),
                        "product_match" => array()
                    );

                    //setup data to check product type
                    $data = [
                        "product" => $product,
                        "format" => [
                            "value_1" => $p_type->value_1,
                            "value_2" => $p_type->value_2,
                            "value_3" => $p_type->value_3
                        ]
                    ];

                    //validate logic in function
                    $valid = [
                        "name" => 0,
                        "format" => 0
                    ];

                    //not empty
                    $n_result = count($result);
                    for ($name = 0; $name < $n_result; $name++) {
                        
                        //exitst product_type name
                        if ($this->equalName($p_type, $result[$name])) {
                            $valid['name'] = 1;

                            // check valid product_type format
                            $properties = $result[$name]['properties'];
                            $n_properties = count($properties);
                            
                            for ($format = 0; $format < $n_properties; $format++) {
                                if ($this->equalFormat($data['format'], $properties[$format])) {

                                    // add product into response array
                                    $valid['format'] = 1;

                                    $this->setFormatProperties(
                                        $result[$name]['properties'][$format],
                                        $valid,
                                        $data
                                    );
                                    break;
                                }
                            }
                            // not found format
                            if (!$valid['format']) {

                                $p_format['id'] = $n_properties + 1;

                                $this->setFormatProperties(
                                    $p_format,
                                    $valid,
                                    $data
                                );

                                // push to exist product_type name
                                array_push($result[$name]['properties'], $p_format);
                                break;
                            }
                        }
                    }

                    //not found product type name, first time setup
                    if ($n_result <= 0 || $result == null || !$valid['name']) {

                        //setup new type in product type
                        $type = array(
                            "name" => null,
                            "alerts" => array(),
                            "chantier_total" => 0,
                            "properties" => array()
                        );
                        $type['name'] = $p_type->name;

                        // set product_type format
                        $this->setFormatProperties(
                            $p_format,
                            $valid,
                            $data
                        );

                        // push new name + format
                        array_push($type['properties'], $p_format);
                        array_push($result, $type);
                    }
                }
            }
        }
        return $result;
    } 
 
    /**
     * Operation createSite
     *
     * Create Site.
     *
     *
     * @return Http response
     */
    public function createSite()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'company_id' => 'bail|required|integer|min:1',
            'name' => 'required|max:100',
            'address' => 'nullable',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'area' => 'required|numeric',
            'area_ml' => 'required|numeric',
            'max_radius' => 'required|numeric',
            'city_code' => 'nullable',
            'city_name' => 'nullable'
        ]);

        // check exist Company
        if (is_null(Company::find($input['company_id']))) 
            return response('Company does not exist.', 404);

        $site = new Site();
        $site->company_id = $input['company_id'];
        $site->name = trim($input['name']);
        $site->address = trim($input['address']);
        $site->lat = $input['lat'];
        $site->lng = $input['lng'];
        $site->area = $input['area'];
        $site->area_ml = $input['area_ml'];
        $site->max_radius = $input['max_radius'];
        $site->city_code = $input['city_code'];
        $site->city_name = $input['city_name'];

        if ($site->save()) {
            
            $data = Site::find($site['id']);
            $data->company;

            return $data;
        } 
        
        return response('Error', 404);             
    }

    /**
     * Operation listSites
     *
     * List of Sites.
     *
     *
     * @return Http response
     */
    public function listSites()
    {
        $sites = Site::all();

        if (count($sites) <= 0) return response('Not found', 404); 

        foreach ($sites as $site) {
            //get product data
            $site->product = $this->getProducts($site);
        }
        return $sites;
    }

    /**
     * Operation listSitesByCompanyId
     *
     * List of sites by company id.
     *
     * @param int $company_id ID of company to return (required)
     *
     * @return Http response
     */
    public function listSitesByCompanyId($company_id)
    {
        //path params validation
        if (empty($company_id) || (int)$company_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Site
        $sites = Site::where('company_id', $company_id)->get();

        if (count($sites) <= 0) return response('Not found', 404); 

        foreach ($sites as $site) {
            //get product data
            $site->product = $this->getProducts($site);
        }

        return $sites;
    }

    /**
     * Operation deleteSite
     *
     * Delete a Site.
     *
     * @param int $site_id site Id to delete (required)
     *
     * @return Http response
     */
    public function deleteSite($site_id)
    {
        if (empty($site_id) || (int)$site_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Site
        $site = Site::find($site_id);

        if (is_null($site_id)) 
            return response('Not found', 404);

        if ($site->delete())
            return response('OK', 200);
        
        return response('Error', 404);
    }

    /**
     * Operation getSiteById
     *
     * Find Site by ID.
     *
     * @param int $site_id ID of Site to return (required)
     *
     * @return Http response
     */
    public function getSiteById($site_id)
    {
        if (empty($site_id) || (int)$site_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Site
        $site = Site::find($site_id);

        if (is_null($site)) 
            return response('Not found', 404);

        $site->product = $this->getProducts($site);

        return $site;
    }

    /**
     * Operation updateSite
     *
     * Updates a Site.
     *
     * @param int $site_id ID of site that needs to be Site (required)
     *
     * @return Http response
     */
    public function updateSite()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',
            'company_id' => 'bail|required|integer|min:1',
            'name' => 'required|max:100',
            'address' => 'nullable',
            'lat' => 'nullable|numeric|min:0',
            'lng' => 'nullable|numeric|min:0',
            'area' => 'required|numeric',
            'area_ml' => 'required|numeric',
            'max_radius' => 'required|numeric',
            'city_code' => 'nullable',
            'city_name' => 'nullable'
        ]);

        if (empty($input['id']) || (int)$input['id'] < 0)
            return response('Invalid ID supplied', 400);

        // check exist Company
        if (is_null(Company::find($input['company_id']))) 
            return response('Company does not exist.', 404);        

        // get Site
        $site = Site::find($input['id']);

        if (is_null($site)) return response('Not found', 404);

        $site->company_id = $input['company_id'];
        $site->name = trim($input['name']);
        $site->address = trim($input['address']);
        $site->lat = $input['lat'];
        $site->lng = $input['lng'];
        $site->area = $input['area'];
        $site->area_ml = $input['area_ml'];
        $site->max_radius = $input['max_radius'];
        $site->city_code = $input['city_code'];
        $site->city_name = $input['city_name'];

        if ($site->save()) {

            //get product data
            $site->product = $this->getProducts($site);

            return $site;
        }
        
        return response('Error', 404);
    }
}
