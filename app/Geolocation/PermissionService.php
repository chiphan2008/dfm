<?php
namespace App\Geolocation;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\AccessControlList;

//Companies
define('PERM_GET_COMPANIES','Companies/listCompanies');
define('PERM_CREATE_COMPANY','Companies/createCompany');
define('PERM_DELETE_COMPANY','Companies/deleteCompany');
define('PERM_GET_COMPANY','Companies/getCompanyById');
define('PERM_UPDATE_COMPANY','Companies/updateCompany');

//Products
define('PERM_GET_PRODUCTS','Products/listProducts');
define('PERM_CREATE_PRODUCT','Products/createProduct');
define('PERM_DELETE_PRODUCT','Products/deleteProduct');
define('PERM_GET_PRODUCT','Products/listProductsByCompanyId');
define('PERM_UPDATE_PRODUCT','Products/updateProduct');

class PermissionService
{
	 /**
     * @var \Laravel\Lumen\Application
     */
	private $app;

	private $auth;

	function __construct()
	{
		// $this->app = $app;
		// $this->auth = $app['Illuminate\\Contracts\\Auth\\Factory'];
	}

	public function isAllow($resource_name)
	{
		$isValid = false;

		// get role id
		$role_id = $this->auth->user()->roles->id;

		if ((int) $role_id < 0 ) return $isValid;


        return empty( AccessControlList::where('name',$resource_name)->where('role_id', $role_id)->first() );
	}
}
