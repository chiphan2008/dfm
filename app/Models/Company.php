<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Sofa\Eloquence\Eloquence;
// use Sofa\Eloquence\Mappable;

/**
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property string $address
 * @property string $tax_number
 * @property string $ref_name
 * @property mixed $lat
 * @property mixed $lng
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read CapteurAttachments[] $capteurAttachments
 * @property-read Capteurs[] $capteurs
 * @property-read Sites[] $sites
 * @property-read Users[] $users
 * @property-read Storages[] $storages
 */
class Company extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'phone_number', 'email', 'address', 'tax_number', 'lat', 'lng', 'ref_name', 'deleted_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function capteurAttachment()
    {
        return $this->hasMany('App\Models\CapteurAttachment', 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function capteur()
    {
        return $this->hasMany('App\Models\Capteur', 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function site()
    {
        return $this->hasMany('App\Models\Site', 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany('App\Models\User', 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function storage()
    {
        return $this->hasMany('App\Models\Storage', 'company_id');
    }

}
