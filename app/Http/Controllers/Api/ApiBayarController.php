<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CartComplete;
use App\Cart;

class ApiBayarController extends Controller
{
    public function bayarBarang(Request $request)
    {
      $getMemberId = $request->get('member_id');
      $getCartbyMember = Cart::where('member_id', $getMemberId)->get();

      // do {
      //   $getMakananId = Cart::where('member_id', $getMemberId)->first()->makanan_id;
      //   $getQuantity = Cart::where('member_id', $getMemberId)->where('makanan_id', $getMakananId)->first()->quantity;
      //
      //   $setCartComplete = CartComplete::create( [
      //     'bayar_id' => 1,
      //     'makanan_id' => $getMakananId,
      //     'quantity' => $getQuantity,
      //   ]);
      //
      // } while ($getCartbyMember == null);

      while ($getCartbyMember == null) {
          $getMakananId = Cart::where('member_id', $getMemberId)->first()->makanan_id;
          $getQuantity = Cart::where('member_id', $getMemberId)->where('makanan_id', $getMakananId)->first()->quantity;

          $setCartComplete = CartComplete::create( [
            'bayar_id' => 1,
            'makanan_id' => $getMakananId,
            'quantity' => $getQuantity,
          ]);

      }

      $delCart = Cart::where('member_id', $getMemberId)->delete();

      if ($delCart != null) {
        return 'berhasil';
      } else {
        return 'gagal';
      }

    }
}
