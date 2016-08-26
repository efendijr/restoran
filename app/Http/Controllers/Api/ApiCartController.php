<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiCartController extends Controller
{
    public function terimaCart(Request $request, Cart $cart)
    {
    	$emailMember = $request->get('emailMember');
    	$idMakanan = $request->get('idMakanan');
    	// $quantity = $request->get('quantity');

        $getMember = Member::where('emailMember', $emailMember)->first()->id;
        $getMakanan = Cart::where('makanan_id', $idMakanan)
                            ->where('member_id', $getMember)
                            ->first();

        if ($getMakanan == null) {
            $cart->member_id = $getMember;
            $cart->makanan_id = $idMakanan;
            $cart->quantity = 1;
            $cart->save();

            return (array("status" => true, "message" => "berhasil menambahkan"));

         } else {
            return (array("status" => false, "message" => "berhasil menambahkan"));
         }

        return null;
    }


    public function editCart(Request $request)
    {
    	$idCart = $request->get('idcart');
    	$check = Cart::where('id', $idCart)->first();

    	if ($check != null ) {
    	   $jumlah = $request->get('jumlah');
            $rubah = Cart::where('id', $idCart)
                        ->update([
                            'quantity' => $jumlah
                            ]);
                if ($rubah != null) {
                     return (array("status" => true, "message" => "berhasil update cart"));
                } else {
                    return (array("status" => false, "message" => "gagal update data"));
                }

    	} else {
    		return 'data kosong';
    	}
    }

    public function hapusCart(Request $request)
    {
        $idCart = $request->get('idcart');
        Cart::destroy($idCart);
        return 'berhasil delete';
    }

    public function totalCart(Request $request) // total belanja
    {
        $emailMember = $request->get('emailMember');
        $getMember = Member::where('emailMember', $emailMember)->first()->id;
        $getTotal = DB::table('carts')
                        ->join('makanans', 'makanans.id', '=', 'carts.makanan_id')
                        ->where('carts.member_id', $getMember)
                        ->select(DB::raw('SUM(makanans.lastPriceMakanan * carts.quantity) as total_sales'))
                        ->groupBy('carts.member_id')
                        ->get();

        return $getTotal;
    }

    public function tampilkanCart(Request $request)
    {
        $emailMember = $request->get('email');
        $getMember = Member::where('emailMember', $emailMember)->first()->id;

        $carts = DB::table('carts')
                    ->join('members', 'members.id', '=', 'carts.member_id')
                    ->join('makanans', 'makanans.id', '=', 'carts.makanan_id')
                    ->select('carts.id', 'carts.quantity', 'members.emailMember', 'members.usernameMember', 'makanans.nameMakanan', 'makanans.priceMakanan', 'makanans.diskonMakanan', 'makanans.lastPriceMakanan','makanans.thumbMakanan', 'carts.created_at', 'carts.updated_at')
                    ->where('members.id', $getMember)
                    ->orderBy('carts.id', 'DESC')
                    ->get();

        return (array('carts' => $carts));
    }

    public function jumlahCart(Request $request) // total pencarian
    {
        $emailMember = $request->get('email');
        $getMember = Member::where('emailMember', $emailMember)->first()->id;
        $carts = Cart::where('member_id', $getMember)->count();

        return array("carts" => $carts);
    }

    public function cartComplete(Request $request)
    {
        $getEmail = $request->get('email');
        $getMember = Member::where('emailMember', $getEmail)->first()->id;
        $getCart = Cart::where('member_id', $getMember)-
        $delCart = Cart::where('member_id', $getMember)->delete();


    }

}
