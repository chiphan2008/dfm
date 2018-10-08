<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductRent;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;


class ProductRentsApi extends Controller
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
     * Operation createProductRent
     *
     * Create Product Rents.
     *
     *
     * @return Http response
     */
    public function createProductRent()
    {
        $input = $this->request->all();

        // Check valid params
        $this->validate($this->request, [
          'product_id' => 'bail|required|integer|min:1',
          'company_id' => 'bail|required|integer|min:1',
          'transfer_numofdate' => 'required|integer|min:0',
          'rent_date' => 'required|date',
          'expired_date' => 'required|date',
          'cmt' => 'nullable',
          'ref_name' => 'nullable'
        ]);

        // Check exists product
        if (is_null(Product::find($input['product_id']))) 
          return response('Product does not exist.', 404);

        // Check exist company
        if (is_null(Company::find($input['company_id'])))
          return response('Company does not exist.', 404);

        $product_rent = new ProductRent(); 
        $product_rent->product_id = $input['product_id'];
        $product_rent->company_id = $input['company_id'];
        $product_rent->transfer_numofdate = $input['transfer_numofdate'];
        $product_rent->rent_date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $input['rent_date']);  
        $product_rent->expired_date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $input['expired_date']);  
        $product_rent->cmt = trim($input['cmt']);
        $product_rent->ref_name = trim($input['ref_name']);

        if ($product_rent->save()) {
          // get product rent 
          $data = ProductRent::find($product_rent['id']);

          // get relation data
          $data->company;
          $data->product;

          return $data;
        }

        return response('Error', 404);
    }
    /**
     * Operation listProductRents
     *
     * List of Product Rents.
     *
     *
     * @return Http response
     */
    public function listProductRents()
    {
        $product_rents = ProductRent::all();

        if (is_null($product_rents)) return response('Not found', 404);

        foreach ($product_rents as $product_rent) {
          // get relation data
          $product_rent->company;
          $product_rent->product;

        }

        return $product_rents;
    }
    /**
     * Operation updateProductRent
     *
     * Updates a Product Rent.
     *
     *
     * @return Http response
     */
    public function updateProductRent()
    {
        $input = $this->request->all();

        // Check valid params
        $this->validate($this->request, [
          'id' => 'bail|required|integer|min:1',
          'product_id' => 'bail|required|integer|min:1',
          'company_id' => 'bail|required|integer|min:1',
          'transfer_numofdate' => 'required|integer|min:0',
          'rent_date' => 'required|date',
          'expired_date' => 'required|date',
          'cmt' => 'nullable',
          'ref_name' => 'nullable'
        ]);

        $product_rent_id = $input['id'];
        // Check vaid input id
        if (empty($product_rent_id) || (int)$product_rent_id < 0)
          return response('Invalid ID supplied', 400);

        // Check exists product
        if (is_null(Product::find($input['product_id']))) 
          return response('Product does not exist.', 404);

        // Check exist company
        if (is_null(Company::find($input['company_id'])))
          return response('Company does not exist.', 404);

        // Get product rent
        $product_rent = ProductRent::find($product_rent_id);

        if (count($product_rent) < 0) return response('Not found', 404);

        // update product rent
        $product_rent->product_id = $input['product_id'];
        $product_rent->company_id = $input['company_id'];
        $product_rent->transfer_numofdate = $input['transfer_numofdate'];
        $product_rent->rent_date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $input['rent_date']);  
        $product_rent->expired_date = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $input['expired_date']); 
        $product_rent->cmt = trim($input['cmt']);
        $product_rent->ref_name = trim($input['ref_name']);

        if ($product_rent->save()) {
          // get relation data
          $product_rent->company;
          $product_rent->product;

          return $product_rent;
        }

        return response('Error', 404);
    }
    /**
     * Operation deleteProductRent
     *
     * Delete a Product Rent.
     *
     * @param int $product_rent_id product rent Id to delete (required)
     *
     * @return Http response
     */
    public function deleteProductRent($product_rent_id)
    {
        // Check valid param
        if (empty($product_rent_id) || (int)$product_rent_id < 0) 
          return response('Invalid ID supplied', 400);

        // Get product rent
        $product_rent = ProductRent::find($product_rent_id);

        if (is_null($product_rent)) return response('Not found', 404);

        if ($product_rent->delete()) return response('OK', 200);

        return response('Error', 404);
    }
    /**
     * Operation getProductRentById
     *
     * Find product rent by ID.
     *
     * @param int $product_rent_id ID of Product Rent to return (required)
     *
     * @return Http response
     */
    public function getProductRentById($product_rent_id)
    {
        // Check valid param
        if (empty($product_rent_id) || (int)$product_rent_id < 0) 
          return resposne('Invalid ID supplied', 400);

        // get product rent
        $product_rent = ProductRent::find($product_rent_id);

        if (count($product_rent) <= 0) return response('Not found', 404);
        
        // get relation data
        $product_rent->company;
        $product_rent->product;

        return $product_rent;

    }
    /**
     * Operation listProductRentsByCompanyId
     *
     * List of products rent by company id.
     *
     * @param int $company_id ID of company to return (required)
     *
     * @return Http response
     */
    public function listProductRentsByCompanyId($company_id)
    {
        // Check valid param
        if (empty($company_id) || (int)$company_id < 0)
          return response('invalid ID supplied', 400);

        // Get product rent
        $product_rents = ProductRent::where('company_id', $company_id)->get();

        if (count($product_rents) <= 0) return response('Not found', 404);

        foreach ($product_rents as $product_rent) {
          // get relation data
          $product_rent->company;
          $product_rent->product;

        }

        return $product_rents;
    }
}
