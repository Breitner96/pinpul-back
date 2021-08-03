<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // use HasApiTokens, Notifiable, HasRoles;
    use Notifiable, HasRoles;

    protected $guard_name ='api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    // public function country(){
    //     return $this->belongsTo('App\Entities\Country');
    // }

    // public function city(){
    //     return $this->belongsTo('App\Entities\City');
    // }

    // public function type_document(){
    //     return $this->belongsTo('App\Entities\TypeDocument');
    // }

    public function setPass(){
        return $this->password;
    }

    public function rol(){
        return $this->belongsToMany('Spatie\Permission\Models\Role','model_has_roles','model_id');
    }

    public function permissions(){
        return $this->belongsToMany('Spatie\Permission\Models\Permission','model_has_permissions','model_id');
    }

}
