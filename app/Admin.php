<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameAdmin', 'emailAdmin', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function buydeposite()
    {
        return $this->hasMany(Buydeposite::class);
    }

    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class);
    }

}
