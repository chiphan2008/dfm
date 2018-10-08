<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessControlList;
use App\Models\AccessResourceList;
use App\Models\Role;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;

class AccessControlsApi extends Controller
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
     * Operation createAccessControl
     *
     * Create Access Control.
     *
     *
     * @return Http response
     */
    public function createAccessControl()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'role_id' => 'bail|required|integer|min:1',
            'resource_id' => 'bail|required|integer|min:1'
        ]);

        // check exist Role
        if (is_null(Role::find($input['role_id']))) 
            return response('Role does not exist.', 404);

        // check exist Access Resource
        if (is_null(AccessResourceList::find($input['resource_id'])))
            return response('Access Resource does not exist.', 404);             

        // check Already Exist
        if (!is_null(AccessControlList::where('role_id', $input['role_id'])
                    ->where('resource_id', $input['resource_id'])
                    ->first() )) 
            return response('Access Control already exist.', 404);

        // create Access Control
        $accessControl = new AccessControlList();
        $accessControl->role_id = $input['role_id'];
        $accessControl->resource_id = $input['resource_id'];

        if ($accessControl->save())
            return AccessControlList::find($accessControl->id);

        return response('Error', 404);
    }

    /**
     * Operation getAccessResourceByRoleId
     *
     * Find list Access Control  by role ID.
     *
     * @param int $role_id ID of role to return (required)
     *
     * @return Http response
     */
    public function getAccessResourceByRoleId($role_id)
    {
        if (empty($role_id) || (int)$role_id < 0)
            return response('Invalid ID supplied', 400);

        // check exist Role
        if (is_null(Role::find($role_id))) 
            return response('Role does not exist.', 404);

        // get list Access Control
        $accessControl = AccessControlList::where('role_id', $role_id)->get();

        return $accessControl->toArray();
    }

    /**
     * Operation deleteAccessControl
     *
     * Deletes a Access Control.
     *
     * @param int $access_control_id access_control Id to delete (required)
     *
     * @return Http response
     */
    public function deleteAccessControl($access_control_id)
    {
        if (empty($access_control_id) || (int)$access_control_id < 0)
            return response('Invalid ID supplied', 400);

        // get access control
        $accessControl = AccessControlList::find($access_control_id);

        if (is_null($accessControl)) 
            return response('Not found', 404);

        if ($accessControl->delete())
            return response('OK', 200);
        
        return response('Error', 404);
    }

    /**
     * Operation getAccessControlById
     *
     * Find Access Control by ID.
     *
     * @param int $access_control_id ID of Access Control to return (required)
     *
     * @return Http response
     */
    public function getAccessControlById($access_control_id)
    {
        if (empty($access_control_id) || (int)$access_control_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Access Control
        $accessControl = AccessControlList::find($access_control_id);

        if (is_null($accessControl)) 
            return response('Not found', 404);

        return $accessControl;
    }

    /**
     * Operation updateAccessControl
     *
     * Updates a Access Control.
     *
     * @param int $access_control_id ID of access control that needs to be updated (required)
     *
     * @return Http response
     */
    public function updateAccessControl()
    {
        return response('How about implementing updateAccessControl as a PATCH method ?');
    }
}
