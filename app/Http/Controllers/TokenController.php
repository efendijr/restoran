<?php

namespace App\Http\Controllers;

use App\Buydeposite;
use App\Http\Requests;
use App\Member;
use App\Selldeposite;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    


    public function usingToken(Request $request, Buydeposite $buydeposite, Selldeposite $selldeposite)
    {
        $token = $request->get('token');
        $username = $request->get('username');
        $getMemberId = Member::where('usernameMember', $username)->first()->id;
        $checkdeposite = Buydeposite::where('token', $token)->first();
        $getdeposite = Buydeposite::where('token', $token)->first()->nominal;

        $tambah = Member::where('id', $getMemberId)->increment('depositeMember', $getdeposite);

        $getMember = Member::where('usernameMember', $username)->first();

        if ($checkdeposite != null) {

            if ($tambah != null) {
                $selldeposite->member_id = $getMemberId;
                $selldeposite->token = $token;
                $selldeposite->nominal = $getdeposite;
                $selldeposite->save();

                $delete = Buydeposite::where('token', $token)->delete();
                

                // showing response
                // foreach ($getMember as $value) {
                // $result["status"] = true;
                // $result["result"] = array(
                //     "nameMember" => $value["nameMember"],
                //     "emailMember" => $value["emailMember"],
                //     "usernameMember" => $value["usernameMember"],
                //     "imageMember" => $value["imageMember"],
                //     "depositeMember" => $value["depositeMember"],
                //     "updated_at" => $value["updated_at"]
                //     );
                // }
                // return json_encode($result);

                return json_encode(array(
                    "error" => false,
                    "message" => "berhasil menambahkan token"
                    ));
                
            } else {
                return json_encode(array(
                    "error" => true,
                    "message" => "gagal menambahkan deposite" 
                    ));
            }
        
        } else {
            return json_encode(array(
                    "error" => true,
                    "message" => "token tidak ditemukan" 
                    ));

        }

    }

}
