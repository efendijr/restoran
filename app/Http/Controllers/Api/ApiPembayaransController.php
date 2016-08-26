<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Pembayaran;
use Illuminate\Http\Request;

class ApiPembayaransController extends Controller
{
    public function tambahPembayaran(Request $request)
    {
    	$getAlamat = $request->get('alamatId');
    	$getSubTotal = $request->get('subTotal');
    	$getBiayaKirim = $request->get('biayaKirim');
    	$getMetodeBayar = $request->get('metodeBayar');
    	$getkodeBayar = $request->get('kodeBayar');
    	$getTotal = $request->get('subTotal');

    	$addBayar = Pembayaran::create([
    				'alamat_id' => $getAlamat,
    				'subTotal' => $getSubTotal,
    				'biayaKirim' => $getBiayaKirim,
    				'totalBayar' => $getTotal,
    				'metodePembayaran' => $getMetodeBayar,
    				'kodePembayaran' => $getkodeBayar,
    				'statusPembayaran' => 'diproses'
    				]);

    	return null;
    }
    
}
