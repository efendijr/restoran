<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $fillable = ['payment_id', 'nameReceiver', 'alamatReceiver', 'phoneReceiver', 'status'];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword){
                $query->where("payment_id", "LIKE", "%$keyword%")
                      ->orWhere("usernameMember", "LIKE", "%$keyword%")
                      ->orWhere("alamat", "LIKE", "%$keyword%")
                      ->orWhere('status', "LIKE", "%$keyword%");
            });
        }

        return $query;
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
