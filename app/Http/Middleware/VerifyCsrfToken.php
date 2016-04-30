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
        'api/member/registrasi',
        'api/member/login',
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
        'getmakananbyidresto'

    ];
}
