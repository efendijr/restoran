<?php

use App\Tesslug;
use App\Testing;

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
	API untuk android
 */
// api tabel makanan
Route::get('api/makan', 'ApiController@apiMakanan');
// registrasi member baru
Route::post('member/registrasi', 'ApiController@registrasiMember');
// login member
Route::post('member/login', 'ApiController@loginMember');

Route::get('testing', 'ApiController@testing');
Route::get('testing/{testing}', 'ApiController@testingslug');

Route::get('tesslug', 'ApiController@tesslug');
Route::get('tesslug/create', 'ApiController@createslug');
Route::post('tesslug/store', 'ApiController@storeslug');
Route::get('tesslug/{tesslug}', [
	'as' => 'tesslug.detail',
	'uses' => 'ApiController@tesslugDetail'
]);


Route::auth();

// Route::get('/home', 'HomeController@index');

// $makanan = Makanan::all();
//     	foreach ($makanan as $value) {
//     		$result["status"] = true;
//     		$result["result"][] = array(
//     			"id" => $value["id"],
//     			"name" => $value["name"],
//     			"price" => $value["price"],
//     			"description" => $value["description"],
//     			"thumb" => $value["thumb"],
//     			);
//     	}

//         echo json_encode($result);