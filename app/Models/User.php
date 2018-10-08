<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property int $role_id
 * @property int $company_id
 * @property string $phone_number
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $login_date
 * @property \Carbon\Carbon $logout_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Roles $roles
 * @property-read Companies $companies
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use SoftDeletes, Authenticatable, Authorizable;

    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = ['id', 'company_id', 'role_id', 'phone_number', 'username', 'password', 'email', 'token', 'login_date', 'logout_date', 'deleted_at', 'full_name'];
    /**
     * @var array
     */
    protected $dates = ['login_date', 'logout_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
