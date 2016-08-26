<?php

namespace App\Http\Controllers;

use App\Buydeposite;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class BuydepositeController extends Controller
{

    public function index(Request $request)
    {
        if ($keyword = $request->get('keyword')) {
    		$keyword = Input::get('keyword', '');
    		$buydeposites = Buydeposite::SearchByKeyword($keyword)->orderBy('id', 'DESC')->paginate(5);
    	
    	} else {
    		$buydeposites = Buydeposite::orderBy('id', 'DESC')->paginate(5);
    	} 

        return view('buydeposite.index', compact('buydeposites'));
    }

    public function create()
    {
        return view('buydeposite.create');
    }

    public function store(Request $request, Buydeposite $buydeposite)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999).mt_rand(1000000, 9999999);
        $string = str_shuffle($pin);
        $buydeposite->tokenBuy = $string;
        $buydeposite->user_id = Auth::user()->id;
        $buydeposite->nominal = $request->get('nominal');
        $buydeposite->save();

        Session::flash('flash_success', 'Berhasil Menambahkan data baru');
        return redirect()->route('buydeposite.index');
    }

    public function show(Buydeposite $buydeposite)
    {
        return view('buydeposite.show', compact('buydeposite'));
    }

    public function edit(Buydeposite $buydeposite)
    {
        return view('buydeposite.edit', compact('buydeposite'));
    }

    public function update(Request $request, Buydeposite $buydeposite)
    {
        $pin = mt_rand(1000000, 9999999).mt_rand(1000000, 9999999);
        $string = str_shuffle($pin);
        $buydeposite->tokenBuy = $string;
        $buydeposite->user_id = Auth::user()->id;
    	$buydeposite->nominal = $request->get('nominal');
    	$buydeposite->save();

        Session::flash('flash_update', 'Berhasil Update data');
        return redirect()->route('buydeposite.index');
    }

    public function destroy($id)
    {
    	Buydeposite::destroy($id);
        // Buydeposite::find($id)->delete();
    	Session::flash('flash_delete', 'Berhasil Menghapus data');
        return redirect()->route('buydeposite.index');
    }

}
