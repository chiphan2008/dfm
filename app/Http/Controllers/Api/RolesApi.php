<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Geolocation\PermissionService;

class RolesApi extends Controller
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
     * Operation listRoles
     *
     * List of roles.
     *
     *
     * @return Http response
     */
    public function listRoles()
    {
        //$isAllow = $this->permission->isAllow('settings', 'listRoles');
        // get list roles
        $role = Role::all();

        return  $role->toArray();
    }

     /**
     * Operation createRole
     *
     * Create Role.
     *
     *
     * @return Http response
     */
    public function createRole()
    {
        $input = $this->request->all();

        $this->validate($this->request, [
            'role_name' => 'required|max:100',
        ]);
         
        $role = new Role();
        $role->role_name = $input['role_name'];

        if ($role->save()) return Role::find($role['id']);
        
        return response('Error', 404);
    }

    /**
     * Operation deleteRole
     *
     * Deletes a role.
     *
     * @param int $role_id role id to delete (required)
     *
     * @return Http response
     */
    public function deleteRole($role_id)
    {
        if (empty($role_id) || (int)$role_id < 0) 
            return response()->json('Invalid ID supplied', 400);
        
        // get book
        $role = Role::find($role_id);

        if (is_null($role)) 
            return response()->json('Role not found', 404);

        if ($role->delete())
            return response('oki', 200);
        
        return response()->json('Error', 404);
    }

    /**
     * Operation getRoleById
     *
     * Find role by ID.
     *
     * @param int $role_id ID of role to return (required)
     *
     * @return Http response
     */
    public function getRoleById($role_id)
    {
        if (empty($role_id) || (int)$role_id < 0) 
            return response()->json('Invalid ID supplied', 400);
        
        // get Role
        $role = Role::find($role_id);

        if (is_null($role)) 
            return response('Not found', 404);
        
        return $role;
    }

    /**
     * Operation updateRole
     *
     * Updates a role.
     *
     * @param int $role_id ID of role that needs to be updated (required)
     *
     * @return Http response
     */
    public function updateRole($role_id)
    {   
        // data request
        $input = $this->request->all();

        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',             
            'role_name' => 'required|max:100',
        ]);
         
        $role_id = $input['id'];  
               
        // get Role
        $role = Role::find($role_id);

        if (is_null($role)) return response()->json('Role not found', 404);

        $role->role_name = $input['role_name'];
        
        if ($role->save()) return $role;
        
        return response('Error', 404);
    }
}
