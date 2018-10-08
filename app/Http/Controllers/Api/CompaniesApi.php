<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Role;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;




class CompaniesApi extends Controller
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
     * Operation listClients
     *
     * List of Client.
     *
     *
     * @return Http response
     */
    public function listClients()
    {           
        $data = []; 
        $clients = Company::all();                
        foreach ($clients as $client) {
            if (($client->name != 'DFM') && ($client->name != 'SATECO')) {
                array_push ($data, $client);            
            }
        } 
        return  $data;
        
    }    
    /**
     * Operation createCompany
     *
     * Create Company.
     *
     *
     * @return Http response
     */
    public function createCompany()
    {
        // check permission
        //$isAllow = $this->permission->isAllow('companies', 'createCompany');

        //if (!$isAllow || $isAllow = 0) return response()->json('Permission denied', 550);
        
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'name' => 'required|max:255',
            'phone_number' => 'nullable|max:50', 
            'email' => 'required|email|max:100',     
            'address' => 'nullable', 
            'tax_number' => 'nullable|max:50', 
            'lat' => 'nullable',                 
            'lng' => 'nullable',
            'ref_name' => 'nullable'                         
        ]);
      
        // create Company
        $company = new Company();
        $company->name = $input['name'];
        $company->phone_number = $input['phone_number'];
        $company->email = $input['email'];
        $company->address = $input['address'];
        $company->tax_number = $input['tax_number'];
        $company->lat = $input['lat'];
        $company->lng = $input['lng'];
        $company->ref_name = $input['ref_name'];
        
        if ($company->save()) return Company::find($company['id']);
        
        return response()->json('Error', 404);
    } 

    /**
     * Operation listCompanies
     *
     * List of Companies.
     *
     *
     * @return Http response
     */
    public function listCompanies()
    {
        return Company::all()->toArray();
    }

    /**
     * Operation deleteCompany
     *
     * Delete a company.
     *
     * @param int $company_id company id to delete (required)
     *
     * @return Http response
     */
    public function deleteCompany($companyId)
    {
        
        $company = Company::find($companyId);        
        if ($company) {
            $company->delete();
            return response('OK', 200);
        }
        return response('Error', 404);

    }   
    
    /**
     * Operation getCompanyById
     *
     * Find company by ID.
     *
     * @param int $company_id ID of company to return (required)
     *
     * @return Http response
     */
    public function getCompanyById($company_id)
    {
        if (empty($company_id) || (int)$company_id < 0) 
            return response()->json('Invalid ID supplied', 400);

        //get company
        $company = Company::find($company_id);

        if (is_null($company)) return response('Not found', 404);

        return $company;
    }

    /**
     * Operation updateCompany
     *
     * Updates a company.
     *
     * @param int $company_id ID of role that needs to be company (required)
     *
     * @return Http response
     */
    public function updateCompany()
    {
        $input = $this->request->all();      

        //path params validation
        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',            
            'name' => 'required|max:255',
            'phone_number' => 'nullable|max:50', 
            'email' => 'required|email|max:100',     
            'address' => 'nullable', 
            'tax_number' => 'nullable|max:50',
            'lat' => 'nullable',                 
            'lng' => 'nullable',                 
            'ref_name' => 'nullable'                          
        ]);        
      
        $company_id = $input['id'];

        if (empty($company_id) || (int)$company_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Company
        $company = Company::find($company_id);
        if (is_null($company)) return response('Not found', 404);         
        

        // set data
        $company->id = $input['id'];        
        $company->name = $input['name'];
        $company->phone_number = $input['phone_number'];
        $company->email = $input['email'];
        $company->address = $input['address'];
        $company->tax_number = $input['tax_number'];
        $company->lat = $input['lat'];
        $company->lng = $input['lng'];
        $company->ref_name = $input['ref_name'];

        if ($company->save())
            return $company;

        return response('Error', 404);     
    }   
}