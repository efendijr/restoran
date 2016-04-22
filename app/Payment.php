<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $fillable = ['makanan_id', 'member_id', 'price', 'quantity', 'total'];


    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class);
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
    	if ($keyword!='') {
    		$query->where(function ($query) use ($keyword){
    			$query->where("makanan_id", "LIKE", "%$keyword%")
    				  ->orWhere("member_id", "LIKE", "%$keyword%")
    				  ->orWhere("price", "LIKE", "%$keyword%")
    				  ->orWhere("quantity", "LIKE", "%$keyword%")
    				  ->orWhere("total", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }
}
