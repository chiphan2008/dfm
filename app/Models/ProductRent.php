<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Sofa\Eloquence\Eloquence;
// use Sofa\Eloquence\Mappable;

/**
 * @property int $id
 * @property int $company_id
 * @property int $product_id
 * @property int $transfer_numofdate
 * @property \Carbon\Carbon $rent_date
 * @property \Carbon\Carbon $expired_date
 * @property string $cmd
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Companies $companies
 * @property-read Products $products
 */
class ProductRent extends Model
{
    use  SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_rents';

    /**
     * @var array
     */
    protected $fillable = ['id', 'company_id', 'product_id', 'transfer_numofdate', 'rent_date', 'expired_date', 'cmt', 'ref_name', 'deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['rent_date', 'expired_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

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
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
