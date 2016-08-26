<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kirim extends Model
{
    protected $fillable = ['bayar_id', 'alamat_id', 'statusKirim'];

    public function bayars()
    {
      return $this->belongTo(Bayar::class);
    }
}
