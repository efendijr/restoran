<?php

namespace App\Http\Controllers;

use App\Buydeposite;
use App\Http\Requests;
use App\Member;
use App\Selldeposite;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    


    public function useToken(Request $request, Buydeposite $buydeposite, Selldeposite $selldeposite)
    {
        $token = $request->get('token');
        $memberid = $request->get('memberid');
        $getdeposite = Buydeposite::where('token', $token)->first()->nominal;

        $tambah = Member::where('id', $memberid)->increment('depositeMember', $getdeposite);

        if ($tambah != null) {
        	$selldeposite->member_id = $memberid;
		    $selldeposite->token = $token;
		    $selldeposite->nominal = $getdeposite;
		    $selldeposite->save();

        	$delete = Buydeposite::where('token', $token)->delete();
        	return json_encode(array(
        		"status" => true,
        		"message" => "berhasil menambahkan token"
        		));
        }

    }

}
