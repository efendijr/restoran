<?php

use App\Http\Requests\Request;
use App\Bayar;
use App\Payment;
use App\Tesslug;
use App\Testing;
use App\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [
	'as' => 'home',
	'uses' => function(){
		return view('welcome');
	}
]);

Route::get('api/tesmakanan', 'Api\ApiMakananController@allmakanan');

/*
	tabel admin
 */
Route::get('admin/register', [ 'as' => 'admin.register', 'uses' => 'AuthAdmin\AuthController@showRegister']);
Route::post('admin/register', ['as' => 'admin.register', 'uses' => 'AuthAdmin\AuthController@postRegister']);
Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'AuthAdmin\AuthController@showLogin']);
Route::post('admin/login', ['as' => 'admin.loginpost', 'uses' => 'AuthAdmin\AuthController@postLogin']);
Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'AuthAdmin\AuthController@logout']);
Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);

/*
	tabel user
 */
Route::get('admin/warung', ['as' => 'warung', 'uses' => 'UserController@index']);
Route::get('admin/warung/{user}/detail', ['as' => 'warung.detail', 'uses' => 'UserController@show']);
Route::get('admin/warung/buat', ['as' => 'warung.buat', 'uses' => 'UserController@create']);
Route::post('admin/warung/simpan', ['as' => 'warung.simpan', 'uses' => 'UserController@store']);
Route::get('admin/warung/{user}/edit', ['as' => 'warung.edit', 'uses' => 'UserController@edit']);
Route::put('admin/warung/{user}/update', ['as' => 'warung.update','uses' => 'UserController@update']);
Route::get('admin/warung/{user}/delete', ['as' => 'warung.delete', 'uses' => 'UserController@destroy']);


Route::resource('category', 'CategoryController');
Route::get('category/{category}/delete', ['as' => 'category.delete', 'uses' => 'CategoryController@destroy']);

/*
	tabel makanan
 */
Route::get('makanan/{makanan}/delete', ['as' => 'makanan.delete','uses' => 'MakananController@destroy']);
Route::resource('makanan', 'MakananController');

/*
	tabel member
 */
Route::get('member/{member}/delete', ['as' => 'member.delete', 'uses' => 'MemberController@destroy']);
Route::resource('member', 'MemberController');

/*
	buydeposite table
 */

Route::get('buydeposite/{buydeposite}/delete', ['as' => 'buydeposite.delete', 'uses' => 'BuydepositeController@destroy']);
Route::resource('buydeposite', 'BuydepositeController');

/*
	selldeposite
 */
Route::get('selldeposite/{selldeposite}/delete', ['as' => 'selldeposite.delete', 'uses' => 'SelldepositeController@destroy']);
Route::resource('selldeposite', 'SelldepositeController');

/*
	payment tabel
 */
Route::get('payment/{payment}/delete', ['as' => 'payment.delete', 'uses' => 'PaymentController@destroy']);
Route::resource('payment', 'PaymentController');

/*
	pengiriman table
 */
Route::get('pengiriman/{pengiriman}/delete', ['as' => 'pengiriman.delete', 'uses' => 'PengirimanController@destroy']);
Route::resource('pengiriman', 'PengirimanController');

Route::get('kecamatan/{kecamatan}/delete', ['as' => 'kecamatan.delete', 'uses' => 'KecamatanController@destroy']);
Route::resource('kecamatan', 'KecamatanController');

/*
	API untuk android
 */
// registrasi member baru
Route::post('api/member/registrasi', 'ApiController@registrasiMember');
// login member
Route::post('api/member/login', 'ApiController@loginMember');
// get makanan
Route::get('api/getmakan', 'ApiController@apiMakanan');
// payment
Route::post('payment/makan', ['as' => 'payment.makan', 'uses' => 'ApiController@paymentResto']);
// get restoran
Route::get('api/getresto', 'ApiController@getrestoran');
Route::post('api/getmakan2', 'ApiController@getmakanan');


Route::post('getid', 'ApiController@getid');
Route::get('getuser', 'ApiController@getuser');
Route::post('getmember', 'ApiController@getMember');
Route::post('usingtoken', 'ApiController@usingtoken');

// Route::post('anggota', 'TokenController@register');
// Route::post('anggotalog', 'TokenController@login');
Route::post('updatemember', 'ApiController@updatemember');
Route::post('historypayment', 'ApiController@historypayment');
Route::post('paymentdetail', 'ApiController@paymentdetailbyid');
Route::post('getrestodetail', 'ApiController@getrestodetail');
Route::post('getmakananbyidresto', 'ApiController@getmakananbyidresto');


Route::auth();

Route::get('/home', 'HomeController@index');

/*
 perbaikan link API
 */

/**
 * API\ApiMakanan
 */
Route::get('api/makanan/list', 'Api\ApiMakananController@list');
Route::post('api/makanan/byresto', 'Api\ApiMakananController@makananbyresto');
Route::get('api/makanan/mostpay', 'Api\ApiPaymentController@mostpayment');

Route::get('api/makanan/listmakanan', 'Api\ApiMakananController@listmakanan');
Route::get('api/makanan/listminuman', 'Api\ApiMakananController@listminuman');

Route::post('api/makanan/detailmakanan', 'Api\ApiMakananController@detailmakanan');
Route::post('api/makanan/carimakanan', 'Api\ApiMakananController@carimakanan');
Route::post('api/makanan/hasilcari', 'Api\ApiMakananController@hasilcari');

/**
 * API\ApiMember
 */
Route::post('api/member/registrasi', 'Api\ApiMemberController@registrasi');
Route::post('api/member/login', 'Api\ApiMemberController@login');
Route::post('api/member/update', 'Api\ApiMemberController@update');
Route::post('api/member/rubahgambar', 'Api\ApiMemberController@rubahGambar');


/**
 * API\ApiPayment
 */
Route::post('api/payment', 'Api\ApiPaymentController@index');
Route::post('api/payment/list', 'Api\ApiPaymentController@listpayment');
Route::post('api/payment/detail', 'Api\ApiPaymentController@paymentdetail');

/**
 * API\ApiDeposite
 */
Route::post('api/deposite', 'Api\ApiDepositeController@tukardeposite');
Route::post('api/deposite/ditukar', 'Api\ApiDepositeController@penukarandeposite');


/* API Cart*/
Route::post('api/terimacart', 'Api\ApiCartController@terimaCart');
Route::post('api/editcart', 'Api\ApiCartController@editCart');
Route::post('api/hapuscart', 'Api\ApiCartController@hapusCart');
Route::post('api/tampilkancart', 'Api\ApiCartController@tampilkanCart');
Route::post('api/totalcart', 'Api\ApiCartController@totalCart');
Route::post('api/jumlahcart', 'Api\ApiCartController@jumlahCart');

/* API Alamat*/
Route::post('api/listalamat', 'Api\ApiAlamatController@listAlamat');
Route::post('api/tambahalamat', 'Api\ApiAlamatController@tambahAlamat');
Route::post('api/editalamat', 'Api\ApiAlamatController@editAlamat');
Route::post('api/updatealamat', 'Api\ApiAlamatController@updateAlamat');
Route::post('api/hapusalamat', 'Api\ApiAlamatController@hapusAlamat');
Route::post('api/kodealamat', 'Api\ApiAlamatController@kodeAlamat');



Route::post('api/cartcomplete', 'Api\ApiBayarController@bayarBarang');
