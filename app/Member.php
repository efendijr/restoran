<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['nameMember', 'emailMember', 'usernameMember', 'password'];

    public function scopeSearchByKeyword($query, $keyword)
    {
    	if ($keyword!='') {
    		$query->where(function ($query) use ($keyword){
    			$query->where("nameMember", "LIKE", "%$keyword%")
    				  ->orWhere("usernameMember", "LIKE", "%$keyword%")
    				  ->orWhere("emailMember", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }

    public function selldeposite()
    {
        return $this->hasMany(Selldeposite::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

}
