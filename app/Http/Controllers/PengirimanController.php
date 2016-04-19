<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Pengiriman;
use App\Status;
use Illuminate\Http\Request;
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

    public function create()
    {
        return view('pengiriman.create');
    }

    public function store(Request $request, Pengiriman $pengiriman)
    {
        $pengiriman->payment_id = $request->get('payment_id');
        $pengiriman->member_id = $request->get('member_id');
        $pengiriman->alamat = $request->get('alamat');
        $pengiriman->status = $request->get('status');
        $pengiriman->save();

        Session::flash('flash_success', 'Berhasil Menambahkan data baru');
        return redirect()->route('pengiriman');
    }

    public function show(Pengiriman $pengiriman)
    {
        return view('pengiriman.show', compact('pengiriman'));
    }

    public function edit(Pengiriman $pengiriman)
    {

        $gettags = Status::all();
        return view('pengiriman.edit', compact('pengiriman', 'gettags'));
    }

    public function update(Request $request, Pengiriman $pengiriman)
    {
    	$pengiriman->payment_id = $request->get('payment_id');
        $pengiriman->member_id = $request->get('member_id');
        $pengiriman->alamat = $request->get('alamat');
        $pengiriman->status = $request->get('status');
    	$pengiriman->save();

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
