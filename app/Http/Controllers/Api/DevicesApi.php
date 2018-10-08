<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;

class DevicesApi extends Controller
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
     * Operation createDevice
     *
     * Create Device.
     *
     *
     * @return Http response
     */
    public function createDevice()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'name' => 'required|max:100',
            'rfid' => 'required|max:50',
            'lat' => 'nullable|numeric|min:0',
            'lng' => 'nullable|numeric|min:0',
            'description' => 'nullable',
            'mac_address' => 'nullable|max:50',
            'dev_eui' => 'nullable|max:50',
            'app_eui' => 'nullable|max:50',
            'dev_address' => 'nullable|max:50',
            'app_skey' => 'nullable|max:50',
            'nwk_skey' => 'nullable|max:50',
            'is_send' => 'required',
            'sleep_time' => 'nullable|integer',
            'data_send' => 'nullable'
        ]);        

        // Create Device
        $device = new Device();
        $device->name = trim($input['name']);
        $device->rfid = trim($input['rfid']);
        $device->lat = $input['lat'];
        $device->lng = $input['lng'];
        $device->description = trim($input['description']);        
        $device->mac_address = trim($input['mac_address']);        
        $device->dev_eui = trim($input['dev_eui']);        
        $device->app_eui = trim($input['app_eui']);        
        $device->dev_address = trim($input['dev_address']);        
        $device->app_skey = trim($input['app_skey']);        
        $device->nwk_skey = trim($input['nwk_skey']);
        $device->is_send = $input['is_send'] == 'true' ? 1 : 0;
        $device->sleep_time = $input['sleep_time'];
        $device->data_send = trim($input['data_send']);                                

        if ($device->save()) return Devices::find($device['id']);

        return response('Error', 404);
    }

    /**
     * Operation listDevices
     *
     * List of Devices.
     *
     *
     * @return Http response
     */
    public function listDevices()
    {
        return Device::all()->toArray();
    }

    /**
     * Operation deleteDevice
     *
     * Delete a Device.
     *
     * @param int $device_id device Id to delete (required)
     *
     * @return Http response
     */
    public function deleteDevice($device_id)
    {
        //path params validation
        if (empty($device_id) || (int)$device_id < 0) 
            return response('Invalid ID supplied', 400);

        // get device
        $device = Device::find($device_id);

        if (is_null($device)) return response('Not found', 404);

        if ($device->delete()) return response('OK', 200);
        
        return response('Error', 404);
    }

    /**
     * Operation getDeviceById
     *
     * Find Device by ID.
     *
     * @param int $device_id ID of device to return (required)
     *
     * @return Http response
     */
    public function getDeviceById($device_id)
    {
        if (empty($device_id) || (int)$device_id < 0) 
            return response('Invalid ID supplied', 400);

        // get device
        $device = Device::find($device_id);

        if (is_null($device)) return response('Not found', 404);

        return $device;
    }

    /**
     * Operation updateDevice
     *
     * Updates a device.
     *
     * @param int $device_id ID of device (required)
     *
     * @return Http response
     */
    public function updateDevice()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'id' => 'bail|required|integer|min:1',             
            'name' => 'required|max:100',
            'rfid' => 'required|max:50',
            'lat' => 'nullable|numeric|min:0',
            'lng' => 'nullable|numeric|min:0',
            'description' => 'nullable',
            'mac_address' => 'nullable|max:50',
            'dev_eui' => 'nullable|max:50',
            'app_eui' => 'nullable|max:50',
            'dev_address' => 'nullable|max:50',
            'app_skey' => 'nullable|max:50',
            'nwk_skey' => 'nullable|max:50',
            'is_send' => 'required',
            'sleep_time' => 'nullable|integer',
            'data_send' => 'nullable'
        ]);

        $device_id = $input['id'];

        if (empty($device_id) || (int)$device_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Device
        $device = Device::find($device_id);

        if (is_null($device)) return response('Not found', 404);     

        // update Device
        $device->name = trim($input['name']);
        $device->rfid = trim($input['rfid']);
        $device->lat = $input['lat'];
        $device->lng = $input['lng'];
        $device->description = trim($input['description']);        
        $device->mac_address = trim($input['mac_address']);        
        $device->dev_eui = trim($input['dev_eui']);        
        $device->app_eui = trim($input['app_eui']);        
        $device->dev_address = trim($input['dev_address']);        
        $device->app_skey = trim($input['app_skey']);        
        $device->nwk_skey = trim($input['nwk_skey']);
        $device->is_send = $input['is_send'] == 'true' ? 1 : 0;
        $device->sleep_time = $input['sleep_time'];
        $device->data_send = trim($input['data_send']);  

        if ($device->save()) return $device;
        
        return response('Error', 404);
    }
}
