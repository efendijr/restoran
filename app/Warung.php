<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Warung extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameWarung', 'emailWarung', 'password', 'descriptionWarung', 'aliasWarung', 'addressWarung'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function makanans()
    {
        return $this->hasMany(Makanan::class);
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword){
                $query->where("nameWarung", "LIKE", "%$keyword%")
                	  ->orWhere("descriptionWarung", "LIKE", "%$keyword%")
                	  ->orWhere("aliasWarung", "LIKE", "%$keyword%")
                      ->orWhere("addressWarung", "LIKE", "%$keyword%");
            });
        }

        return $query;
    }
}
