<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceAttachment;
use App\Models\Product;
use App\Models\Device;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Geolocation\PermissionService;

class DeviceAttachmentApi extends Controller
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
     * Operation createDeviceAttachment
     *
     * Create Device Attachment.
     *
     *
     * @return Http response
     */
    public function createDeviceAttachment()
    {
        $input = $this->request->all();

        //path params validation
        $this->validate($this->request, [
            'product_id' => 'bail|required|integer|min:1',
            'device_id' => 'bail|required|integer|min:1',
        ]);

        // check exist Product
        if (is_null(Product::find($input['product_id']))) 
            return response('Product does not exist', 404);

        // check exist Device
        if (is_null(Device::find($input['device_id']))) 
            return response('Device does not exist', 404);

        // check for the device used  
        $device = DeviceAttachment::where('device_id', $input['device_id'])->first();
        $product = DeviceAttachment::where('product_id', $input['product_id'])->first();

        if ($device != null) 
            return response('Device has been used.', 404);

        if ($product != null) 
            return response('Product has been used.', 404);

        $deviceAttachment = new DeviceAttachment();
        $deviceAttachment->product_id = $input['product_id'];
        $deviceAttachment->device_id = $input['device_id'];

        if ($deviceAttachment->save()) {

            $data = DeviceAttachment::find($deviceAttachment['id']);
            $data->device;

            return $data;
        }
        
        return response('Error', 404);

    }

    /**
     * Operation listDeviceAttachment
     *
     * List of device attachment.
     *
     *
     * @return Http response
     */
    public function listDeviceAttachment()
    {
        return DeviceAttachment::all()->toArray();

                // get list product
        $deviceAttachments = DeviceAttachment::all();

            foreach ($deviceAttachments as $device) {

                $device->device;
            }

        return $deviceAttachments->toArray(); 
    }

    /**
     * Operation getDeviceAttachmentByCompanyId
     *
     * Find Device Attachment by company ID.
     *
     * @param int $company_id ID of company to return (required)
     *
     * @return Http response
     */
    public function getDeviceAttachmentByProductId($product_id)
    {
        if (empty($product_id) || (int)$product_id < 0) 
            return response('Invalid ID supplied', 400);

        $deviceAttachment = DeviceAttachment::where('product_id', $product_id)->first();

        if ($deviceAttachment == null) 
            return response('Not found', 404);

        // get relation data
        $deviceAttachment->device;

        return $deviceAttachment;
    }

    /**
     * Operation deleteDeviceAttachment
     *
     * Delete a Device Attachment.
     *
     * @param int $device_attachment_id device attachment Id to delete (required)
     *
     * @return Http response
     */
    public function deleteDeviceAttachment($device_attachment_id)
    {
        if (empty($device_attachment_id) || (int)$device_attachment_id < 0) 
            return response('Invalid ID supplied', 400);

        // get AccessControl
        $deviceAttachment = DeviceAttachment::find($device_attachment_id);

        if (is_null($deviceAttachment)) 
            return response('Not found', 404);

        if ($deviceAttachment->delete())
            return response('OK', 200);
        
        return response('Error', 404);
    }
}
