<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Pengiriman;
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
    	$token = $request->get('token');
        $pengiriman->token = bcrypt($token);
        $pengiriman = $request->get('nominal');
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
        return view('pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, Pengiriman $pengiriman)
    {
    	$pengiriman->token = bcrypt($request->get('token'));
    	$pengiriman->nominal = $request->get('nominal');
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
