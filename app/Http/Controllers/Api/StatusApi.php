<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Geolocation\PermissionService;

class StatusApi extends Controller
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
     * Operation createStatus
     *
     * Create Status.
     *
     *
     * @return Http response
     */
    public function createStatus()
    {
        $input = $this->request->all();

        // Check validation input
        $this->validate($this->request, [
          'name' => 'required|max:100',
          'description' => 'required|max:255'
        ]);

        $status = new Status();
        $status->name = trim($input['name']);
        $status->description = trim($input['description']);

        // Save status
        if($status->save()) 
          return Status::find($status['id']);

        return response('Error', 404);
    }
    /**
     * Operation listStatus
     *
     * List of Status.
     *
     *
     * @return Http response
     */
    public function listStatus()
    {
        return Status::all()->toArray();
    }
    /**
     * Operation updateStatus
     *
     * Updates a status.
     *
     *
     * @return Http response
     */
    public function updateStatus()
    {
        $input = $this->request->all();

        $this->validate($this->request, [
          'id' => 'required|integer|min:0',
          'name' => 'required|max:100',
          'description' => 'required|max:255'
        ]);

        $status = Status::find($input['id']);

        // Check exists status id
        if(is_null($status))
          return response('Can\'t find status id', 404);

        // Check empty name and description
        if(empty($input['name']) || empty($input['description']))
          return response('Name or descriptoion can\'t empty', 400);

        $status->name = $input['name'];
        $status->description = $input['description'];
        
        // Update status
        if($status->save()) 
          return Status::find($status['id']);

        return response('Error Update Status', 404);

    }
    /**
     * Operation deleteStatus
     *
     * Delete a Status.
     *
     * @param int $status_id Status Id to delete (required)
     *
     * @return Http response
     */
    public function deleteStatus($status_id)
    {
        // Check input
        if($status_id < 0 || empty($status_id))
          return response('Invalid ID supplied', 400);

        $status = Status::find($status_id);

        // Check exist Status
        if (is_null($status)) 
            return response('Not found', 404);

        // Delete status
        if ($status->delete())
            return response('OK', 200);
        
        return response('Error', 404);

    }
    /**
     * Operation getStatusById
     *
     * Find status by ID.
     *
     * @param int $status_id ID of Status to return (required)
     *
     * @return Http response
     */
    public function getStatusById($status_id)
    {
        //Check input
        if($status_id < 0 || empty($status_id))
          return response('Invalid ID supplied', 400);

        $status = Status::where('id', $status_id)->first();
        
        // Check exist Status
        if(is_null($status))
          return response('Not found', 404);

        return $status;
    }
}
