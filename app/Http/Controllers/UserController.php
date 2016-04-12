<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
	function __construct()
	{
		return $this->middleware('admin');
	}

	public function index(Request $request)
	{
		if ($keyword = $request->get('keyword')) {
			$keyword = Input::get('keyword', '');
			$users = User::SearchByKeyword($keyword)->orderBy('id', 'DESC')->paginate(5);
		} else {
			$users = User::orderBy('id', 'DESC')->paginate(5);
		}

	    return view('warung.index', compact('users'));
	}

	public function show(User $user)
	{
	    return view('warung.show', compact('user'));
	}

	public function create()
	{
	    return view('warung.create');
	}

	public function store(Request $request, User $user)
	{
		$getname = $request->get('name');
		$getemail = $request->get('email');
		$getalias = $request->get('alias');
		$checkUser = User::where('name', $getname)
							->orWhere('email', $getemail)
							->orWhere('alias', $getalias)
							->first();
	    
		if ($checkUser == null) {
            # code...
            if (Input::hasFile('logo')) {
	            $file = Input::file('logo');
	            $filename = $file->getClientOriginalName();
	            $file->move('uploads', $filename);

	            $user->name = $getname;
	            $user->email = $getemail;
	            $user->password = bcrypt($request->get('password'));
	            $user->description = $request->get('description');
	            $user->alias = $getalias;
	            $user->address = $request->get('address');
	            $user->logo = 'http://192.168.1.18/restoran/public/uploads/' . $filename;
	            $user->thumb = 'http://192.168.1.18/restoran/public/uploads/' . $filename;
	            $user->save();


	            Session::flash('flash_success', 'Berhasil menambahkan makanan baru');

	            return redirect()->route('warung');

            } else {

            	$user->name = $getname;
	            $user->email = $getemail;
	            $user->password = bcrypt($request->get('password'));
	            $user->description = $request->get('description');
	            $user->alias = $getalias;
	            $user->address = $request->get('address');
	            $user->logo = 'https://placehold.it/171x180';
	            $user->thumb = 'https://placehold.it/171x180';
	            $user->save();

	                
                Session::flash('flash_success', 'Berhasil menambahkan makanan baru');
                return redirect()->route('warung');
            }

        } else {

           Session::flash('flash_exist_data', 'Makanan yang akan ditambahkan sudah ada di daftar makanan');
           return redirect()->route('warung.buat');
        }

	}

	public function edit(User $user)
	{
	    return view('warung.edit', compact('user'));
	}

	public function update(Request $request, User $user)
	{
	    $getname = $request->get('name');
		$getemail = $request->get('email');
		$getalias = $request->get('alias');
		$checkUser = User::where('name', $getname)
							->orWhere('email', $getemail)
							->orWhere('alias', $getalias)
							->first();
	    
		if ($checkUser == null) {
            # code...
            if (Input::hasFile('logo')) {
	            $file = Input::file('logo');
	            $filename = $file->getClientOriginalName();
	            $file->move('uploads', $filename);

	            $user->name = $getname;
	            $user->email = $getemail;
	            // $user->password = bcrypt($request->get('password'));
	            $user->description = $request->get('description');
	            $user->alias = $getalias;
	            $user->address = $request->get('address');
	            $user->logo = 'http://192.168.1.18/restoran/public/uploads/' . $filename;
	            $user->thumb = 'http://192.168.1.18/restoran/public/uploads/' . $filename;
	            $user->update();


	            Session::flash('flash_update', 'Berhasil update info makanan');

	            return redirect()->route('warung');

            } else {

            	$user->name = $getname;
	            $user->email = $getemail;
	            // $user->password = bcrypt($request->get('password'));
	            $user->description = $request->get('description');
	            $user->alias = $getalias;
	            $user->address = $request->get('address');
	            $user->logo = 'https://placehold.it/171x180';
	            $user->thumb = 'https://placehold.it/171x180';
	            $user->update();

	                
                Session::flash('flash_update', 'Berhasil update info makanan');
                return redirect()->route('warung');
            }

        } else {

           Session::flash('flash_exist_data', 'Makanan yang akan ditambahkan sudah ada di daftar makanan');
           return redirect()->route('warung');
        }
	}

	public function destroy($id)
	{
		User::destroy($id);

		Session::flash('flash_delete', 'Berhasil menghapus user');
	    return redirect()->route('warung');
	}
    
}
