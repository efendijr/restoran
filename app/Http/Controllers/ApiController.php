<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Makanan;
use App\Member;
use App\Tesslug;
use App\Testing;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    
	public function apiMakanan(User $user)
    {

    	$makanan = DB::table('makanans')
                    ->leftjoin('users', 'users.id', '=', 'makanans.user_id')
                    ->get();

        foreach ($makanan as $makan) {
            $response['makanan'][] = [
                'idMakanan' => $makan->id,
                'nameMakanan' => $makan->nameMakanan,
                'descriptionMakanan' => $makan->descriptionMakanan,
                'priceMakanan' => $makan->priceMakanan,
                'thumbMakanan' => $makan->thumbMakanan,
                'idWarung' => $makan->user_id,
                'nameWarung' => $makan->name,
                'thumbWarung' => $makan->thumb,
            ];
        }

        return Response::json($response);
    }

    /*
        Registrasi API
     */
    public function registrasiMember(Request $request, Member $member)
    {
        $email = $request->get('email');   
        $getEmail = Member::where('emailMember', $email)->first();

        if ($getEmail == null) {
            $member->nameMember = $request->get('name');
            $member->emailMember = $request->get('email');
            $member->usernameMember = $request->get('username');
            $member->password = bcrypt($request->get('password'));
            $member->imageMember = "https://placehold.it/172x180";
            $member->thumbMember = "https://placehold.it/172x180";
            $member->depositeMember = 1000;
            $member->save();

             return json_encode(array(
                "status" => false,
                "message" => "berhasil"
                ));

        } else {

            return json_encode(array(
                "status" => false,
                "message" => "data was existed"
                ));
        }
    }

    /*
        payment save
     */
    
    public function paymentRestoran()
    {
        
        return null;
    }

    /*
        Login API
     */
    public function loginMember(Request $request, Member $member)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        
        $getMember = Member::where('emailMember', $email)->first();
        $getMember1 = Member::where('emailMember', $email)->get();
        
        if ($getMember != null) {
            foreach ($getMember1 as $value) {
                $result["status"] = true;
                $result["result"] = array(
                    "nameMember" => $value["nameMember"],
                    "emailMember" => $value["emailMember"],
                    "usernameMember" => $value["usernameMember"],
                    "imageMember" => $value["imageMember"],
                    "depositeMember" => $value["depositeMember"],
                    "created_at" => $value["created_at"],
                    "updated_at" => $value["updated_at"]
                    );
            }

            return json_encode($result);

        } else {
            
            return json_encode(array(
                "status" => false,
                "message" => "email tidak ditemukan"
                ));
        }
    }

    public function testing()
    {
        $testing = Testing::all();

        return View('artikel', compact('testing'));
    }

    public function testingslug($slug)
    { 
        $testing = Testing::where('slug', $slug)->first();
        return View('artikelDetail', compact('testing'));
    }

    public function tesslug()
    {
        $tesslug = Tesslug::all();

        return View('artikel', compact('tesslug'));
    }

    public function createslug()
    {
        return View('createslug');
    }

    public function storeslug(Request $request, Tesslug $tesslug)
    {
        $title1 = $request->get('title');
        $tesslug->title = $title1;
        $tesslug->description = $request->get('description');
        $tesslug->slug = str_slug($title1);
        $tesslug->save();

        return redirect('tesslug');
    }

    public function tesslugDetail($slug)
    {
        $tesslug = Tesslug::where('slug', $slug)->first();
        return View('artikelDetail', compact('tesslug'));
    }
    
}
