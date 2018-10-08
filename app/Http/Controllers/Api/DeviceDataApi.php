<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\DeviceData;
use App\Models\Device;
use App\Models\DeviceAttachment;
use App\Models\Product;
use App\Geolocation\PermissionService;

use Log;

class DeviceDataApi extends Controller
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
     * Operation createDeviceData
     *
     * Create Device Data.
     *
     *
     * @return Http response
     */
    public function createDeviceData()
    {
        $input = $this->request->all();
        
        // save input in lumen.log
        
        Log::info('Data objenious: '.json_encode($input));
        
        //params data
        $type = $input['type'];
        $lat = $input['lat'];
        $lng = $input['lng'];
        $cityCode = $input['city_code'];
        $cityName = $input['city_name'];
        $devEUI = $input['device_properties']['deveui'];
        $payloadCleartext = $input['payload_cleartext'];

        

        if ($type == 'uplink') {

            // create DeviceData
            $deviceData = new DeviceData();
            $deviceData->data_receive = json_encode($input);

            if (!$deviceData->save()) return response('Error', 404);

            // get DeviceData by id
            $deviceData = DeviceData::find($deviceData['id']);   

            if (!empty($devEUI)) {

                // get Device
                $device = Device::where('dev_eui', $devEUI)->first();
                
                if (!is_null($device)) {

                    // update device_id in deviceData
                    $deviceData->device_id = $device->id;
                    $deviceData->save();
                   
                    //Get DeviceAttachment by DeviceId
                    $deviceAttachment = DeviceAttachment::where('device_id', $device['id'])->first();
                    
                    if (!is_null($deviceAttachment)) {

                        //Get Product by DeviceAttachment
                        $product = Product::where('id', $deviceAttachment['product_id'])->first();

                        if (!is_null($product)) {

                            //Update product status (const) in Product
                            $product->product_status_id = 1;
                            $product->city_code = $cityCode;
                            $product->city_name = $cityName;
                            if (!$product->save()) return response('Can\'t update to Product', 404);
                        } 
                    } 

                    //Update Lat and Lng in Device by data receive
                    //Hex to ASCII
                    $ascii = '';
                    for($i = 0; $i < strlen($payloadCleartext); $i += 2) {
                        $ascii .= chr(hexdec(substr($payloadCleartext, $i, 2)));
                    }
                    $result = explode(';', $ascii);
                    
                    // Check lat, lng
                    if (isset($result[0])) {
                        if (is_numeric(trim($result[0])) && $result[0] > 0) {
                            $device->lat = trim($result[0]);
                        } else {
                            $device->lat = $lat;
                        }
                    }
                    if (isset($result[1])) {
                        if (is_numeric(trim($result[1])) && $result[1] > 0) {
                            $device->lng = trim($result[1]);
                        } else {
                            $device->lng = $lng;
                        }
                    }            
                    // Update battery in Device 
                    if (isset($result[2])) {
                        $device->battery = trim($result[2]);

                        $maxBattery = 4.25;
                        $minBattery = 3.25;
                        $lowBattery = ((($maxBattery - $minBattery) / 100) * 20) + $minBattery;

                        if ($device->battery < $lowBattery) {
                            $device->status_id = 2;
                        }
                    }
                    // auto wakeup
                    if (isset($result[3])) {
                        $device->autowakeup = trim($result[3]);
                    }
                    // sensity of autowakeup
                    if (isset($result[4])) {
                        $device->sensity_of_autowakeup = trim($result[4]);
                    }

                    if (!$device->save()) return response('Can\'t update to Device', 404);
                }
            }
            return $deviceData;
        }

        if ($type == 'downlink') {
            // create DeviceData
            $deviceData = new DeviceData();
            $deviceData->data_receive = json_encode($input);

            var_dump($deviceData->data_receive);
            if (!$deviceData->save()) return response('Error', 404);

            // get DeviceData by id
            $deviceData = DeviceData::find($deviceData['id']); 

            if (!empty($devEUI)) {

                // get Device
                $device = Device::where('dev_eui', $devEUI)->first();
                
                if (!is_null($device)) {

                    // update device_id in deviceData
                    $deviceData->device_id = $device->id;
                    $deviceData->save();
                   
                    //Get DeviceAttachment by DeviceId
                    $deviceAttachment = DeviceAttachment::where('device_id', $device['id'])->first();
                    
                    if (!is_null($deviceAttachment)) {

                        //Get Product by DeviceAttachment
                        $product = Product::where('id', $deviceAttachment['product_id'])->first();

                        if (!is_null($product)) {

                            //Update product status (const) in Product
                            $product->product_status_id = 1;
                            $product->city_code = $cityCode;
                            $product->city_name = $cityName;
                            if (!$product->save()) return response('Can\'t update to Product', 404);
                        } 
                    } 
                }
            }
            return $deviceData;
        }

        return response('Error', 404);
    }

    /**
     * Operation listDeviceData
     *
     * List of device data.
     *
     *
     * @return Http response
     */
    public function listDeviceData()
    {
        return DeviceData::all()->toArray();
    }

    /**
     * Operation listDeviceDataByDeviceId
     *
     * List of device data by device id.
     *
     * @param int $device_id ID of device to return (required)
     *
     * @return Http response
     */
    public function listDeviceDataByDeviceId($device_id)
    {
        //path params validation
        if (empty($device_id) || (int)$device_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Device Data
        $deviceData = DeviceData::where('device_id', $device_id)->get();

        if (count($deviceData) <= 0) return response('Not found', 404);

        return $deviceData;
    }

    /**
     * Operation deleteDeviceData
     *
     * Delete a Device Data.
     *
     * @param int $device_data_id device Data Id to delete (required)
     *
     * @return Http response
     */
    public function deleteDeviceData($device_data_id)
    {
        //path params validation
        if (empty($device_data_id) || (int)$device_data_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Device Data
        $deviceData = DeviceData::find($device_data_id);

        if (is_null($deviceData)) return response('Not found', 404);

        if ($deviceData->delete()) return response('OK', 200);
        
        return response('Error', 404);
    }

    /**
     * Operation getDeviceDataById
     *
     * Find Device Data by ID.
     *
     * @param int $device_data_id ID of device to return (required)
     *
     * @return Http response
     */
    public function getDeviceDataById($device_data_id)
    {
        if (empty($device_data_id) || (int)$device_data_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Device Data
        $deviceData = DeviceData::find($device_data_id);

        if (is_null($deviceData)) return response('Not found', 404);

        return $deviceData;
    }

    /**
     * Operation updateDeviceData
     *
     * Updates a Device Data.
     *
     *
     * @return Http response
     */
    public function updateDeviceData()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'id' => 'required|integer|min:1',            
            'device_id' => 'required|integer|min:1',
            'data_receive' => 'nullable'
        ]);

        $device_data_id = $input['id'];

        if (empty($device_data_id) || (int)$device_data_id < 0) 
            return response('Invalid ID supplied', 400);

        // get Device Data
        $deviceData = DeviceData::find($device_data_id);
        
        if (is_null($deviceData)) return response('Not found', 404);   

        // update device data  
        $deviceData->device_id = $input['device_id'];
        $deviceData->data_receive = trim($input['data_receive']);

        if ($deviceData->save()) return $deviceData;
        
        return response('Error', 404);                
    }
}
