<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Sofa\Eloquence\Eloquence;
// use Sofa\Eloquence\Mappable;

/**
 * @property int $id
 * @property int $product_status_id
 * @property int $product_type_id
 * @property int $company_id
 * @property string $name
 * @property string $description
 * @property mixed $rent_price
 * @property \Carbon\Carbon $manufacture_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read ProductStatus $productStatus
 * @property-read ProductTypes $productTypes
 * @property-read Companies $companies
 * @property-read DeviceAttachments[] $deviceAttachments
 * @property-read ProductRents[] $productRents
 */
class Product extends Model
{
    use SoftDeletes; 
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = ['id', 'product_status_id', 'product_type_id', 'company_id', 'name', 'description', 'rent_price', 'manufacture_date', 'city_code', 'city_name', 'deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['manufacture_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['product_status_id', 'product_type_id', 'company_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productStatus()
    {
        return $this->belongsTo('App\Models\ProductStatus', 'product_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType', 'product_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deviceAttachment()
    {
        return $this->hasMany('App\Models\DeviceAttachment', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productRent()
    {
        return $this->hasMany('App\Models\ProductRent', 'product_id');
    }
}
