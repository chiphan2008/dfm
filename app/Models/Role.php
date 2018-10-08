<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Sofa\Eloquence\Eloquence;
// use Sofa\Eloquence\Mappable;

/**
 * @property int $id
 * @property string $role_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read AccessPageList[] $accessPageLists
 * @property-read Users[] $users
 */
class Role extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = ['id', 'role_name', 'deleted_at'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['role_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accessPageList()
    {
        return $this->hasMany('App\Models\AccessPageList', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany('App\Models\User', 'role_id');
    }
}
