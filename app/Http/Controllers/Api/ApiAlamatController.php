<?php

namespace App\Http\Controllers\Api;

use App\Alamat;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Member;
use Illuminate\Http\Request;

class ApiAlamatController extends Controller
{
    public function listAlamat(Request $request)
    {
    	$emailMember = $request->get('email');
    	$getMember = Member::where('emailMember', $emailMember)->first()->id;
    	$getAlamat = Alamat::where('member_id', $getMember)->get();
    	return array('alamat' => $getAlamat);
    }

    public function tambahAlamat(Request $request)
    {
    	$emailMember = $request->get('email');
    	$getMember = Member::where('emailMember', $emailMember)->first()->id;
    	$tambahAlamat = Alamat::create([
    		'member_id' => $getMember,
    		'namaPenerima' => $request->get('namaPenerima'),
  			'alamatPenerima' => $request->get('alamatPenerima'),
  			'kecamatanPenerima' => $request->get('kecamatanPenerima'),
  			'telponPenerima' => $request->get('telponPenerima'),
              'kode' => 0
    		]);

    	if ($tambahAlamat != null) {
    		return array("status" => true, "message" => "berhasil menambahkan alamat");
    	} else {
    		return array("status" => false, "message" => "gagal menambahkan alamat");
    	}

    }

    public function editAlamat(Request $request)
    {
    	$getId = $request->get('alamatId');
    	$getAlamat = Alamat::findOrFail($getId);

    	return $getAlamat;
    }

    public function updateAlamat(Request $request)
    {
    	$getId = $request->get('alamatId');
    	$updateAlamat = Alamat::where('id', $getId)
    					->update([
    						'namaPenerima' => $request->get('namaPenerima'),
  							'alamatPenerima' => $request->get('alamatPenerima'),
  							'kecamatanPenerima' => $request->get('kecamatanPenerima'),
  							'telponPenerima' => $request->get('telponPenerima')
    						]);

    	if ($updateAlamat != null) {
    		return array("status" => true, "message" => "berhasil update alamat");
    	} else {
    		return array("status" => false, "message" => "gagal update alamat");
    	}
    }

    public function hapusAlamat(Request $request)
    {
    	$getId = $request->get('alamatId');
    	$deleteAlamat = Alamat::destroy($getId);
    	if ($deleteAlamat != null) {
    		return array("status" => true, "message" => "berhasil menghapus alamat");
    	} else {
    		return array("status" => false, "message" => "gagal menghapus alamat");
    	}
    }

    public function kodeAlamat(Request $request)
    {
        $getId = $request->get('alamatId');
        $getEmail = $request->get('email');
        $getMember = Member::where('emailMember', $getEmail)->first()->id;
        $gantiKode = Alamat::where('member_id', $getMember)
                        ->update([
                            'kode' => 0
                            ]);
        if ($gantiKode != null) {
            $kodeAlamat = Alamat::where('id', $getId)
                        ->update([
                            'kode' => 1
                            ]);

            return 'kode jadi 1';
        } else {
            $gantiKode = Alamat::where('member_id', $getMember)
                        ->update([
                            'kode' => 0
                            ]);
            return 'kode jadi 0 semua';
        }
    }

}
