<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Pengiriman;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PengirimanController extends Controller
{
    public function index(Request $request)
    {
        if ($keyword = $request->get('keyword')) {
    		$keyword = Input::get('keyword', '');
    		$pengirimans = Pengiriman::SearchByKeyword($keyword)->orderBy('id', 'DESC')->paginate(5);
    	
    	} else {
    		$pengirimans = Pengiriman::orderBy('id', 'DESC')->paginate(5);
    	} 

        return view('pengiriman.index', compact('pengirimans'));
    }

    public function edit(Pengiriman $pengiriman)
    {

        $gettags = Status::all();
        return view('pengiriman.edit', compact('pengiriman', 'gettags'));
    }

    public function update(Request $request, Pengiriman $pengiriman)
    {
    	// $pengiriman->payment_id = $request->get('payment_id');
        $pengiriman->admin_id = Auth::guard('admin')->user()->id;
        $pengiriman->statusDelivery = $request->get('status');
    	$pengiriman->update();

        Session::flash('flash_update', 'Berhasil Update data');
        return redirect()->route('pengiriman');
    }

    public function destroy($id)
    {
    	Pengiriman::destroy($id);

    	Session::flash('flash_delete', 'Berhasil Menghapus data');
        return redirect()->route('pengiriman');
    }
}
