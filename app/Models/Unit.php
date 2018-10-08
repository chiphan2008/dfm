<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Sofa\Eloquence\Eloquence;
// use Sofa\Eloquence\Mappable;

/**
 * @property int $id
 * @property string $name
 * @property mixed $width
 * @property mixed $height
 * @property mixed $area
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Products[] $products
 */
class Unit extends Model
{
    use SoftDeletes; 

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'units';

    /**
     * @var array
     */
    protected $fillable = ['id', 'name'];

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
    public function productType()
    {
        return $this->hasMany('App\Models\productType');
    }
}
