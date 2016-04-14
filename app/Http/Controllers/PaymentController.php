<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($keyword = $request->get('keyword')) {
    		$keyword = Input::get('keyword', '');
    		$payments = Payment::SearchByKeyword($keyword)->orderBy('id', 'DESC')->paginate(5);
    	
    	} else {
    		$payments = Payment::orderBy('id', 'DESC')->paginate(5);
    	} 

        return view('payment.index', compact('payments'));
    }

    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request, Payment $payment)
    {
    	$token = $request->get('token');
        $payment->token = bcrypt($token);
        $payment = $request->get('nominal');
        $payment->save();

        Session::flash('flash_success', 'Berhasil Menambahkan data baru');
        return redirect()->route('payment');
    }

    public function show(Payment $payment)
    {
        return view('payment.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payment.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
    	$payment->token = bcrypt($request->get('token'));
    	$payment->nominal = $request->get('nominal');
    	$payment->save();

        Session::flash('flash_update', 'Berhasil Update data');
        return redirect()->route('payment');
    }

    public function destroy($id)
    {
    	Payment::destroy($id);

    	Session::flash('flash_delete', 'Berhasil Menghapus data');
        return redirect()->route('payment');
    }
}
