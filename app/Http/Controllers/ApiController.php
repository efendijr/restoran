<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Makanan;
use App\Member;
use App\Payment;
use App\Pengiriman;
use App\Tesslug;
use App\Testing;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    
	public function apiMakanan(User $user)
    {

    	$makanan = DB::table('makanans')
                    ->join('users', 'users.id', '=', 'makanans.user_id')
                    ->select('makanans.*', 'users.name', 'users.thumb')
                    ->orderBy('makanans.id', 'DESC')
                    ->get();

        foreach ($makanan as $makan) {
            $response["status"] = true;     
            $response["makanan"][] = [
                "idMakanan" => $makan->id,
                "nameMakanan" => $makan->nameMakanan,
                "descriptionMakanan" => $makan->descriptionMakanan,
                "priceMakanan" => $makan->priceMakanan,
                "thumbMakanan" => $makan->thumbMakanan,
                "idWarung" => $makan->user_id,
                "nameWarung" => $makan->name,
                "thumbWarung" => $makan->thumb,
            ];
        }

        return Response::json($response);
    }

    /*
        Registrasi API
     */
    public function registrasiMember(Request $request, Member $member)
    {
        // $rules = [
        //     'name' => 'required|min:5|max:100',
        //     'email' => 'required|email|min:5|max:100',
        //     'username' => 'required|min:5|max:100',
        //     'password' => 'required|min:6|max:100',
        // ];
        // $validasi = validator($request, $rules);
        
        $email = $request->get('email');
        $username = $request->get('username');
        $getEmail = Member::where('emailMember', $email)->first();
        $getUserName = Member::where('usernameMember', $username)->first();

        if (($getEmail == null) && ($getUserName == null) ) {
            $member->nameMember = $request->get('name');
            $member->emailMember = $email;
            $member->usernameMember = $username;
            $member->password = bcrypt($request->get('password'));
            $member->imageMember = "https://placehold.it/172x180";
            $member->thumbMember = "https://placehold.it/172x180";
            $member->depositeMember = 1000;
            $member->save();

             return json_encode(array(
                "status" => false,
                "message" => "berhasil melakukan registrasi"
                ));
        
        } elseif($getEmail != null) {
            return json_encode(array(
                "status" => false,
                "message" => "email sudah terdaftar"
                ));
        } elseif ($getUserName != null) {
            return json_encode(array(
                "status" => false,
                "message" => "username sudah terdaftar"
                ));
        }
    }

    /*
        Login API
     */
    public function loginMember(Request $request, Member $member)
    {
        // $rules = [
        //     'email' => 'required|email|min:5|max:100',
        //     'password' => 'required|min:6|max:100',
        // ];

        $email = $request->get('email');
        $password = $request->get('password');
        
        $getEmail = Member::where('emailMember', $email)->first();
        $getEmail1 = Member::where('emailMember', $email)->get();
        $getcredential = Member::where('emailMember', $email)
                                ->where('password', $password)
                                ->first();
        $getMember1 = Member::where('emailMember', $email)->get();

        if ($getEmail != null) {
            
            if ($getcredential != null) {
                foreach ($getEmail1 as $value) {
                $result["status"] = true;
                $result["result"] = array(
                    "nameMember" => $value["nameMember"],
                    "emailMember" => $value["emailMember"],
                    "usernameMember" => $value["usernameMember"],
                    "imageMember" => $value["imageMember"],
                    "depositeMember" => $value["depositeMember"],
                    "created_at" => $value["created_at"],
                    "updated_at" => $value["updated_at"]
                    );
                }
                return json_encode($result);
            
            } else {
                return json_encode(array(
                    "status" => false,
                    "message" => "email dan password tidak cocok"
                    ));
            }

        } else {

            return json_encode(array(
                "status" => false,
                "message" => "email tidak terdaftar"
                ));            
        }

    }

    public function paymentResto(Request $request, Payment $payment, User $user, Makanan $makanan, Pengiriman $pengiriman)
    {
        $total = $request->get('total');
        $username = $request->get('userName');
        $getMemberId = Member::where('usernameMember', $username)->first()->id; 
        $idMakanan = $request->get('menuId');
        $alamatPengiriman = $request->get('alamat');
        $getuserid = Makanan::where('id', $idMakanan)->first()->user_id;
        $getdepositemember = Member::where('usernameMember', $username)->first()->depositeMember;


        if ($total > $getdepositemember) {
            return json_encode(array(
                "status" => false,
                "message" => "deposite tidak mencukupi"
                ));  
        
        } else {

            $payment->makanan_id = $idMakanan;
            $payment->memberName = $username;
            $payment->price = $request->get('menuPrice');
            $payment->quantity = $request->get('jumlahdec');
            $payment->total = $total;
            $payment->save();

             $tes = Member::where('usernameMember', $username)
                    ->decrement('depositeMember', $total);

            $bayar = User::where('id', $getuserid)
                        ->increment('deposite', $total);

            $getpaymentId = Payment::where('memberName', $username)->orderBy('id', 'DESC')->first()->id;

            $pengiriman->payment_id = $getpaymentId;
            $pengiriman->member_id = $getMemberId;
            $pengiriman->usernameMember = $username;
            $pengiriman->alamat = $alamatPengiriman;
            $pengiriman->status = "sedang diproses";
            $pengiriman->save();

             return json_encode(array(
                "status" => false,
                "message" => "transaksi berhasil"
                ));  
        }
       
    }

    public function getid(Request $request)
    {
        $id = $request->get('id');

        $getuserid = Makanan::where('id', $id)->first()->user_id;
        $tambah = User::where('id', $getuserid)->decrement('deposite', 10);
        $userdetail = User::where('id', $getuserid)->first();
        
        return $userdetail;
    }

    public function getuser()
    {
        $getid = 1;
        $user = User::where('id', $getid)->first();
        return $user;
    }

    public function getMember()
    {
        $member = Member::where('usernameMember', 'ali')->first();
        return $member;
    }


   
    public function testing()
    {
        $testing = Testing::all();

        return View('artikel', compact('testing'));
    }

    public function testingslug($slug)
    { 
        $testing = Testing::where('slug', $slug)->first();
        return View('artikelDetail', compact('testing'));
    }

    public function tesslug()
    {
        $tesslug = Tesslug::all();

        return View('artikel', compact('tesslug'));
    }

    public function createslug()
    {
        return View('createslug');
    }

    public function storeslug(Request $request, Tesslug $tesslug)
    {
        $title1 = $request->get('title');
        $tesslug->title = $title1;
        $tesslug->description = $request->get('description');
        $tesslug->slug = str_slug($title1);
        $tesslug->save();

        return redirect('tesslug');
    }

    public function tesslugDetail($slug)
    {
        $tesslug = Tesslug::where('slug', $slug)->first();
        return View('artikelDetail', compact('tesslug'));
    }
    
}
