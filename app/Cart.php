<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['makanan_id', 'quantity'];


    public function members()
    {
    	return $this->belongsToMany(Member::class);
    }

    public function makanans()
    {
    	return $this->belongsToMany(Makanan::class);
    }
    
    
}
