<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = ['kecamatanName', 'kecamatanTarif'];

    public function scopeSearchByKeyword($query, $keyword)
    {
    	if ($keyword!='') {
    		$query->where(function ($query) use ($keyword){
    			$query->where("kecamatanName", "LIKE", "%$keyword%")
                      ->orwhere("kecamatanTarif", "LIKE", "%$keyword%");
    		});
    	}

        return $query;
    }


}
