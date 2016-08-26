<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if ($keyword = $request->get('keyword')) {
            $keyword = Input::get('keyword', '');
            $buydeposites = Kecamatan::SearchByKeyword($keyword)->orderBy('id', 'DESC')->paginate(5);
        
        } else {
            $kecamatans = Kecamatan::orderBy('id', 'DESC')->paginate(5);
        } 

        return view('kecamatan.index', compact('kecamatans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kecamatan $kecamatan)
    {
        $kecamatan->kecamatanName = $request->get('name');
        $kecamatan->kecamatanTarif = $request->get('tarif');
        $kecamatan->save();

        Session::flash('flash_success', 'Berhasil tambah data baru');
        return redirect()->route('kecamatan.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = Kecamatan::find($id);
        return view('kecamatan.edit', compact('kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $kecamatan->kecamatanName = $request->get('name');
        $kecamatan->kecamatanTarif = $request->get('tarif');
        $kecamatan->save();

        Session::flash('flash_update', 'Berhasil update data');
        return redirect()->route('kecamatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kecamatan::destroy($id);

        Session::flash('flash_delete', 'Berhasil hapus data');
        return redirect()->route('kecamatan.index');
    }
}
