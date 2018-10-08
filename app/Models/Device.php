<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $rfid
 * @property mixed $lat
 * @property mixed $lng
 * @property string $description
 * @property string $mac_address
 * @property string $dev_eui
 * @property string $app_eui
 * @property string $dev_address
 * @property string $app_skey
 * @property string $nwk_skey
 * @property string $data_send
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read DeviceAttachments[] $deviceAttachments
 * @property-read DeviceDatas[] $deviceDatas
 */
class Device extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'rfid', 'lat', 'lng', 'battery', 'autowakeup', 'sensity_of_autowakeup', 'description', 'mac_address', 'dev_eui', 'app_eui', 'dev_address', 'app_skey', 'nwk_skey', 'data_send', 'deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'lat' => 'real',
        'lng' => 'real'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deviceAttachment()
    {
        return $this->hasMany('App\Models\DeviceAttachment', 'device_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deviceData()
    {
        return $this->hasMany('App\Models\DeviceData', 'device_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }


}
