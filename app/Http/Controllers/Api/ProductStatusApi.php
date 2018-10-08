<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductStatus;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;

class ProductStatusApi extends Controller
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
     * Operation createProductStatus
     *
     * Create Status.
     *
     *
     * @return Http response
     */
    public function createProductStatus()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'name' => 'required|max:100',
            'description' => 'nullable',            
        ]);

        $productStatus = new ProductStatus();
        $productStatus->name = trim($input['name']);
        $productStatus->description = trim($input['description']);

        if ($productStatus->save()) return ProductStatus::find($productStatus['id']);
        
        return response('Error', 404);
    }
    /**
     * Operation listProductStatus
     *
     * List of Product Status.
     *
     *
     * @return Http response
     */
    public function listProductStatus()
    {
        return ProductStatus::all()->toArray();
    }
    /**
     * Operation deleteProductStatus
     *
     * Delete a Product Status.
     *
     * @param int $product_status_id product Status Id to delete (required)
     *
     * @return Http response
     */
    public function deleteProductStatus($product_status_id)
    {
        //path params validation
        if (empty($product_status_id) || (int)$product_status_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Product Status
        $productStatus = ProductStatus::find($product_status_id);

        if (is_null($productStatus)) 
            return response('Not found', 404);

        if ($productStatus->delete())
            return response('OK', 200);
        
        return response('Error', 404);
    }
    /**
     * Operation getProductStatusById
     *
     * Find stauts by ID.
     *
     * @param int $product_status_id ID of ProductStatus to return (required)
     *
     * @return Http response
     */
    public function getProductStatusById($product_status_id)
    {
        if (empty($product_status_id) || (int)$product_status_id < 0) 
            return response('Invalid ID supplied', 400);

        //get Product Status
        $productStatus = ProductStatus::find($product_status_id);

        if (is_null($productStatus)) 
            return response('Not found', 404);

        return $productStatus;
    }
    /**
     * Operation updateProductStatus
     *
     * Updates a product status.
     *
     * @param int $product_status_id ID of product status that needs to be status (required)
     *
     * @return Http response
     */
    public function updateProductStatus()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',             
            'name' => 'required|max:100',
            'description' => 'nullable',             
        ]);
        
        $product_status_id = $input['id'];

        if (empty($product_status_id) || (int)$product_status_id < 0) 
            return response('Invalid ID supplied', 400);

        // get AccessControl
        $productStatus = ProductStatus::find($product_status_id);

        if (is_null($productStatus)) return response('Not found', 404);

        $productStatus->name = trim($input['name']);
        $productStatus->description = trim($input['description']);

        if ($productStatus->save()) return $productStatus;
        
        return response('Error', 404);
    }
}
