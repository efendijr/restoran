<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiMemberController extends Controller
{
    
	public function registrasi(Request $request, Member $member)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password');
        
        $checkEmail = Member::where('emailMember', $email)->count();
        $checkUserName = Member::where('usernameMember', $username)->count();

        if (($checkEmail < 1) && ($checkUserName < 1) ) {
            $member->nameMember = $name;
            $member->emailMember = $email;
            $member->usernameMember = $name;
            $member->password = bcrypt($password);
            $member->imageMember = "https://placehold.it/172x180";
            $member->thumbMember = "https://placehold.it/172x180";
            $member->save();

            $getMember = Member::where('emailMember', $email)->first();

            return (array('status' => true, 'member' => $getMember));
            
        } elseif($checkEmail != null) {
            return json_encode(array(
                "status" => false,
                "message" => "email sudah terdaftar"
                ));
        } elseif ($checkUserName != null) {
            return json_encode(array(
                "status" => false,
                "message" => "username sudah terdaftar"
                ));
        }
    }

  
    public function login(Request $request, Member $member)
    {
        
        $emailnusername = $request->get('emailnusername');
        $password = $request->get('password');
        $checkEmail = Member::where('emailMember', $emailnusername)->count();
        $checkUsername = Member::where('usernameMember', $emailnusername)->count();

        if ($checkEmail > 0) {
            $getPassword1 = Member::where('emailMember', $emailnusername)->first()->password;

            if (Hash::check($password, $getPassword1)) { // check credential
               
                $getMember1 = Member::where('emailMember', $emailnusername)->first();
                return (array('status' => true, 'member' => $getMember1));
            
            } else {
                return (array(
                    "status" => false,
                    "message" => "email dan password tidak cocok"));
            }

        } elseif ($checkUsername > 0) {
        	$getPassword2 = Member::where('usernameMember', $emailnusername)->first()->password;

        	if (Hash::check($password, $getPassword2)) {
        		$getMember2 = Member::where('usernameMember', $emailnusername)->first();

        		return (array('status' => true, 'member' => $getMember2));

        	} else {

        		return (array('status' => false, 'message' => 'username dan password tidak cocok'));

        	}
        
        } else {
            return (array(
                "status" => false,
                "message" => "email dan username tidak terdaftar"
                ));            
        }

    }

    public function update(Request $request, Member $member)
    {
        $name = $request->get('name');
        $address = $request->get('address');
        $phone = $request->get('phone');
        $email = $request->get('email');

        $getName = Member::where('nameMember', $name)->first();
        $getName1 = Member::where('emailMember', $email)->first()->nameMember;

        if ($getName == null || ($name == $getName1)) {
                
            $rubah = Member::where('emailMember', $email)
                        ->update([
                            'nameMember' => $name, 
                            'addressMember' => $address,
                            'phoneMember' => $phone
                            ]);


                if ($rubah != null) {
                    
                    return (array("status" => true, "message" => "berhasil update member"));
                
                } else {

                    return (array("status" => false, "message" => "gagal update data"));
                }
        
        } else {
           return json_encode(array(
                    "status" => false,
                    "message" => "nama sudah ada" 
                    ));
        }

    }

    public function rubahGambar(Request $request)
    {
        $emailMember = $request->get('email');
        $file = $request->file('image');
        $filename = str_random(20) . '.' . $file->guessClientExtension();
                $file->move('uploads', $filename); 
        
        $updateGambar = Member::where('emailMember', $emailMember)
                        ->update([
                        'imageMember' => $filename,
                        'thumbMember' => 'http://192.168.1.4/restoran/public/uploads/'.$filename
                        ]);

        if ($updateGambar != null) {
             
             return array("status" => true, "message" => "berhasil update gambar");
         } else {
             return array("status" => false, "message" => "gagal update gambar");
         }
        

    }
    


}
