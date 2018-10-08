<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;


class UnitsApi extends Controller
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
     * Operation createUnit
     *
     * Create Unit.
     *
     *
     * @return Http response
     */
    public function createUnit()
    {
        $input = $this->request->all();

        $this->validate($this->request, [
          'name' => 'bail|required|max:100'
        ]);

        $unit = new Unit();
        $unit->name = $input['name'];

        if ($unit->save())
          return Unit::find($unit->id);

        return response('Error', 404);
    }
    /**
     * Operation listUnits
     *
     * List of Units.
     *
     *
     * @return Http response
     */
    public function listUnits()
    {
        return Unit::all()->toArray();
    }
    /**
     * Operation updateUnit
     *
     * Update a Unit.
     *
     *
     * @return Http response
     */
    public function updateUnit()
    {
        $input = $this->request->all();

        $this->validate($this->request, [
          'id' => 'bail|required|min:1',
          'name' => 'bail|required|max:100'
        ]);

        $unit = Unit::find($input['id']);

        // check exists unit
        if (is_null($unit))
          return response('Not found', 404);

        $unit->name = $input['name'];

        if ($unit->save())
          return Unit::find($unit->id);

        return response('Error', 404);
    }
    /**
     * Operation deleteUnit
     *
     * Delete a Unit.
     *
     * @param int $unit_id Unit Id to delete (required)
     *
     * @return Http response
     */
    public function deleteUnit($unit_id)
    {
        if (empty($unit_id) || (int)$unit_id < 0)
          return response('Invalid ID supplied', 400);

        $unit = Unit::find($unit_id);

        // check exists unit
        if (is_null($unit))
          return response('Not found', 404);

        if ($unit->delete())
          return response('OK'. 200);

        return response('Error', 404);
    }
    /**
     * Operation getUnitById
     *
     * Find unit by ID.
     *
     * @param int $unit_id ID of Unit to return (required)
     *
     * @return Http response
     */
    public function getUnitById($unit_id)
    {
        if (empty($unit_id) || (int)$unit_id < 0)
          return response('Invalid ID supplied', 400);

        $unit = Unit::find($unit_id);

        // check exists unit
        if (is_null($unit))
          return response('Not found', 404);

        if (isset($unit))
          return $unit;

        return response('Error', 404);
    }
}
