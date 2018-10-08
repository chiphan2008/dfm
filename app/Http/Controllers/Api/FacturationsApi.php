<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Site;
use App\Models\Product; 
use App\Models\Device;
use App\Models\DeviceAttachment; 
use App\Models\ProductRent;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;

class FacturationsApi extends Controller
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
     * Constructor
     */
    public function __construct(Request $request, Auth $auth, PermissionService $permission)
    {
        $this->request = $request;
        $this->auth = $auth;   
        $this->permission = $permission;        
    }

    /**
    * Caculator distance between two location
    */
    private function distance($lat1, $lng1, $lat2, $lng2) 
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
    * @return bool
    */
    private function equalName($product_1, $product_2) 
    {
        if ($product_1['name'] != $product_2['name']) 
            return 0;

        return 1;
    }

    /**
    * Check equal format two product
    *
    * @return bool
    */
    private function equalFormat($format_1, $format_2) 
    {
        if ($format_1['value_1'] != $format_2['value_1'])
            return 0;

        if ($format_1['value_2'] != $format_2['value_2']) 
            return 0;

        return 1;
    }

    /**
    * Check equal date envoi product
    *
    * @return bool
    */
    private function equalTenvoi($envoi_1, $envoi_2)
    {   
        if ($envoi_1['Tenvoi'] == null || $envoi_2['Tenvoi'] == null) return 0;

        if ($envoi_1['Tenvoi']->format('Y-m-d') != $envoi_2['Tenvoi']->format('Y-m-d'))
            return 0;

        return 1;
    }

    /**
    * Check equal date recep product
    *
    * @return bool
    */
    private function equalTrecep($recep_1, $recep_2)
    {
        if ($recep_1['Trecep'] == null || $recep_2['Trecep'] == null) return 0;

        if ($recep_1['Trecep']->format('Y-m-d') != $recep_2['Trecep']->format('Y-m-d'))
            return 0;

        return 1;
    }

    /**
    * Get max time (day) rent between two product
    *
    * @return int
    */
    private function setTempsMax(&$Temps_1, $Temps_2) 
    {
        if ($Temps_1['Temps'] < $Temps_2['Temps'])
            $Temps_1['Temps'] = $Temps_2['Temps'];
    }

    /**
    * Get time (day) rent a product 
    *
    * @return int
    */
    private function getTemps($data) 
    {
        $p_rent = ProductRent::where('product_id', $data['product']->id)->first();

        //transfer day
        $n_transfer = $p_rent['transfer_numofdate'];
        
        //date start rent
        $rent_date = $p_rent['rent_date'];    
        
        //expired date
        $today = strtotime(Carbon::now());
        $end_date = strtotime($p_rent['expired_date']);

        //time rent product was expired
        if ($end_date < $today) {
            $start_date = strtotime($rent_date) + 86400 * $n_transfer + 86400;

            return round(($end_date - $start_date) / 86400); 
        }

        return 0;
    }

    /**
    * Check product is rent or not
    *
    * @return bool
    */
    protected function isProductRent($product_id)
    {
        if (!$product_id) return false;
        $p_rent = ProductRent::where('product_id', $product_id)->first();

        //check exist product in product rent table
        if (count($p_rent) < 1) return false;
        return true;
    }

    /**
    *
    * Check product in Location or not
    *
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
        if (0 <= $distance && $distance <= $location->max_radius) {
            return true;
        }
        return false;
    }
    /**
    * Set properties in format
    * 
    */
    private function setFormatProperties(&$result, $valid = null, $data = null) 
    {
        if ($this->isProductRent($data['product']->id)) {
            array_push($result['product_match'], $data['product']);
            array_push($result['product_id'], $data['product']->id);

            if (!($valid['name'] && $valid['format'])) {
                
                //not equal product name and format            
                $result['value_1'] = $data['format']['value_1'];
                $result['value_2'] = $data['format']['value_2'];
            }

            $result['envoi'] = $this->setEnvoi($result, $data);
            $result['envoi'] = $this->setNrestant($result);            
        }
     }

    /**
    * Set Nb produit restant for products envoi
    *
    * @return Array
    */
    private function setNrestant($result)
    {
        $envois = &$result['envoi'];
        $n_envois = count($envois);

        for ($p_envoi = 0; $p_envoi < $n_envois; $p_envoi++) {

            $c_recep = 0;
            $receps = $envois[$p_envoi]['recep'];
            $n_receps = count($receps);

            for ($p_recep = 0; $p_recep < $n_receps; $p_recep++) {

                if ($receps[$p_recep]['Temps']) {
                    $c_recep += $receps[$p_recep]['Nrecep'];
                }
            }
            $envois[$p_envoi]['Nrestant'] = $envois[$p_envoi]['Nenvoi'] - $c_recep;
        }

        return $envois;
    }

    /**
    * Set properties for products envoi
    *
    * @return Array
    */
    private function setEnvoi($result, $data)
    {
        $p_rent = ProductRent::where('product_id', $data['product']->id)->first();

        //setup Tenvoi
        $envoi = [
            "Tenvoi" => $p_rent['rent_date'],
            "Nenvoi" => 1,
            "recep" => [],
            "Nrestant" => 0
        ];

        //setup Trecep
        $recep = [
            "Trecep" => $p_rent['expired_date'],
            "Nrecep" => 0,
            "Temps" => 0
        ];

        //validate logic in function
        $valid = [
            "envoi" => 0,
            "recep" => 0
        ];

        //number day use product from rent day to expired day < today
        $recep['Temps'] = $this->getTemps($data);

        $envois = &$result['envoi'];
        $n_envois = count($envois);

        for ($p_envoi = 0; $p_envoi < $n_envois; $p_envoi++) {

            if ($envoi['Tenvoi'] == null) continue;

            //equal time rent
            if ($this->equalTenvoi($envoi, $result['envoi'][$p_envoi])) {

                //validate match Time rent product
                $valid['envoi'] = 1;

                //grow up Nb produit for rent
                $envois[$p_envoi]['Nenvoi'] += 1;
                
                if ($recep['Temps']) {
                    $recep['Nrecep'] = 1;

                    //check date use product
                    $receps = &$result['envoi'][$p_envoi]['recep'];
                    $n_receps = count($receps);

                    for ($p_recep = 0; $p_recep < $n_receps; $p_recep++) {
                        
                        if ($recep['Trecep'] == null) continue;

                        //equal time expired
                        if ($this->equalTrecep($recep, $receps[$p_recep])) {

                            //validate match time expired date
                            $valid['recep'] = 1;

                            //grow up Nb produit for return site
                            $envois[$p_envoi]['recep'][$p_recep]['Nrecep'] += 1;
                        
                            //set Temps max
                            $this->setTempsMax(
                                $envois[$p_envoi]['recep'][$p_recep],
                                $recep
                            );
                        }
                    }  
                }
                //not exists recep in envoi
                if (!$valid['recep'] && $recep['Trecep'] != null) {
                    array_push($envois[$p_envoi]['recep'], $recep);
                }
            }
        }
        //not exists envoi
        if (!$valid['envoi'] && $envoi['Tenvoi'] != null) {
            
            //expired rent product
            if ($recep['Temps']) $recep['Nrecep'] = 1;

            array_push($envoi['recep'], $recep);
            array_push($result['envoi'], $envoi);
        }    

        return $result['envoi'];
    }

    private function setProductsType($products, $site)
    {
        $result = [];
        if (isset($products)) {

            foreach ($products as $product) {

                //check product in site
                if ($this->inLocation($product, $site)) {
                    // get relation data
                    //$p_rent = ProductRent::where('product_id', $product->id)->first();
                    $p_type = $product->productType;
                    
                    // format 
                    $p_format = [
                        "id" => 1,
                        "value_1" => null,
                        "value_2" => null,
                        "envoi" => [],
                        "product_id" => [],
                        "product_match" => [],
                    ];
                    
                    if ($p_type) { 

                        //validate logic in function
                        $valid = [
                            "name" => 0,
                            "format" => 0
                        ];

                        //setup data to check product type
                        $data = [
                            "product" => $product,
                            "format" => [
                                "value_1" => $p_type->value_1,
                                "value_2" => $p_type->value_2
                            ]
                        ];

                        // array result not empty
                        $n_result = count($result);
                        for ($name = 0; $name < $n_result; $name++) {
                            
                            //check valid product_type name
                            if ($this->equalName($p_type, $result[$name])) {

                                //exists product type name, check valid format
                                $valid['name'] = 1;
                                $p_formats = $result[$name]['format'];
                                $n_formats = count($p_formats);

                                for ($format = 0; $format < $n_formats; $format++) {

                                    //check format
                                    if ($this->equalFormat($data['format'], $p_formats[$format])) {
                                        // add product into response array
                                        $valid['format'] = 1;
                                        
                                        $this->setFormatProperties(
                                            $result[$name]['format'][$format],
                                            $valid,
                                            $data
                                        );
                                        break;
                                    }
                                }
                                // not found format
                                if (!$valid['format']) {

                                    $p_format['id'] = $n_formats + 1;

                                    $this->setFormatProperties(
                                        $p_format,
                                        $valid,
                                        $data
                                    );

                                    if ($p_format['value_1'] != null && $p_format['value_2'] != null) {
                                        // push to exist product_type name
                                        array_push($result[$name]['format'], $p_format);

                                        break;
                                    }
                                }
                            }
                        }
                        //first time setup or different product name
                        if ($n_result <= 0 || $result == null || !$valid['name']) {
                            //not found product type name
                            $type = array(
                                "name" => null,
                                "format" => array(),
                            );

                            //push product_type name
                            $type['name'] = $p_type->name;

                            $this->setFormatProperties(
                                $p_format,
                                $valid,
                                $data
                            );

                            if ($p_format['value_1'] != null && $p_format['value_2'] != null) {
                                // push new name + format
                                array_push($type['format'], $p_format);
                                array_push($result, $type);                            
                            } 
                        }
                    }
                }
            }
        } 
        return $result;
    }  

    /**
     * Operation listFacturations
     *
     * List of facturations by company id and site id.
     *
     * @param int $company_id ID of company to return (required)
     * @param int $site_id ID of site to return (required)
     *
     * @return Http response
     */
    public function listFacturations($company_id, $site_id)
    {
        // check valid param company id
        if (empty($company_id) || (int)$company_id < 0)
            return response('Invalid Company ID supplied', 400);

        // check valid param site id
        if (empty($site_id) || (int)$site_id < 0)
            return response('Invalid Site ID supplied', 400);

        $company = Company::find($company_id);
        $site = Site::where('id', $site_id)->where('company_id', $company_id)->first();

        // check exists company
        if (is_null($company)) 
            return response('Not found Company', 404);

        // check exists site
        if (is_null($site)) 
            return response('Not found Site', 404);

        //get all products in site by company id
        $products = Product::where('company_id', $site->company_id)->get();

        //format propertie for products
        $products = $this->setProductsType($products, $site);

        return $products;
    }
}


