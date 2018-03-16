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

    public function role() {
        return $this->belongsToMany('App\Role');
    }

    public function profile() {
        return $this->hasOne('App\Profile');
    }

    public function order() {
        return $this->hasMany('App\Order');
    }

    public function attachRole($role) {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        return $this->role()->attach($role);
    }

    public function detachRole($role) {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        return $this->role()->detach($role);
    }

    public function hasRole($name) {
        foreach ($this->role as $role) {
            if ($role->name === $name) {
                return true;
            }
        } return false;
    }

    public function hasAdmin() {
        if ($this->hasRole('admin')) {
            return true;
        }
        return false;
    }

    public function createProfile() {
        return Profile::create(['user_id' => $this->id]);
    }
}
