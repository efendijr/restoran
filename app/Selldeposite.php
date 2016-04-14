<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selldeposite extends Model
{
    protected $fillable = ['token', 'nominal', 'member_id'];

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


    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
