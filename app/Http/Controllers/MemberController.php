<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(Request $request)
    {
    	if ($keyword = $request->get('keyword')) {
    		$keyword = Input::get('keyword', '');
    		$members = Member::SearchByKeyword($keyword)->orderBy('id', 'DESC')->paginate(5);
    	
    	} else {
    		$members = Member::orderBy('id', 'DESC')->paginate(5);
    	} 

        return view('member.index', compact('members'));
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request, Member $member)
    {
        $getemail = $request->get('email');
        $getusername = $request->get('username');
        $query = Member::where('emailMember', $getemail)
        				->orWhere('usernameMember', $getusername)
        				->first();

        if ($query == null) { 
            $member->nameMember  = $request->get('name');
            $member->emailMember = $getemail;
            $member->usernameMember = $getusername;
            $member->password = $request->get('password');
            $member->imageMember = 'http://localhost/restoran/public/uploads/';
            $member->save();

            Session::flash('flash_success', 'Berhasil menambahkan member baru');

            return redirect()->route('member');


        } else {

           Session::flash('flash_exist_data', 'member yang akan ditambahkan sudah ada di daftar member');
           return redirect()->route('member.buat');
        }

    	
    }

    public function show(Member $member)
    {
        return view('member.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('member.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $getemail = $request->get('email');
        $getusername = $request->get('username');
        $query = Member::where('emailMember', $getemail)
        				->orWhere('usernameMember', $getusername)
        				->first();

        if ($query == null) { 
            $member->nameMember  = $request->get('name');
            $member->emailMember = $getemail;
            $member->usernameMember = $getusername;
            $member->password = $request->get('password');
            $member->imageMember = 'http://localhost/restoran/public/uploads/';
            $member->thumbMember = 'http://localhost/restoran/public/uploads/';
            $member->update();

            Session::flash('flash_update', 'Berhasil Update member');

            return redirect()->route('member');


        } else {

           Session::flash('flash_exist_data', 'member yang akan ditambahkan sudah ada di daftar member');
           return redirect()->route('member');
        }

        
    }

    public function destroy($id)
    {
    	Member::destroy($id);

        Session::flash('flash_delete', 'Berhasil menghapus member');
        return redirect()->route('member');
    }
}
