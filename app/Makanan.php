<?php

namespace App;

use App\Warung;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $fillable = ['user_id', 'category_id', 'nameMakanan', 'slugMakanan', 'descriptionMakanan', 'priceMakanan'];

    public function scopeSearchByKeyword($query, $keyword)
    {
    	if ($keyword!='') {
    		$query->where(function ($query) use ($keyword){
    			$query->where("nameMakanan", "LIKE", "%$keyword%")
                      ->orWhere("category", "LIKE", "%$keyword%")
    				  ->orWhere("descriptionMakanan", "LIKE", "%$keyword%")
    				  ->orWhere("priceMakanan", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
    

    
}
