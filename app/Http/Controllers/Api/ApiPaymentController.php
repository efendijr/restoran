<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Makanan;
use App\Member;
use App\Payment;
use App\Pengiriman;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPaymentController extends Controller
{
    public function index(Request $request, Payment $payment, User $user, Makanan $makanan, Pengiriman $pengiriman)
    {
        // intent from android
        $idMakanan = $request->get('foodId');
        $quantity = $request->get('quantity');
        $emailMember = $request->get('email');

        $kecamatan = $request->get('kecamatan');
        $gettarif = Kecamatan::where('kecamatanName', $kecamatan)->first()->kecamatanTarif;

        $namaPenerima = $request->get('nama');
        $alamatPenerima = $request->get('alamat');
        $telponPenerima = $request->get('telpon');


        // get price makanan
        $getPrice = Makanan::where('id', $idMakanan)->first()->lastPriceMakanan;
        $getPrice1 = (float) $getPrice;
        $getquantity = (float) $quantity;
        $kirim = $gettarif;
        $getBayar = $getPrice1 * $getquantity;
        $getTotal = $getBayar + $kirim;
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
                "message" => "deposite"
                ));

        } else {

        	$payment = Payment::create([
        		'makanan_id' => $idMakanan,
        		'member_id' => $getMemberId,
        		'price' => $getPrice,
        		'quantity' => $quantity,
                'biayakirim' => $kirim,
        		'total' => $getTotal,
        		]);

        	if ($payment != null) {

        		$tes = Member::where('emailMember', $emailMember)
                    ->decrement('depositeMember', $getTotal);

            	// $bayar = User::where('id', $getuserid)
             //            ->increment('deposite', $getTotal);

	            $getpaymentId = Payment::where('makanan_id', $idMakanan)->orderBy('id', 'DESC')->first()->id;

	            $pengiriman->payment_id = $getpaymentId;
	            // $pengiriman->admin_id = $admin_id;
	            $pengiriman->nameReceiver = $namaPenerima;
	            $pengiriman->addressReceiver = $alamatPenerima;
	            $pengiriman->phoneReceiver = $telponPenerima;
	            $pengiriman->statusDelivery = "sedang diproses";
	            $pengiriman->save();

	            return json_encode(array(
                "status" => true,
                "message" => "transaksi berhasil pesanama anda akan segera dikirim"
                ));

        	} else {
        		 return json_encode(array(
                "status" => false,
                "message" => "data pengiriman tidak lengkap"
                ));
        	}
        }
    }

    public function listpayment(Request $request)
    {
        $email = $request->get('email');
        $getMemberId = Member::where('emailMember', $email)->first()->id;
        // $getdeposite = Buydeposite::where('tokenBuy', $token)->first()->nominal;
        $gethistory = DB::table('payments')
                        ->join('members', 'members.id', '=', 'payments.member_id')
                        ->join('makanans', 'makanans.id', '=', 'payments.makanan_id')
                        ->join('pengirimans', 'payments.id', '=', 'pengirimans.payment_id')
                        ->select('payments.id', 'payments.quantity', 'payments.total', 'members.usernameMember', 'makanans.nameMakanan', 'makanans.priceMakanan', 'makanans.lastPriceMakanan','makanans.thumbMakanan' ,'pengirimans.addressReceiver' ,'pengirimans.statusDelivery', 'pengirimans.updated_at')
                        ->where('members.id', $getMemberId)
                        ->get();
        return (array('history' => $gethistory));
    }

    public function paymentdetail(Request $request)
    {
        $getpaymentId = $request->get('paymentId');
        $gethistory = DB::table('payments')
                        ->join('members', 'members.id', '=', 'payments.member_id')
                        ->join('makanans', 'makanans.id', '=', 'payments.makanan_id')
                        ->join('pengirimans', 'payments.id', '=', 'pengirimans.payment_id')
                        ->select('payments.id', 'payments.quantity', 'payments.total', 'members.usernameMember', 'makanans.nameMakanan', 'makanans.priceMakanan', 'makanans.thumbMakanan' ,'pengirimans.addressReceiver' ,'pengirimans.statusDelivery', 'pengirimans.updated_at')
                        ->where('payments.id', $getpaymentId)
                        ->get();
        return (array('payments' => $gethistory));
    }

    public function mostpayment()
    {
        $getmax = DB::table('makanans')
                    ->join('payments', 'makanans.id', '=', 'payments.makanan_id')
                    ->select('makanans.id', 'makanans.nameMakanan', 'makanans.priceMakanan',
                        DB::raw('count(*) as total'))
                    ->groupby('payments.makanan_id')
                    ->limit(3)
                    ->get();
        return (array('terbanyak' => $getmax));
    }

    

}
