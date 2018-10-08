<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use App\Models\Storage;
use App\Models\Device;
use App\Models\DeviceData;
use App\Models\Status;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductRent;
use App\Models\DeviceAttachment;
use Carbon\Carbon;
use App\Geolocation\PermissionService;

class StoragesApi extends Controller
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
    * Check equal name two product
    *
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
    * Set properties in format
    *
    */
    protected function setFormatProperties(&$result, $valid, $data)
    {
        array_push($result['product_match'], $data['product']);
        array_push($result['product_id'], $data['product']->id);

        if (!$valid['format']) {

            //not exists format or first time setup
            $result['value_1'] = $data['format']['value_1'];
            $result['value_2'] = $data['format']['value_2'];
            $result['value_3'] = $data['format']['value_3'];
        }
    }

    /**
    *
    * Caculator distance between two location
    *
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
     * Get list products in Storage by company ID
     *
     * @return Http Array
     */
    protected function getProducts($storage)
    {
        $products = Product::where('company_id', $storage->company_id)->get();

        //Group products
        //check exists products in list products
        if (count($products) < 1) return [];

        $productsInCompany = $this->setProductsType($products, $storage);

        //Set Properties in Group
        //check exists format
        if (count($productsInCompany) < 1) return [];

        $productsInCompany = $this->setProperties($productsInCompany);


        return $productsInCompany;
    }

    /**
    *   Get Product status id by Product Id
    *
    *   @return integer
    */
    protected function getProductStatusId($product_id)
    {
        $product = Product::where('id', $product_id)->first();

        if (count($product) < 1) return 0;

        return $product->product_status_id;
    }

    /**
     * Group list products in Storage by name, format
     *
     * @return Http Array
     */
    protected function setProductsType($products, $storage)
    {
        $result = [];

        if (isset($products)) {
            foreach ($products as $product) {
                if ($this->inLocation($product, $storage)) {
                    // get relation data
                    $p_type = $product->productType;

                    // format
                    $p_format = array(
                        "id" => 1,
                        "value_1" => null,
                        "value_2" => null,
                        "value_3" => null,
                        "area" => 0,    //Disponible
                        "area_ml" => 0,
                        "rent_area" => 0,//Loue
                        "rent_area_ml" => 0,
                        "nb_disp" => 0,
                        "nb_loue" => 0,
                        "total_m2" => 0,
                        "total_ml" => 0,
                        "nb_total" => 0,
                        "taux" => 0,
                        "product_id" => array(),
                        "product_match" => array()
                    );

                    if ($p_type) {

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
                        if  ($n_result <= 0 || $result == null || !$valid['name']) {

                            //setup new type in product type
                            $type = array(
                                "name" => null,
                                "alerts" => array(),
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
        }
        return $result;
    }

    /**
     * Set properties for each format
     *
     *
     * @return Http response
     */
    protected function setProperties($pic = [])
    {
        try {
            //foreach name
            $n_pic = count($pic);
            for ($format = 0; $format < $n_pic; $format++) {

                $format_pic = $pic[$format]['properties'];
                $n_format_pic = count($format_pic);

                //foreach format
                for ($item = 0; $item < $n_format_pic; $item++) {

                    $p_pic = $format_pic[$item]['product_id'];
                    $n_product_pic = count($p_pic);

                    //foreach product
                    for ($p_id = 0; $p_id < $n_product_pic; $p_id++) {

                        //set product status
                        $alert = $this->getProductStatusId($p_pic[$p_id]);
                        if ($alert && !in_array($alert, $pic[$format]['alerts']))
                            array_push($pic[$format]['alerts'], $alert);

                        //set multi properties
                        $value_3 = $format_pic[$item]['value_3'];
                        $value3 = explode(' ', $value_3);

                        if (count($value3) >= 2) {
                            $i0_value3 = $value3[0];
                            $i1_value3 = $value3[1];
                        }

                        //product was rent, Loue
                        if ($this->isProductRent($p_pic[$p_id])) {

                            $pic[$format]['properties'][$item]['nb_loue'] += 1;

                            if ($i1_value3 == "ml") {
                                //Loue ml
                                $pic[$format]['properties'][$item]['rent_area_ml'] += $i0_value3;
                            } else {
                                //Loue m2
                                $pic[$format]['properties'][$item]['rent_area'] += $i0_value3;
                            }
                        }

                        //product not rent, Disponible
                        else {

                            $pic[$format]['properties'][$item]['nb_disp'] += 1;


                            if ($i1_value3 == "ml") {
                                //Disponible ml
                                $pic[$format]['properties'][$item]['area_ml'] += $i0_value3;

                            } else {
                                //Disponible m2
                                $pic[$format]['properties'][$item]['area'] += $i0_value3;
                            }
                        }
                    }

                    $area = $pic[$format]['properties'][$item]['area'];
                    $area_ml = $pic[$format]['properties'][$item]['area_ml'];
                    $rent_area = $pic[$format]['properties'][$item]['rent_area'];
                    $rent_area_ml = $pic[$format]['properties'][$item]['rent_area_ml'];

                    //total m2
                    $pic[$format]['properties'][$item]['total_m2'] =
                        $area + $rent_area;

                    //total ml
                    $pic[$format]['properties'][$item]['total_ml'] =
                        $area_ml + $rent_area_ml;


                    //nb total
                    $pic[$format]['properties'][$item]['nb_total'] =
                            $pic[$format]['properties'][$item]['nb_disp']
                            + $pic[$format]['properties'][$item]['nb_loue'];

                    //taux utilisation
                    if ($pic[$format]['properties'][$item]['total_m2'] > 0) {

                        $base = $rent_area + $area;
                        $pic[$format]['properties'][$item]['taux'] =
                            $base > 0 ? ($rent_area / $base) : 0;

                    }

                    if ($pic[$format]['properties'][$item]['total_ml'] > 0) {

                        $base = $rent_area_ml + $area_ml;
                        $pic[$format]['properties'][$item]['taux'] =
                            $base > 0 ? ($rent_area_ml / $base) : 0;
                    }
                }
            }
            return $pic;

        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Operation createStorage
     *
     * Create Storage.
     *
     *
     * @return Http response
     */
    public function createStorage()
    {
        $input = $this->request->all();

        //valid params
        $this->validate($this->request, [
            'company_id' => 'bail|required|integer|min:1',
            'name' => 'required|max:100',
            'area' => 'required|numeric',
            'rent_area' => 'required|numeric',
            'area_ml' => 'required|numeric',
            'rent_area_ml' => 'required|numeric',
            'max_radius' => 'required|numeric',
            'lat' => 'nullable|numeric|min:0',
            'lng' => 'nullable|numeric|min:0',
            'city_code' => 'nullable',
            'city_name' => 'nullable'
        ]);

        //Check valid Company
        if (is_null(Company::find($input['company_id'])))
            return response('Not Found Company', 404);

        $storage = new Storage();
        $storage->company_id = $input['company_id'];
        $storage->name = $input['name'];
        $storage->area = $input['area'];
        $storage->rent_area = $input['rent_area'];
        $storage->area_ml = $input['area_ml'];
        $storage->rent_area_ml = $input['rent_area_ml'];
        $storage->max_radius = $input['max_radius'];
        $storage->lat = $input['lat'];
        $storage->lng = $input['lng'];
        $storage->city_code = $input['city_code'];
        $storage->city_name = $input['city_name'];

        if ($storage->save()) return Storage::find($storage['id']);

        return response('Error', 404);
    }
    /**
     * Operation listStorage
     *
     * List of Storages.
     *
     *
     * @return Http response
     */
    public function listStorage()
    {
        // Response list storage
        $storages = Storage::all();

        if (count($storages) <= 0) return response('Not found', 404); 

        foreach ($storages as $storage) {
            $storage->product = $this->getProducts($storage);
        }

        return $storages;
    }
    /**
     * Operation updateStorage
     *
     * Updates a Storage.
     *
     *
     * @return Http response
     */
    public function updateStorage()
    {
        $input = $this->request->all();

        // Valid params
        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',
            'company_id' => 'bail|required|integer|min:1',
            'name' => 'required|max:100',
            'area' => 'required|numeric',
            'rent_area' => 'required|numeric',
            'area_ml' => 'required|numeric',
            'rent_area_ml' => 'required|numeric',
            'max_radius' => 'required|numeric',
            'lat' => 'nullable|numeric|min:0',
            'lng' => 'nullable|numeric|min:0',
            'city_code' => 'nullable',
            'city_name' => 'nullable'
        ]);

        $storage = Storage::find($input['id']);

        // Check Storage ID exists
        if (is_null($storage))
            return response('Invalid ID supplied', 400);

        // Check Company ID exists
        if (is_null(Company::find($input['company_id'])))
            return response('Invalid Company ID supplied', 400);

        $storage->company_id = $input['company_id'];
        $storage->name = $input['name'];
        $storage->area = $input['area'];
        $storage->rent_area = $input['rent_area'];
        $storage->area_ml = $input['area_ml'];
        $storage->rent_area_ml = $input['rent_area_ml'];
        $storage->max_radius = $input['max_radius'];
        $storage->lat = $input['lat'];
        $storage->lng = $input['lng'];
        $storage->city_code = $input['city_code'];
        $storage->city_name = $input['city_name'];

        if ($storage->save())
            return $storage;

        return response('Error', 404);
    }
    /**
     * Operation listStoragesByCompanyId
     *
     * List of storages by company id.
     *
     * @param int $company_id ID of company to return (required)
     *
     * @return Http response
     */
    public function listStoragesByCompanyId($company_id)
    {
        // Valid param
        if (0 > intval($company_id) || empty($company_id))
            return response('Invalid ID supplied', 400);

        $storages = Storage::where('company_id', $company_id)->get();

        // Check exists storage
        if (count($storages) <= 0) return response('Not found storages in company id', 404);

        // Response list storage
        foreach ($storages as $storage) {
            $storage->product = $this->getProducts($storage);
        }

        return $storages;
    }
    /**
     * Operation deleteStorage
     *
     * Delete a Storage.
     *
     * @param int $storage_id storage Id to delete (required)
     *
     * @return Http response
     */
    public function deleteStorage($storage_id)
    {
        //Valid prama
        if (empty($storage_id) || intval($storage_id) < 0) {
            return response('Invalid ID supplied', 400);
        }

        //Match id
        $storage = Storage::find($storage_id);

        if (is_null($storage)) {
            return response('Not found Storage', 404);
        }

        //and delete Storage
        if ($storage->delete()) {
            return response('OK', 200);
        }

        return response('Error', 404);
    }
    /**
     * Operation getStorageById
     *
     * Find Storage by ID.
     *
     * @param int $storage_id ID of Storage to return (required)
     *
     * @return Http response
     */
    public function getStorageById($storage_id)
    {
        // Valid prama
        if (empty($storage_id) || 0 > intval($storage_id))
            return response('Storage ID not invalid', 400);

        $storage = Storage::where('id', $storage_id)->first();

        // Check exists storage
        if (is_null($storage))
            return response('Not found Storage', 404);

        $storage->product = $this->getProducts($storage);

        return $storage;
    }
}
