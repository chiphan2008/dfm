<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessResourceList;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;

class AccessResourcesApi extends Controller
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
     * Operation createAccessResource
     *
     * Create access resource.
     *
     *
     * @return Http response
     */
    public function createAccessResource()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        // set data
        $name = trim($input['name']);
        $description = trim($input['description']);

        // check exist
        if (!is_null(AccessResourceList::where('name', $name)->first()))
            return response('Access Resource already exist', 404);        

        // create Access Resource
        $accessResource = new AccessResourceList();
        $accessResource->name = $name;
        $accessResource->description = $description;

        if ($accessResource->save())
            return AccessResourceList::find($accessResource->id);

        return response('Error', 404);
    }

    /**
     * Operation listAccessResources
     *
     * List of AccessResources.
     *
     *
     * @return Http response
     */
    public function listAccessResources()
    {
        return AccessResourceList::all()->toArray();
    }

    /**
     * Operation deleteAccessResource
     *
     * Deletes a AccessResource.
     *
     * @param int $access_resource_id AccessResource Id to delete (required)
     *
     * @return Http response
     */
    public function deleteAccessResource($access_resource_id)
    {
        if (empty($access_resource_id) || (int)$access_resource_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Access Resource
        $accessResource = AccessResourceList::find($access_resource_id);

        if (is_null($accessResource)) 
            return response('Not found', 404);

        if ($accessResource->delete())
            return response('OK', 200);
        
        return response('Error', 404);
    }

    /**
     * Operation getAccessResourceById
     *
     * Find Access Page by ID.
     *
     * @param int $access_resource_id ID of AccessResource to return (required)
     *
     * @return Http response
     */
    public function getAccessResourceById($access_resource_id)
    {
        if (empty($access_resource_id) || (int)$access_resource_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Access Resource
        $accessResource = AccessResourceList::find($access_resource_id);

        if (is_null($accessResource)) 
            return response('Not found', 404);

        return $accessResource;
    }

    /**
     * Operation updateAccessResource
     *
     * Updates a AccessResource.
     *
     * @param int $access_resource_id ID of access resource that needs to be updated (required)
     *
     * @return Http response
     */
    public function updateAccessResource()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',            
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $access_resource_id = $input['id'];

        if (empty($access_resource_id) || (int)$access_resource_id < 0)
            return response('Invalid ID supplied', 400);
        
        // set data
        $name = trim($input['name']);
        $description = trim($input['description']);

        // get Access Resource
        $accessResource = AccessResourceList::find($access_resource_id);

        if (is_null($accessResource)) return response('Not found', 404);

        // check exist
        if ($name != $accessResource->name) {

            if (!is_null(AccessResourceList::where('name', $name)->first()))
                return response('Access Resource already exist', 404);
        }

        // update Access Resource
        $accessResource->name = $name;
        $accessResource->description = $description;

        if ($accessResource->save())
            return $accessResource;
        
        return response('Error', 404);
    }
}
