<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRole($role)
    {
        return $this->hasRole($role) ||
            abort('401', 'Usuário com permissões inválidas.');
    }

    /**
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}


