<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buydeposite extends Model
{
    protected $fillable = ['admin_id', 'tokenBuy', 'nominal'];

    public function scopeSearchByKeyword($query, $keyword)
    {
    	if ($keyword!='') {
    		$query->where(function ($query) use ($keyword){
    			$query->where("admin_id", "LIKE", "%$keyword%")
                      ->orwhere("tokenBuy", "LIKE", "%$keyword%")
    				  ->orWhere("nominal", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
