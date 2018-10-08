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
class ProductType extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_types';

    /**
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'name', 'unit_1', 'unit_2', 'unit_3', 'value_1', 'value_2', 'value_3', 'deleted_at'];

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
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'product_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit_1_data()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit_2_data()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit_3_data()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_3');
    }
}
