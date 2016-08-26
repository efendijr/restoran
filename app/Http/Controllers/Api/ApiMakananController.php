<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Makanan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiMakananController extends Controller
{
    public function list(User $user)
    {

    	$makanan = DB::table('makanans')
                    ->join('users', 'users.id', '=', 'makanans.user_id')
                    ->select('makanans.id', 'makanans.user_id', 'makanans.nameMakanan', 'makanans.descriptionMakanan',
                        'makanans.priceMakanan', 'makanans.diskonMakanan', 'lastPriceMakanan', 'makanans.thumbMakanan', 'makanans.updated_at', 'users.name', 'users.email', 'users.description', 'users.address', 'users.thumb')
                    ->orderBy('makanans.id', 'DESC')
                    ->get();
        return (array('makanan' => $makanan));
    }

     public function listmakanan(User $user)
    {
        $makanan = Makanan::where('category', 'makanan')
                    ->orderBy('id', 'DESC')
                    ->get();
        return (array('makanan' => $makanan));
    }
     public function listminuman(User $user)
    {

        $makanan = Makanan::where('category', 'minuman')
                    ->orderBy('id', 'DESC')
                    ->get();
        return (array('makanan' => $makanan));
    }

    public function makananbyresto(Request $request)
    {
        $getresto = $request->get('id');
        $getmakanan = Makanan::where('user_id', $getresto)->get();
        return (array('makanan' => $getmakanan));
    }

    public function detailmakanan(Request $request)
    {
        $nameMakanan = $request->get('nameMakanan');
        $getMakanan = Makanan::where('nameMakanan', $nameMakanan)->first();
        return $getMakanan;
    }

    public function allmakanan()
    {
        $tes = Makanan::orderBy('id', 'DESC')->paginate(5);
        return $tes;
    }

    public function carimakanan(Request $request)
    {
        $query = $request->get('q');
        $makanans = Makanan::where("nameMakanan", "LIKE", "%$query%")->get();
        return array("makanan" => $makanans);
    }

     public function hasilcari(Request $request)
    {
        $query = $request->get('q');
        $makanans = Makanan::where("nameMakanan", "LIKE", "%$query%")->count();

        return array("makanan" => $makanans);
    }
}
