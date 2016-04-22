<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Buydeposite;
use App\Http\Requests;
use App\Member;
use App\Selldeposite;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
{
    
    public function register(Request $request, Anggota $anggota)
    {
        $getname = $request->get('name');
        $getpassword = $request->get('password');

        $anggota1 = Anggota::where('name', $getname)->count();

        if ($anggota1 < 1 ) {
            $anggota->name = $getname;
            $anggota->password = $getpassword;
            $anggota->save();

             $anggotas1 = Anggota::where('name', $getname)->get();
                foreach ($anggotas1 as $value) {
                    $result["status"] = true;
                    $result["result"] = array(
                        "name" => $value["name"],
                        "created" => $value["created_at"],
                        "updated" => $value["updated_at"],
                        );

                }                        
            return json_encode($result);
                
        } else {

            return json_encode(array(
                "status" => false,
                "message" => "data sudah ada" 
                ));
            }
        
    }

    public function login(Request $request)
    {
        $name = $request->get('name');
        // $password = $request->get('password');
         $anggotas = Anggota::where('name', $name)->count();
         $anggota = Anggota::where('name', $name)->first();

        if ($name != null) {

            if ($anggotas > 0) {
                
                $anggotas1 = Anggota::where('name', $name)->get();
                    foreach ($anggotas1 as $value) {
                        $result["status"] = true;
                        $result["result"] = array(
                            "name" => $value["name"],
                            "created" => $value["created_at"],
                            "updated" => $value["updated_at"]
                            );
                    }
                    return json_encode($result);

            } else {
                return json_encode(array(
                    "status" => false,
                    "message" => "data sudah ada" 
                    ));
            }

        } else {
            return json_encode(array(
                "status" => false,
                "message" => "isi dulu data" 
                ));
        } 

    }


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
