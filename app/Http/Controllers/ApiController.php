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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    
	public function apiMakanan(User $user)
    {

    	$makanan = DB::table('makanans')
                    ->join('users', 'users.id', '=', 'makanans.user_id')
                    ->select('makanans.id', 'makanans.user_id', 'makanans.nameMakanan', 'makanans.descriptionMakanan', 
                        'makanans.priceMakanan', 'makanans.thumbMakanan', 'makanans.updated_at', 'users.name', 'users.thumb')
                    ->orderBy('makanans.id', 'DESC')
                    ->get();
        // foreach ($makanan as $makan) {
        //     $response["status"] = true;     
        //     $response["makanan"][] = [
        //         "idMakanan" => $makan->id,
        //         "nameMakanan" => $makan->nameMakanan,
        //         "descriptionMakanan" => $makan->descriptionMakanan,
        //         "priceMakanan" => $makan->priceMakanan,
        //         "thumbMakanan" => $makan->thumbMakanan,
        //         "updatedMakanan" => $makan->updated_at,
        //         "idWarung" => $makan->user_id,
        //         "nameWarung" => $makan->name,
        //         "emailWarung" => $makan->email,
        //         "addressWarung" => $makan->address,
        //         "thumbWarung" => $makan->thumb,
        //     ];
        // }
        return Response::json(array('makanan' => $makanan));
    }

    public function getmax()
    {
        // $tes = DB::table('makanans')->select('user_id', DB::raw('count(*) as total'))->groupby('user_id')->limit(2)->get();
        $tes = DB::table('makanans')->join('payments', 'makanans.id', '=', 'payments.makanan_id')->select('makanans.id', 'makanans.nameMakanan', 'makanans.priceMakanan',  DB::raw('count(*) as total'))->groupby('payments.makanan_id')->limit(2)->get();
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
        $password = $request->get('password');
        
        $getEmail = Member::where('emailMember', $email)->first();
        $getUserName = Member::where('usernameMember', $username)->first();

        if (($getEmail == null) && ($getUserName == null) ) {
            $member->nameMember = $request->get('name');
            $member->emailMember = $email;
            $member->usernameMember = $username;
            $member->password = bcrypt($password);
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
        $getPassword = Member::where('emailMember', $email)->first()->password;
       
        $getMember1 = Member::where('emailMember', $email)->get();

        if ($getEmail != null) {
            
            if (Hash::check($password, $getPassword)) { // check credential
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
        $idMakanan = $request->get('menuId');
        $username = $request->get('userName');
        $total = $request->get('total');

        // get price makanan
        $getPrice = Makanan::where('id', $idMakanan)->first()->priceMakanan;
        //get member id
        $getMemberId = Member::where('usernameMember', $username)->first()->id; 
        // get user id(warung)
        $getuserid = Makanan::where('id', $idMakanan)->first()->user_id;
        //getdeposite member
        $getdepositemember = Member::where('usernameMember', $username)->first()->depositeMember;


        if ($total > $getdepositemember) {
            return json_encode(array(
                "error" => false,
                "message" => "deposite tidak mencukupi"
                ));  
        
        } else {

            $payment->makanan_id = $idMakanan;
            $payment->memberName = $username;
            $payment->price = $getPrice;
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
            $pengiriman->namapenerima = $request->get('namakirim');
            $pengiriman->alamatpenerima = $request->get('alamatkirim');
            $pengiriman->telponpenerima = $request->get('telponkirim');
            $pengiriman->status = "sedang diproses";
            $pengiriman->save();

             return json_encode(array(
                "error" => false,
                "message" => "transaksi berhasil"
                ));  
        }
       
    }

    public function addingDeposite(Request $request, Buydeposite $buydeposite)
    {
        $token = $request->get('token');
        $getdeposite = Buydeposite::where('token', $token)->first()->nominal;
        
        
        return ;
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
