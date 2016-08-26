<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $fillable = ['member_id', 'namaPenerima', 'alamatPenerima', 'kecamatanPenerima', 'telponPenerima', 'kodepos'];

    public function members()
    {
    	return $this->belongsToMany(Member::class);
    }
}
