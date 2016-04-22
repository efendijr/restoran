<?php

namespace App;

use App\Warung;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $fillable = ['user_id', 'nameMakanan', 'slugMakanan', 'descriptionMakanan', 'priceMakanan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
    	if ($keyword!='') {
    		$query->where(function ($query) use ($keyword){
    			$query->where("nameMakanan", "LIKE", "%$keyword%")
    				  ->orWhere("descriptionMakanan", "LIKE", "%$keyword%")
    				  ->orWhere("priceMakanan", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
