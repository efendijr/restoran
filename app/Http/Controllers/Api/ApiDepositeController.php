<?php

namespace App\Http\Controllers\Api;

use App\Buydeposite;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Member;
use App\Selldeposite;
use Illuminate\Http\Request;

class ApiDepositeController extends Controller
{
    
	public function tukardeposite(Request $request, Buydeposite $buydeposite, Selldeposite $selldeposite)
    {
        //intent from android
        $token = $request->get('token');
        $username = $request->get('username');

        // process
        $getMemberId = Member::where('usernameMember', $username)->first()->id;
        $checkdeposite = Buydeposite::where('tokenBuy', $token)->first();
        
        if ($checkdeposite != null) {
            $getdeposite = Buydeposite::where('tokenBuy', $token)->first()->nominal;

            $tambah = Member::where('id', $getMemberId)->increment('depositeMember', $getdeposite);
            $getMember = Member::where('usernameMember', $username)->first();


            if ($tambah != null) {
                $selldeposite->member_id = $getMemberId;
                $selldeposite->token = $token;
                $selldeposite->nominal = $getdeposite;
                $selldeposite->save();

                $delete = Buydeposite::where('tokenBuy', $token)->delete();

                return json_encode(array(
                    "status" => true,
                    "message" => "berhasil menambahkan token"
                    ));
                
            } else {
                return json_encode(array(
                    "status" => false,
                    "message" => "gagal menambahkan deposite" 
                    ));
            }
        
        } else {
            return json_encode(array(
                    "status" => false,
                    "message" => "token tidak ditemukan" 
                    ));

        }
    }

    public function penukarandeposite(Request $request)
    {
    	$getMember = $request->get('email');
        $checkMember = Member::where('emailMember', $getMember)->first()->id;	
        $getlist = Selldeposite::where('member_id', $checkMember)->get();
    	return array('deposite' => $getlist);
    }    

}
