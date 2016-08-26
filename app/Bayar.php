<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $fillable = ['member_id', 'biayaKirim'];

    public function members()
    {
      return $this->belongTo(Member::class);
    }

}
