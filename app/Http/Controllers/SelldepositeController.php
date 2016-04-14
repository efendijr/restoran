<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Selldeposite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SelldepositeController extends Controller
{
    public function index(Request $request)
    {
        if ($keyword = $request->get('keyword')) {
    		$keyword = Input::get('keyword', '');
    		$selldeposites = Selldeposite::SearchByKeyword($keyword)->orderBy('id', 'DESC')->paginate(5);
    	
    	} else {
    		$selldeposites = Selldeposite::orderBy('id', 'DESC')->paginate(5);
    	} 

        return view('selldeposite.index', compact('selldeposites'));
    }

    public function create()
    {
        return view('selldeposite.create');
    }

    public function store(Request $request, Selldeposite $selldeposite)
    {
    	$token = $request->get('token');
        $selldeposite->token = bcrypt($token);
        $selldeposite = $request->get('nominal');
        $selldeposite->save();

        Session::flash('flash_success', 'Berhasil Menambahkan data baru');
        return redirect()->route('selldeposite');
    }

    public function show(Selldeposite $selldeposite)
    {
        return view('selldeposite.show', compact('selldeposite'));
    }

    public function edit(Selldeposite $selldeposite)
    {
        return view('selldeposite.edit', compact('selldeposite'));
    }

    public function update(Request $request, Selldeposite $selldeposite)
    {
    	$selldeposite->token = bcrypt($request->get('token'));
    	$selldeposite->nominal = $request->get('nominal');
    	$selldeposite->save();

        Session::flash('flash_update', 'Berhasil Update data');
        return redirect()->route('selldeposite');
    }

    public function destroy($id)
    {
    	Selldeposite::destroy($id);

    	Session::flash('flash_delete', 'Berhasil Menghapus data');
        return redirect()->route('selldeposite');
    }
}
