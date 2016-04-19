<?php

namespace App\Http\Controllers;

use App\Buydeposite;
use App\Http\Requests;
use Illuminate\Http\Request;
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
        $buydeposite->token = str_random(20);
        $buydeposite->nominal = $request->get('nominal');
        $buydeposite->save();

        Session::flash('flash_success', 'Berhasil Menambahkan data baru');
        return redirect()->route('buydeposite');
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
    	$buydeposite->token = substr(str_shuffle($request->get('token')), 0, 17);
    	$buydeposite->nominal = $request->get('nominal');
    	$buydeposite->save();

        Session::flash('flash_update', 'Berhasil Update data');
        return redirect()->route('buydeposite');
    }

    public function destroy($id)
    {
    	Buydeposite::destroy($id);

    	Session::flash('flash_delete', 'Berhasil Menghapus data');
        return redirect()->route('buydeposite');
    }

}
