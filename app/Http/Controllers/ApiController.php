<?php

namespace App\Http\Controllers;

use App\Buydeposite;
use App\Http\Requests;
use App\Makanan;
use App\Member;
use App\Payment;
use App\Pengiriman;
use App\Selldeposite;
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
                        'makanans.priceMakanan', 'makanans.diskonMakanan', 'lastPriceMakanan', 'makanans.thumbMakanan', 'makanans.updated_at', 'users.name', 'users.email', 'users.description', 'users.address', 'users.thumb')
                    ->orderBy('makanans.id', 'DESC')
                    ->get();
      
        return (array('makanan' => $makanan));
    }


    public function getMember(Request $request, Member $member)
    {   
        $query = $request->get('email');
        $getDetail = Member::where("emailMember", $query)->first();

        return json_encode(array('status' => true, 'member' => $getDetail));
    }

    public function gtk(Request $request)
    {
        $name = $request->get('name');
        $getTK = Makanan::where('nameMakanan', $name)->first();
        return (array('makanan' => $getTK));
    }

    public function tess(Request $request)
    {
        $nameq = $request->get('name');
        $getmakanan = Makanan::where("nameMakanan", "LIKE" , "%$nameq%")->get();

        return json_encode(array('makanan' => $getmakanan));
    }

    public function getmax()// the favorite customer
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
        $name = $request->get('name');
        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password');
        
        $getEmail = Member::where('emailMember', $email)->count();
        $getUserName = Member::where('usernameMember', $username)->count();

        if (($getEmail < 1) && ($getUserName < 1) ) {
            $member->nameMember = $name;
            $member->emailMember = $email;
            $member->usernameMember = $name;
            $member->password = bcrypt($password);
            $member->addressMember = "jalan dermo 2a malang";
            $member->phoneMember = "0984673475";
            $member->imageMember = "https://placehold.it/172x180";
            $member->thumbMember = "https://placehold.it/172x180";
            $member->depositeMember = 1000;
            $member->save();

            $getEmail1 = Member::where('emailMember', $email)->first();

            return (array('status' => true, 'member' => $getEmail1));
            
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
        
        $email = $request->get('email');
        $password = $request->get('password');
        $checkEmail = Member::where('emailMember', $email)->count();

        if ($checkEmail > 0) {
            $checkAja = Member::where('emailMember', $email)->first()->password;

            if (Hash::check($password, $checkAja)) { // check credential
               
                $getEmail = Member::where('emailMember', $email)->first();
                return (array('status' => true, 'member' => $getEmail));
            
            } else {
                return (array(
                    "status" => false,
                    "message" => "email dan password tidak cocok"));
            }

        } else {
            return (array(
                "status" => false,
                "message" => "email tidak terdaftar"
                ));            
        }

    }

    public function paymentResto(Request $request, Payment $payment, User $user, Makanan $makanan, Pengiriman $pengiriman)
    {
        // intent from android (inputan)
        
        // $idMakanan = $request->get('menuId');
        // $username = $request->get('userName');
        // $quantity = $request->get('jumlahdec');
        // $nameReceiver = $request->get('namakirim');
        // $addressReceiver = $request->get('alamatkirim');
        // $phoneReceiver = $request->get('telponkirim');
        
        // intent from android
        $idMakanan = $request->get('foodId');
        $quantity = $request->get('quantity');
        $emailMember = $request->get('email');



        // get price makanan
        $getPrice = Makanan::where('id', $idMakanan)->first()->priceMakanan;
        $getPrice1 = (float) $getPrice;
        $getquantity = (float) $quantity;
        $getTotal = $getPrice1 * $getquantity;
        //get member id
        $getMemberId = Member::where('emailMember', $emailMember)->first()->id; 
        // get user id(warung)
        $getuserid = Makanan::where('id', $idMakanan)->first()->user_id;
        //getdeposite member
        $getdepositemember = Member::where('emailMember', $emailMember)->first()->depositeMember;
        $getnameMember = Member::where('emailMember', $emailMember)->first()->nameMember;
        $getaddressMember = Member::where('emailMember', $emailMember)->first()->addressMember;
        $getphoneMember = Member::where('emailMember', $emailMember)->first()->phoneMember;


        if ($getTotal > $getdepositemember) {
            return json_encode(array(
                "status" => false,
                "message" => "deposite tidak mencukupi"
                ));  
        
        } else {

        	$payment = Payment::create([
        		'makanan_id' => $idMakanan,
        		'member_id' => $getMemberId,
        		'price' => $getPrice,
        		'quantity' => $quantity,
        		'total' => $getTotal,
        		]);

        	if ($payment != null) {
        		
        		$tes = Member::where('emailMember', $emailMember)
                    ->decrement('depositeMember', $getTotal);

            	$bayar = User::where('id', $getuserid)
                        ->increment('deposite', $getTotal);

	            $getpaymentId = Payment::where('makanan_id', $idMakanan)->orderBy('id', 'DESC')->first()->id;


	            // Pengiriman::create([
	            // 	'payment_id' => $getpaymentId,
	            // 	'nameReceiver' => $nameReceiver,
	            // 	'addressReceiver' =>$addressReceiver,
	            // 	'phoneReceiver' => $phoneReceiver,
	            // 	'statusDelivery' => 'diproses',	
	            // 	]);
	            $pengiriman->payment_id = $getpaymentId;
	            // $pengiriman->admin_id = $admin_id;
	            $pengiriman->nameReceiver = $getnameMember;
	            $pengiriman->addressReceiver = $getaddressMember;
	            $pengiriman->phoneReceiver = $getphoneMember;
	            $pengiriman->statusDelivery = "sedang diproses";
	            $pengiriman->save();

	            return json_encode(array(
                "status" => true,
                "message" => "transaksi berhasil"
                ));  
        	
        	} else {
        		 return json_encode(array(
                "status" => false,
                "message" => "data pengiriman tidak lengkap"
                ));  
        	}

        }
       
    }

   public function usingToken(Request $request, Buydeposite $buydeposite, Selldeposite $selldeposite)
    {
        //intent from android
        $token = $request->get('token');
        $username = $request->get('username');

        // process
        $getMemberId = Member::where('usernameMember', $username)->first()->id;
        $checkdeposite = Buydeposite::where('tokenBuy', $token)->first();
        $getdeposite = Buydeposite::where('tokenBuy', $token)->first()->nominal;

        $tambah = Member::where('id', $getMemberId)->increment('depositeMember', $getdeposite);

        $getMember = Member::where('usernameMember', $username)->first();

        if ($checkdeposite != null) {

            if ($tambah != null) {
                $selldeposite->member_id = $getMemberId;
                $selldeposite->token = $token;
                $selldeposite->nominal = $getdeposite;
                $selldeposite->save();

                $delete = Buydeposite::where('tokenBuy', $token)->delete();
                

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


    public function updatemember(Request $request, Member $member)
    {
        $name = $request->get('name');
        $address = $request->get('address');
        $phone = $request->get('phone');
        $email = $request->get('email');

        $getName = Member::where('nameMember', $name)->first();
        $getName1 = Member::where('emailMember', $email)->first()->nameMember;

        if ($getName == null || ($name == $getName1)) {
            
            // $member->nameMember = $name;
            // $member->usernameMember = $name;
            // $member->addressMember = $address;
            // $member->phoneMember = $phone;
            // $member->update();
            DB::table('members')
            	->where('emailMember', $email)
            	->update(['nameMember' => $name, 
            		'addressMember' => $address,
            		'phoneMember' => $phone]);

            return json_encode(array(
                    "status" => true,
                    "message" => "update berhasil" 
                    ));
        
        } else {
           return json_encode(array(
                    "status" => false,
                    "message" => "nama sudah ada" 
                    ));
        }

    }

    public function historypayment(Request $request)
    {

        $email = $request->get('email');
        $getMemberId = Member::where('emailMember', $email)->first()->id;
        // $getdeposite = Buydeposite::where('tokenBuy', $token)->first()->nominal;
        
        $gethistory = DB::table('payments')
                        ->join('members', 'members.id', '=', 'payments.member_id')
                        ->join('makanans', 'makanans.id', '=', 'payments.makanan_id')
                        ->join('pengirimen', 'payments.id', '=', 'pengirimen.payment_id')
                        ->select('payments.id', 'payments.quantity', 'payments.total', 'members.usernameMember', 'makanans.nameMakanan', 'makanans.priceMakanan', 'makanans.thumbMakanan' ,'pengirimen.addressReceiver' ,'pengirimen.statusDelivery')
                        ->where('members.id', $getMemberId)
                        ->get();


        return (array('history' => $gethistory));
    }

    public function getrestodetail(Request $request)
    {
    	$restoId = $request->get('idwar');

    	$getresto = User::where('id', $restoId)->first();

    	return (array('restoran' => $getresto));
    }
    
    public function getmakananbyidresto(Request $request)
    {
    	$restoId = $request->get('idwar');
    	$getmakanan = Makanan::where('user_id', $restoId)->get();
    	return array('makanan' => $getmakanan);
    }
    

    
}


