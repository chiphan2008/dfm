<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Sofa\Eloquence\Eloquence;
// use Sofa\Eloquence\Mappable;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Storages[] $storages
 * @property-read Devices[] $devices
 */
class Status extends Model
{
    use SoftDeletes; 
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storage()
    {
        return $this->hasMany('App\Models\Storage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function device()
    {
        return $this->hasMany('App\Models\Device');
    }

}
