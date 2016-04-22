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
                      ->orwhere("token", "LIKE", "%$keyword%")
    				  ->orWhere("nominal", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
