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
            'price' => 'required|numeric|min:10',
            'diskon' => 'numeric|min:0|max:90',
            'image' => 'mimes: jpg,jpeg,png|max:1000',
        ];

        $this->validate($request, $rules);

        $makanname = $request->get('name');
        $price = $request->get('price');
        $diskon = $request->get('diskon');
        // $diskon1 = $diskon / 100;
        $lastPrice = $price - (($diskon / 100) * $price);
        $query = Makanan::where('nameMakanan', $makanname)->first();

        if ($query == null) {
            # code...
            if (Input::hasFile('image')) {
                $file = Input::file('image');
                $filename = str_random(20) . '.' . $file->guessClientExtension();
                $file->move('uploads', $filename);

            $makan->user_id = Auth::user()->id;
            $makan->category = $request->get('category');
            $makan->nameMakanan  = $makanname;
            $makan->slugMakanan = str_slug($makanname);
            $makan->descriptionMakanan = $request->get('description');
            $makan->priceMakanan = $request->get('price');
            $makan->diskonMakanan = $diskon;
            $makan->lastPriceMakanan = $lastPrice;
            $makan->imageMakanan = $filename;
            $makan->thumbMakanan = 'http://192.168.43.76/restoran/public/uploads/' . $makan->imageMakanan;
            $makan->save();

            Session::flash('flash_success', 'Berhasil menambahkan makanan baru');

            return redirect()->route('makanan.index');

            } else {

                $makan->user_id = Auth::user()->id;
                $makanan->category = $request->get('category');
                $makan->nameMakanan  = $makanname;
                $makan->slugMakanan = str_slug($makanname);
                $makan->descriptionMakanan = $request->get('description');
                $makan->priceMakanan = $request->get('price');
                $makan->diskonMakanan = $diskon;
                $makan->lastPriceMakanan = $lastPrice;
                $makan->imageMakanan = 'https://placehold.it/171x180?text=' . $makanname;
                $makan->thumbMakanan = 'https://placehold.it/171x180?text=' . $makanname;
                $makan->save();

                Session::flash('flash_success', 'Berhasil menambahkan makanan baru');
                return redirect()->route('makanan.index');
            }

        } else {

           Session::flash('flash_exist_data', 'Makanan yang akan ditambahkan sudah ada di daftar makanan');
           return redirect()->route('makanan.create');
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
         $rules = [
            'name' => 'required|min:3|max:20',
            'description' => 'required|min:10|max:255',
            'price' => 'required|numeric|min:10',
            'diskon' => 'numeric|min:0|max:90',
            'image' => 'mimes: jpg,jpeg,png|max:1000',
        ];

        $this->validate($request, $rules);

        $makanname = $request->get('name');
        $price = $request->get('price');
        $diskon = $request->get('diskon');
        // $diskon1 = $diskon / 100;
        $lastPrice = $price - (($diskon / 100) * $price);
        $query = Makanan::where('nameMakanan', '=', $makanname)->first();
        $getnameMakanan = Makanan::where('nameMakanan', '=', $makanname)->first()->nameMakanan;

        if ($query == null || ($makanname == $getnameMakanan))  {

            // if (Input::hasFile('image')) {
            // $file = Input::file('image');
            // $filename = $file->getClientOriginalName();
            // $file->move('uploads', $filename);

             # code...
            if (Input::hasFile('image')) {
                $file = Input::file('image');
                $filename = str_random(20) . '.' . $file->guessClientExtension();
                $file->move('uploads', $filename);

            $makanan->user_id = Auth::user()->id;
            $makanan->category = $request->get('category');
            $makanan->nameMakanan  = $makanname;
            $makanan->slugMakanan = str_slug($makanname);
            $makanan->descriptionMakanan = $request->get('description');
            $makanan->priceMakanan = $request->get('price');
            $makanan->diskonMakanan = $diskon;
            $makanan->lastPriceMakanan = $lastPrice;
            $makanan->imageMakanan = $filename;
            $makanan->thumbMakanan = 'http://192.168.43.76/restoran/public/uploads/' . $filename;
            $makanan->update();

            Session::flash('flash_update', 'Berhasil update info makanan');
            return redirect()->route('makanan.index');

            } else {

                $makanan->user_id = Auth::user()->id;
                $makanan->category = $request->get('category');
                $makanan->nameMakanan  = $makanname;
                $makanan->slugMakanan = str_slug($makanname);
                $makanan->descriptionMakanan = $request->get('description');
                $makanan->priceMakanan = $request->get('price');
                $makanan->diskonMakanan = $diskon;
                $makanan->lastPriceMakanan = $lastPrice;
                // $makanan->imageMakanan = $makanname;
                // $makanan->thumbMakanan = $makanname;
                $makanan->update();

                Session::flash('flash_update', 'Berhasil update info makanan');
                return redirect()->route('makanan.index');
            }

        } else {

            Session::flash('flash_exist_data', 'Makanan yang akan ditambahkan sudah ada di daftar makanan');
           return redirect()->route('makanan.edit', $makanan->id);

        }

    }

    public function destroy($id)
    {
    	Makanan::destroy($id);

        Session::flash('flash_delete', 'Berhasil menghapus makanan');
        return redirect()->route('makanan.index');
    }

}
