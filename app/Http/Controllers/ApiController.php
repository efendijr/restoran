<?php
namespace App\Http\Controllers;

use App\Buydeposite;
use App\Http\Requests;
use App\Makanan;
use App\Member;
use App\Payment;
use App\Pengiriman;
use App\Selldeposite;
use App\Tesslug;
use App\Testing;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{

    public function getMember(Request $request, Member $member)
    {   
        $query = $request->get('email');
        $getDetail = Member::where("emailMember", $query)->first();

        return json_encode(array('status' => true, 'member' => $getDetail));
    }

    public function gtk(Request $request)
    {
        $name = $request->get('name');
        $getTK = Makanan::where('nameMakanan', $name)->first();
        return (array('makanan' => $getTK));
    }

    public function tess(Request $request)
    {
        $nameq = $request->get('name');
        $getmakanan = Makanan::where("nameMakanan", "LIKE" , "%$nameq%")->get();

        return json_encode(array('makanan' => $getmakanan));
    }

    public function getmax()// the favorite customer
    {
        $tes = DB::table('makanans')
                    ->join('payments', 'makanans.id', '=', 'payments.makanan_id')
                    ->select('makanans.id', 'makanans.nameMakanan', 'makanans.priceMakanan',  DB::raw('count(*) as total'))
                    ->groupby('payments.makanan_id')
                    ->limit(2)
                    ->get();
        // $tess = DB::table('users')->where('id', $tes)->get();
        return Response::json(array('terbanyak' => $tes));
    }

    public function getmakanan(Request $request)
    {
        $getId = $request->get('id');
        $makanan = Makanan::where('user_id', $getId)
                            ->select('id', 'nameMakanan', 'descriptionMakanan', 'priceMakanan', 'thumbMakanan', 'updated_at')
                            ->get();
        
        return Response::json(array('makanan' => $makanan));
    }

    public function getrestoran()
    {
        $restoran = User::select('id', 'name', 'email', 'description', 'address', 'thumb')
                        ->get();

        return Response::json(array('restoran' => $restoran));
    }

    public function getrestodetail(Request $request)
    {
    	$restoId = $request->get('idwar');

    	$getresto = User::where('id', $restoId)->first();

    	return (array('restoran' => $getresto));
    } 
    
}


