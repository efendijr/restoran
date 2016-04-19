<?php

use App\Tesslug;
use App\Testing;
use App\User;

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

Route::get('getmax', 'ApiController@getmax');

Route::get('/home', [
	'as' => 'home.login',
	'uses' => 'HomeController@index',
]);

Route::get('tes', 'TesController@index');

Route::get('admin/register', [
	'as' => 'admin.register',
	'uses' => 'AuthAdmin\AuthController@showRegister'
]);
Route::post('admin/register', [
	'as' => 'admin.register',
	'uses' => 'AuthAdmin\AuthController@postRegister'
]);
Route::get('admin/login', [
	'as' => 'admin.login',
	'uses' => 'AuthAdmin\AuthController@showLogin',
]);
Route::post('admin/login', [
	'as' => 'admin.loginpost',
	'uses' => 'AuthAdmin\AuthController@postLogin',
]);
Route::get('admin/logout', [
	'as' => 'admin.logout',
	'uses' => 'AuthAdmin\AuthController@logout',
]);
Route::get('admin', [
	'as' => 'admin',
	'uses' => 'AdminController@index',
]);

/*
	tabel user
 */
Route::get('admin/warung', [
	'as' => 'warung',
	'uses' => 'UserController@index',
]);
Route::get('admin/warung/{user}/detail', [
	'as' => 'warung.detail',
	'uses' => 'UserController@show',
]);
Route::get('admin/warung/buat', [
	'as' => 'warung.buat',
	'uses' => 'UserController@create',
]);
Route::post('admin/warung/simpan', [
	'as' => 'warung.simpan',
	'uses' => 'UserController@store',
]);
Route::get('admin/warung/{user}/edit', [
	'as' => 'warung.edit',
	'uses' => 'UserController@edit',
]);
Route::put('admin/warung/{user}/update', [
	'as' => 'warung.update',
	'uses' => 'UserController@update',
]);
Route::get('admin/warung/{user}/delete', [
	'as' => 'warung.delete',
	'uses' => 'UserController@destroy',
]);

/*
	tabel makanan
 */
Route::get('makanan', [
	'as' => 'makan',
	'uses' => 'MakananController@index',
]);
Route::get('makanan/buat', [
	'as' => 'makan.buat',
	'uses' => 'MakananController@create',
]);
Route::post('makanan/simpan', [
	'as' => 'makan.simpan',
	'uses' => 'MakananController@store',
]);
Route::get('makanan/{makanan}', [
	'as' => 'makan.detail',
	'uses' => 'MakananController@show',
]);
Route::get('makanan/{makanan}/edit', [
	'as' => 'makan.edit',
	'uses' => 'MakananController@edit',
]);

Route::put('makanan/{makanan}/update', [
	'as' => 'makan.update',
	'uses' => 'MakananController@update',
]);
Route::get('makanan/{makanan}/delete', [
	'as' => 'makan.delete',
	'uses' => 'MakananController@destroy',
]);

/*
	tabel member
 */
Route::get('admin/member', [
	'as' => 'member',
	'uses' => 'MemberController@index',
]);
Route::get('admin/member/buat', [
	'as' => 'member.buat',
	'uses' => 'MemberController@create',
]);
Route::post('admin/member/simpan', [
	'as' => 'member.simpan',
	'uses' => 'MemberController@store',
]);
Route::get('admin/member/{member}/detail', [
	'as' => 'member.detail',
	'uses' => 'MemberController@show',
]);
Route::get('admin/member/{member}/edit', [
	'as' => 'member.edit',
	'uses' => 'MemberController@edit',
]);
Route::put('admin/member/{member}/update', [
	'as' => 'member.update',
	'uses' => 'MemberController@update',
]);
Route::get('admin/member/{member}/delete', [
	'as' => 'member.delete',
	'uses' => 'MemberController@destroy',
]);

/*
	buydeposite table
 */
Route::get('admin/buydeposite', [
	'as' => 'buydeposite',
	'uses' => 'BuydepositeController@index',
]);
Route::get('admin/buydeposite/buat', [
	'as' => 'buydeposite.buat',
	'uses' => 'BuydepositeController@create',
]);
Route::post('admin/buydeposite/simpan', [
	'as' => 'buydeposite.simpan',
	'uses' => 'BuydepositeController@store',
]);
Route::get('admin/buydeposite/{buydeposite}/detail', [
	'as' => 'buydeposite.detail',
	'uses' => 'BuydepositeController@show',
]);
Route::get('admin/buydeposite/{buydeposite}/edit', [
	'as' => 'buydeposite.edit',
	'uses' => 'BuydepositeController@edit',
]);
Route::put('admin/buydeposite/{buydeposite}/update', [
	'as' => 'buydeposite.update',
	'uses' => 'BuydepositeController@update',
]);
Route::get('admin/buydeposite/{buydeposite}/delete', [
	'as' => 'buydeposite.delete',
	'uses' => 'BuydepositeController@destroy',
]);

/*
	selldeposite
 */

Route::get('admin/selldeposite', [
	'as' => 'selldeposite',
	'uses' => 'SelldepositeController@index',
]);
Route::get('admin/selldeposite/buat', [
	'as' => 'selldeposite.buat',
	'uses' => 'SelldepositeController@create',
]);
Route::post('admin/selldeposite/simpan', [
	'as' => 'selldeposite.simpan',
	'uses' => 'SelldepositeController@store',
]);
Route::get('admin/selldeposite/{selldeposite}/detail', [
	'as' => 'selldeposite.detail',
	'uses' => 'SelldepositeController@show',
]);
Route::get('admin/selldeposite/{selldeposite}/edit', [
	'as' => 'selldeposite.edit',
	'uses' => 'SelldepositeController@edit',
]);
Route::put('admin/selldeposite/{selldeposite}/update', [
	'as' => 'selldeposite.update',
	'uses' => 'SelldepositeController@update',
]);
Route::get('admin/selldeposite/{selldeposite}/delete', [
	'as' => 'selldeposite.delete',
	'uses' => 'SelldepositeController@destroy',
]);

/*
	payment tabel
 */

Route::get('admin/payment', [
	'as' => 'payment',
	'uses' => 'PaymentController@index',
]);
Route::get('admin/payment/buat', [
	'as' => 'payment.buat',
	'uses' => 'PaymentController@create',
]);
Route::post('admin/payment/simpan', [
	'as' => 'payment.simpan',
	'uses' => 'PaymentController@store',
]);
Route::get('admin/payment/{payment}/detail', [
	'as' => 'payment.detail',
	'uses' => 'PaymentController@show',
]);
Route::get('admin/payment/{payment}/edit', [
	'as' => 'payment.edit',
	'uses' => 'PaymentController@edit',
]);
Route::put('admin/payment/{payment}/update', [
	'as' => 'payment.update',
	'uses' => 'PaymentController@update',
]);
Route::get('admin/payment/{payment}/delete', [
	'as' => 'payment.delete',
	'uses' => 'PaymentController@destroy',
]);


/*
	pengiriman table
 */

Route::get('admin/pengiriman', [
	'as' => 'pengiriman',
	'uses' => 'PengirimanController@index',
]);
Route::get('admin/pengiriman/buat', [
	'as' => 'pengiriman.buat',
	'uses' => 'PengirimanController@create',
]);
Route::post('admin/pengiriman/simpan', [
	'as' => 'pengiriman.simpan',
	'uses' => 'PengirimanController@store',
]);
Route::get('admin/pengiriman/{pengiriman}/detail', [
	'as' => 'pengiriman.detail',
	'uses' => 'PengirimanController@show',
]);
Route::get('admin/pengiriman/{pengiriman}/edit', [
	'as' => 'pengiriman.edit',
	'uses' => 'PengirimanController@edit',
]);
Route::put('admin/pengiriman/{pengiriman}/update', [
	'as' => 'pengiriman.update',
	'uses' => 'PengirimanController@update',
]);
Route::get('admin/pengiriman/{pengiriman}/delete', [
	'as' => 'pengiriman.delete',
	'uses' => 'PengirimanController@destroy',
]);



/*
	API untuk android
 */
// registrasi member baru
Route::post('api/member/registrasi', 'ApiController@registrasiMember');
// login member
Route::post('api/member/login', 'ApiController@loginMember');

Route::get('api/getmakan', 'ApiController@apiMakanan');
Route::get('api/getresto', 'ApiController@getrestoran');
Route::post('api/getmakan2', 'ApiController@getmakanan');



Route::get('testing', 'ApiController@testing');
Route::get('testing/{testing}', 'ApiController@testingslug');
Route::get('tesslug', 'ApiController@tesslug');
Route::get('tesslug/create', 'ApiController@createslug');
Route::post('tesslug/store', 'ApiController@storeslug');
Route::get('tesslug/{tesslug}', [
	'as' => 'tesslug.detail',
	'uses' => 'ApiController@tesslugDetail'
]);



Route::post('payment/makan', [
	'as' => 'payment.makan',
	'uses' => 'ApiController@paymentResto',
]);

Route::post('getid', 'ApiController@getid');
Route::get('getuser', 'ApiController@getuser');
Route::get('getmember', 'ApiController@getmember');
Route::post('usingtoken', 'TokenController@usingToken');

Route::auth();

Route::get('/home', 'HomeController@index');

