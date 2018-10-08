<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\ProductStatus;
use App\Models\ProductType;
use App\Models\DeviceAttachment;
use App\Models\DeviceData;
use App\Models\Device;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;

class ProductsApi extends Controller
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
    public function __construct(Request $request,  Auth $auth, PermissionService $permission)
    {
        $this->request = $request;
        $this->auth = $auth;
        $this->permission = $permission;
    }

    /**
     * Operation createCapteur
     *
     * Create Capteur.
     *
     *
     * @return Http response
     */
    public function createProduct()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'product_type_id' => 'bail|required|integer|min:1',
            'company_id' => 'bail|required|integer|min:1',
            'product_status_id' => 'bail|required|integer|min:1',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'rent_price' => 'required|numeric',
            'manufacture_date' => 'date',
        ]);

        // check exist Product type
        if (is_null(ProductType::find($input['product_type_id'])))
            return response('Product Type does not exist', 404);

        // check exist Company
        if (is_null(Company::find($input['company_id'])))
            return response('Company does not exist', 404);

        // check exist Product Status
        if (is_null(ProductStatus::find($input['product_status_id'])))
            return response('Product status does not exist', 404);

        $product = new Product();
        $product->product_type_id = $input['product_type_id'];
        $product->company_id = $input['company_id'];
        $product->product_status_id = $input['product_status_id'];
        $product->name = trim($input['name']);
        $product->description = trim($input['description']);
        $product->rent_price = $input['rent_price'];
        $product->manufacture_date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $input['manufacture_date']);

        if ($product->save()) return Product::find($product['id']);

        return response('Error', 404);
    }
    /**
     * Operation listCapteurs
     *
     * List of capteurs.
     *
     *
     * @return Http response
     */
    public function listProducts()
    {
        // get list product
        $products = Product::with('company','productType','productStatus')
                ->orderBy('name', 'asc')
                ->has('company')
                ->get();

        if (count($products) <= 0) return response('Not found products', 404);

        foreach ($products as $product) {

            $product->device = null;
            $product->device_data = null;

            // get Device Attachment
            $deviceAttachment = DeviceAttachment::where('product_id', $product->id)->first();
            // set device
            if ($deviceAttachment == null) continue;
            $product->device = $deviceAttachment->device;

            //get Device Attachment and count
            if ($product->device == null) continue;
            $deviceData = DeviceData::where('device_id', $product->device->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

            // set deviceData
            if ($deviceData == null) {
                $product->device_data = $deviceData;
            }

            //set product type each product
            if ($product->productType) {
                $product->product_type_parent = ProductType::where('id', '=', $product->productType->parent_id)->first();
            }
        }
        return $products;
    }

    /**
     * Operation listProductByCompanyId
     *
     * List of products by company id.
     *
     * @param int $company_id ID of device to return (required)
     *
     * @return Http response
     */
    public function listProductsByCompanyId($company_id)
    {
        //path params validation
        if (empty($company_id) || (int)$company_id < 0)
            return response('Invalid ID supplied', 400);

        //check exists company
        $company = Company::find($company_id);
        if ($company == null) return response('Not found Company', 404);

        // get Device Data
        $products = Product::where('company_id', $company_id)
                ->with('company','productType','productStatus')
                ->has('company')
                ->get();

        if (count($products) <= 0) return response('Not found', 404);

        // get relation data
        foreach ($products as $product) {

            $product->device = null;
            $product->device_data = null;

            // get Device Attachment
            $deviceAttachment = DeviceAttachment::where('product_id', $product->id)->first();
            // set device
            if ($deviceAttachment == null) continue;
            $product->device = $deviceAttachment->device;

            //get Device Attachment and count
            if ($product->device == null) continue;
            $deviceData = DeviceData::where('device_id', $product->device->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

            // set deviceData
            if ($deviceData != null) {
                $product->device_data = $deviceData;
            }

            if ($product->productType) {
                $product->product_type_parent = ProductType::where('id', '=', $product->productType->parent_id)->first();
            }
        }

        return $products;
    }

    /**
     * Operation deleteCapteur
     *
     * Delete a Capteur.
     *
     * @param int $capteur_id capteur id to delete (required)
     *
     * @return Http response
     */
    public function deleteProduct($product_id)
    {
        if (empty($product_id) || (int)$product_id < 0)
            return response('Invalid ID supplied', 400);

        // get Product
        $product = Product::find($product_id);

        if (is_null($product))
            return response('Not found', 404);

        if ($product->delete())
            return response('OK', 200);

        return response('Error', 404);
    }
    /**
     * Operation getCapteurById
     *
     * Find Capteur by ID.
     *
     * @param int $capteur_id ID of Capteur to return (required)
     *
     * @return Http response
     */
    public function getProductById($product_id)
    {
        if (empty($product_id) || (int)$product_id < 0)
            return response('Invalid ID supplied', 400);

        //get Product
        $product = Product::where('id', $product_id)
                ->with('company','productType','productStatus')
                ->has('company')
                ->first();

        if (is_null($product))
            return response('Not found', 404);

        $product->device = null;
        $product->device_data = null;

        // get Device Attachment
        $deviceAttachment = DeviceAttachment::where('product_id', $product->id)->first();
        // set device
        if ($deviceAttachment == null) return response('Not found in attach device', 404);
        $product->device = $deviceAttachment->device;

        //get Device Attachment and count
        if ($product->device == null) return response('Not found device attach', 404);
        $deviceData = DeviceData::where('device_id', $product->device->id)
                ->orderBy('created_at', 'desc')
                ->first();

        // set deviceData
        if ($deviceData != null) {
            $product->device_data = $deviceData;
        }

        if ($product->productType) {
            $product->product_type_parent = ProductType::where('id', '=', $product->productType->parent_id)->first();
        }

        return $product;
    }
    /**
     * Operation updateCapteur
     *
     * Updates a capteur.
     *
     * @param int $capteur_id ID of role that needs to be capteur (required)
     *
     * @return Http response
     */
    public function updateProduct()
    {
        $input = $this->request->all();

        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',
            'product_type_id' => 'bail|required|integer|min:1',
            'company_id' => 'bail|required|integer|min:1',
            'product_status_id' => 'bail|required|integer|min:1',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'rent_price' => 'required|numeric',
            'manufacture_date' => 'date',
        ]);

        // get Product
        $product = Product::where('id', $input['id'])
                ->with('company','productType','productStatus')
                ->has('company')
                ->first();

        if (is_null($product)) return response('Not found', 404);

        $product->product_type_id = $input['product_type_id'];
        $product->company_id = $input['company_id'];
        $product->product_status_id = $input['product_status_id'];
        $product->name = trim($input['name']);
        $product->description = trim($input['description']);
        $product->rent_price = $input['rent_price'];
        $product->manufacture_date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $input['manufacture_date']);

        if ($product->save()) {

            $product->device = null;
            $product->device_data = null;
            $product->receive_data_uplink = 0;
            $product->receive_data_downlink = 0;

            //get ralation data
            $deviceAttachment = DeviceAttachment::where('product_id', $product->id)->first();

            if ($deviceAttachment != null) {
                $product->device = $deviceAttachment->device;

                // get Device Attachment and count
                $deviceData = DeviceData::where('device_id', $product->device->id)->orderBy('created_at', 'desc')->first();

                if ($deviceData != null) {

                    // set deviceData
                    $product->device_data = $deviceData;

                    // // count Device Data type is uplink
                    // $product->receive_data_uplink = DeviceData::where('device_id', $product->device->id)
                    //     ->where('data_receive', 'like', '%uplink%')
                    //     ->count();

                    // // count Device Data type is downlink
                    // $product->receive_data_downlink = DeviceData::where('device_id', $product->device->id)
                    //     ->where('data_receive', 'like', '%downlink%')
                    //     ->count();
                }
            }
            if ($product->productType) {
                $product->product_type_parent = ProductType::where('id', '=', $product->productType->parent_id)->first();
            }

            return $product;
        }

        return response('Error', 404);
    }
}
