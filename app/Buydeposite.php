<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buydeposite extends Model
{
    protected $fillable = ['token', 'nominal'];

    public function scopeSearchByKeyword($query, $keyword)
    {
    	if ($keyword!='') {
    		$query->where(function ($query) use ($keyword){
    			$query->where("token", "LIKE", "%$keyword%")
    				  ->orWhere("nominal", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }

}
