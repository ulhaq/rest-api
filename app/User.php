<?php

namespace App;

use App\Traits\Searchable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Http\Contracts\Role as RoleContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject, RoleContract
{
    use Notifiable, Searchable;

    /**
     * The attributes that are searchable.
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'email',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot',
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

    /**
     * Return true if the user has the role otherwise false.
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        return $this->roles->where('name', $role)->first() !== null;
    }

    /**
     * Return true if the user is equal to user.
     *
     * @return boolean
     */
    public function isUser($user)
    {
        return $this->id === $user->id;
    }

    /**
     * The teams that belong to the user.
     */
    public function teams()
    {
        return $this->belongsToMany('App\Team')->withTimestamps();
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }
}
