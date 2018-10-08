<?php

/**
 * GEOSERVER API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 0.0.1
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class ProductRentsApi extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
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
        $input = Request::all();

        //path params validation


        //not path params validation
        if (!isset($input['body'])) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling createProductRent');
        }
        $body = $input['body'];


        return response('How about implementing createProductRent as a post method ?');
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
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing listProductRents as a get method ?');
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
        $input = Request::all();

        //path params validation


        //not path params validation
        $body = $input['body'];


        return response('How about implementing updateProductRent as a patch method ?');
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
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing listProductRentsByCompanyId as a get method ?');
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
        $input = Request::all();

        //path params validation
        if ($product_rent_id < 1) {
            throw new \InvalidArgumentException('invalid value for $product_rent_id when calling ProductRentsApi.deleteProductRent, must be bigger than or equal to 1.');
        }


        //not path params validation

        return response('How about implementing deleteProductRent as a delete method ?');
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
        $input = Request::all();

        //path params validation


        //not path params validation

        return response('How about implementing getProductRentById as a get method ?');
    }
}
