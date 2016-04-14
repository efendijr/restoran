<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Makanan;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MakananController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($keyword = $request->get('keyword')) {
    		$keyword = Input::get('keyword', '');
    		$makans = Makanan::SearchByKeyword($keyword)->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
           
    	} else {
    		$makans = Makanan::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
    	} 

        return view('makanan.index', compact('makans'));
    }

    public function create()
    {
        return view('makanan.create');
    }

    public function store(Request $request, Makanan $makan)
    {
        $rules = [
            'name' => 'required|min:3|max:20',
            'description' => 'required|min:10|max:255',
            'price' => 'required',
            'image' => 'mimes: jpg,jpeg,png|max:300',
        ];

        $this->validate($request, $rules);

        $makanname = $request->get('name');
        $query = Makanan::where('nameMakanan', $makanname)->first();

        if ($query == null) {
            # code...
            if (Input::hasFile('image')) {
            $file = Input::file('image');
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);

            $makan->user_id = Auth::user()->id;
            $makan->nameMakanan  = $makanname;
            $makan->slugMakanan = str_slug($makanname);
            $makan->descriptionMakanan = $request->get('description');
            $makan->priceMakanan = $request->get('price');
            $makan->imageMakanan = 'http://localhost/restoran/public/uploads/' . $filename;
            $makan->thumbMakanan = 'http://192.168.1.22/restoran/public/uploads/' . $filename;
            $makan->save();

            Session::flash('flash_success', 'Berhasil menambahkan makanan baru');

            return redirect()->route('makan');

            } else {

                $makan->user_id = Auth::user()->id;
                $makan->nameMakanan  = $makanname;
                $makan->slugMakanan = str_slug($makanname);
                $makan->descriptionMakanan = $request->get('description');
                $makan->priceMakanan = $request->get('price');
                $makan->imageMakanan = 'https://placehold.it/171x180';
                $makan->thumbMakanan = 'https://placehold.it/171x180';
                $makan->save();

                Session::flash('flash_success', 'Berhasil menambahkan makanan baru');
                return redirect()->route('makan');
            }

        } else {

           Session::flash('flash_exist_data', 'Makanan yang akan ditambahkan sudah ada di daftar makanan');
           return redirect()->route('makan.buat');
        }

    	
    }

    public function show($slug)
    {
        $makanan = Makanan::where('slugMakanan', $slug)->first();
        return view('makanan.show', compact('makanan'));
    }

    public function edit(Makanan $makanan)
    {
        return view('makanan.edit', compact('makanan'));
    }

    public function update(Request $request, Makanan $makanan)
    {
        $makanname = $request->get('name');
        $query = Makanan::where('nameMakanan', '=', $makanname)->first();

        if ($query == null) {
            if (Input::hasFile('image')) {
            $file = Input::file('image');
            $filename = $file->getClientOriginalName();
            $file->move('uploads', $filename);

            $makanan->user_id = Auth::user()->id;
            $makanan->nameMakanan  = $makanname;
            $makanan->slugMakanan = str_slug($makanname);
            $makanan->descriptionMakanan = $request->get('description');
            $makanan->priceMakanan = $request->get('price');
            $makanan->imageMakanan = 'http://192.168.1.5/restoran/public/uploads/' . $filename;
            $makanan->thumbMakanan = 'http://192.168.1.5/restoran/public/uploads/' . $filename;
            $makanan->update();

            Session::flash('flash_update', 'Berhasil update info makanan');
            return redirect('makanan');

            } else {

                $makanan->user_id = Auth::user()->id;
                $makanan->nameMakanan  = $makanname;
                $makanan->slugMakanan = str_slug($makanname);
                $makanan->descriptionMakanan = $request->get('description');
                $makanan->priceMakanan = $request->get('price');
                $makanan->imageMakanan = 'https://placehold.it/171x180';
                $makanan->thumbMakanan = 'https://placehold.it/171x180';
                $makanan->update();

                Session::flash('flash_update', 'Berhasil update info makanan');
                return redirect()->route('makan');
            }

        } else {

            Session::flash('flash_exist_data', 'Makanan yang akan ditambahkan sudah ada di daftar makanan');
           return redirect()->route('makan.edit', $makanan->id);

        }

        
    }

    public function destroy($id)
    {
    	Makanan::destroy($id);

        Session::flash('flash_delete', 'Berhasil menghapus makanan');
        return redirect()->route('makan');
    }

}
