<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;


class ProductTypesApi extends Controller
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
     * Operation createProductTypes
     *
     * Create Status.
     *
     *
     * @return Http response
     */
    public function createProductType()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'parent_id' => 'numeric|nullable',
            'name' => 'required|max:100',
            'unit_1' => 'nullable',
            'unit_2' => 'nullable',
            'unit_3' => 'nullable',
            'value_1' => 'nullable',
            'value_2' => 'nullable',
            'value_3' => 'nullable'
        ]);
        //valid format value 3
        if (!empty($input['value_3'])) {
            $type = explode(" ", $input['value_3']);
            if (!isset($type[1]) || empty($type[1])) 
                return response('Typeof value 3 required!', 400);
        }

        if (!empty($input['parent_id']) || $input['parent_id'] != NULL) {
            // check logic unit, value 1
            if ((int)$input['unit_1'] > 0 && empty($input['value_1']))
                return response('Unit or value required!', 400);            

            if ((int)$input['unit_1'] <= 0 && !empty($input['value_1']))
                return response('Unit or value required!', 400);            

            // check logic unit, value 2
            if ((int)$input['unit_2'] > 0 && empty($input['value_2']))
                return response('Unit or value required!', 400);            

            if ((int)$input['unit_2'] <= 0 && !empty($input['value_2']))
                return response('Unit or value required!', 400);            

            // check logic unit, value 3
            if ((int)$input['unit_3'] > 0 && empty($input['value_3']))
                return response('Unit or value required!', 400);            

            if ((int)$input['unit_3'] <= 0 && !empty($input['value_3']))
                return response('Unit or value required!', 400);                        
        }           

        $productType = new ProductType();
        $productType->parent_id = $input['parent_id'];
        $productType->name = trim($input['name']);
        $productType->unit_1 = $input['unit_1'];
        $productType->unit_2 = $input['unit_2'];
        $productType->unit_3 = $input['unit_3'];
        $productType->value_1 = trim($input['value_1']);
        $productType->value_2 = trim($input['value_2']);
        $productType->value_3 = trim($input['value_3']);

        if ($productType->save()) {
            $data = ProductType::find($productType['id']);        
            
            // get relation data
            $data->unit_1_data;
            $data->unit_2_data;
            $data->unit_3_data;

            return $data;
        }
        
        return response('Error', 404);
    }
    /**
     * Operation listProductTypes
     *
     * List of Product Types.
     *
     *
     * @return Http response
     */
    public function listProductTypes()
    {
        $productTypes = ProductType::all();

        foreach ($productTypes as $productType) {
            // get relation data
            $productType->unit_1_data;
            $productType->unit_2_data;
            $productType->unit_3_data;
        }

        return $productTypes;
    }
    /**
     * Operation deleteProductType
     *
     * Delete a Product Type.
     *
     * @param int $product_type_id product type Id to delete (required)
     *
     * @return Http response
     */
    public function deleteProductType($product_type_id)
    {
        //path params validation
        if (empty($product_type_id) || (int)$product_type_id < 0) 
            return response('Invalid ID supplied', 400);

        // get ProductTypes
        $productType = ProductType::find($product_type_id);

        if (is_null($productType)) 
            return response('Not found', 404);

        if ($productType->delete())
            return response('OK', 200);
        
        return response('Error', 404);
    }
    /**
     * Operation getProductTypeById
     *
     * Find stauts by ID.
     *
     * @param int $product_type_id ID of Product Type to return (required)
     *
     * @return Http response
     */
    public function getProductTypeById($product_type_id)
    {
        if (empty($product_type_id) || (int)$product_type_id < 0) 
            return response('Invalid ID supplied', 400);

        //get Product Types
        $productType = ProductType::find($product_type_id);

        if (is_null($productType)) 
            return response('Not found', 404);

        // get relation data
        $productType->unit_1_data;
        $productType->unit_2_data;
        $productType->unit_3_data;

        return $productType;
    }
    /**
     * Operation updateProductType
     *
     * Updates a Product Type.
     *
     * @param int $product_type_id ID of product type that needs to be type (required)
     *
     * @return Http response
     */
    public function updateProductType()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',
            'parent_id' => 'numeric|nullable',
            'name' => 'required|max:100',
            'unit_1' => 'nullable',
            'unit_2' => 'nullable',
            'unit_3' => 'nullable',
            'value_1' => 'nullable',
            'value_2' => 'nullable',
            'value_3' => 'nullable'
        ]);

        $product_type_id = $input['id'];
        
        if (empty($product_type_id) || (int)$product_type_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Product Types
        $productType = ProductType::find($product_type_id);

        if (is_null($productType)) return response('Not found', 404);

        //valid format value 3
        if (!empty($input['value_3'])) {
            $type = explode(" ", $input['value_3']);
            if (!isset($type[1]) || empty($type[1])) 
                return response('Typeof value 3 required!', 400);
        }

        if (!empty($input['parent_id']) || $input['parent_id'] != NULL) {
            // check logic unit, value 1
            if ((int)$input['unit_1'] > 0 && empty($input['value_1']))
                return response('Unit or value required!', 400);            

            if ((int)$input['unit_1'] <= 0 && !empty($input['value_1']))
                return response('Unit or value required!', 400);            

            // check logic unit, value 2
            if ((int)$input['unit_2'] > 0 && empty($input['value_2']))
                return response('Unit or value required!', 400);            

            if ((int)$input['unit_2'] <= 0 && !empty($input['value_2']))
                return response('Unit or value required!', 400);            

            // check logic unit, value 3
            if ((int)$input['unit_3'] > 0 && empty($input['value_3']))
                return response('Unit or value required!', 400);            

            if ((int)$input['unit_3'] <= 0 && !empty($input['value_3']))
                return response('Unit or value required!', 400);                        
        }

        // update product type
        $productType->parent_id = $input['parent_id'];
        $productType->name = trim($input['name']);
        $productType->unit_1 = $input['unit_1'];
        $productType->unit_2 = $input['unit_2'];
        $productType->unit_3 = $input['unit_3'];
        $productType->value_1 = trim($input['value_1']);
        $productType->value_2 = trim($input['value_2']);
        $productType->value_3 = trim($input['value_3']);

        if ($productType->save()) {
            // get relation data
            $productType->unit_1_data;
            $productType->unit_2_data;
            $productType->unit_3_data;

            return $productType;
        }
        return response('Error', 404);
    }
}
