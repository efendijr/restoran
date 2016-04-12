<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TesController extends Controller
{
    public function index()
    {
    	$kurang = 10;
    	$tes = DB::table('anggota')->where('id', 7);
    	
    	
    	// $tes->decrement('deposite', $kurang);
    	$tes->decrement('deposite', $kurang);

        if ($tes != false) {
        	$hasil = DB::table('anggota')->where('id', 7)->get();
        	return $hasil;
        } else {
        	return "gagal";
        }
    }
}
