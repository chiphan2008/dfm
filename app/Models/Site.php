<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Sofa\Eloquence\Eloquence;
// use Sofa\Eloquence\Mappable;

/**
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $address
 * @property mixed $lat
 * @property mixed $lng
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Companies $companies
 * @property-read Status $status
 */
class Site extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * @var array
     */
    protected $fillable = ['id', 'company_id', 'name', 'address', 'area', 'area_ml', 'lat', 'lng', 'max_radius', 'src', 'city_code', 'city_name', 'deleted_at'];

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'lat' => 'real',
        'lng' => 'real'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
}
