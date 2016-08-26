<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/tesmakanan',
        'api/member/registrasi',
        'api/member/login',
        'api/member/update',
        'api/member/rubahgambar',
        'api/payment',
        'api/payment/list',
        'api/payment/detail',
        'api/deposite',
        'api/deposite/ditukar',
        'api/makanan/byresto',
        'api/makanan/detailmakanan',
        'api/makanan/carimakanan',
        'api/makanan/hasilcari',
        'api/terimacart',
        'api/editcart',
        'api/hapuscart',
        'api/tampilkancart',
        'api/totalcart',
        'api/jumlahcart',
        'api/listalamat',
        'api/tambahalamat',
        'api/editalamat',
        'api/updatealamat',
        'api/hapusalamat',
        'api/kodealamat',
        'api/cartcomplete',

        'testing/api',
        'payment/makan',
        'getid',
        'getuser',
        'getmember',
        'usingtoken',
        'getmakanan',
        'anggota',
        'anggotalog',
        'tess',
        'gettk',
        'tespayment',
        'updatemember',
        'historypayment',
        'getrestodetail',
        'getmakananbyidresto',
        'paymentdetail',
        'gettoken',


    ];
}
