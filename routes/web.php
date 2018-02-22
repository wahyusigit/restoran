<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('{any?}', function ($test) {
//  	return dd($test);
// })->where('any', '[\/\w\.-]*');

Route::get('/', function () {
    return view('view');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Tes Route
Route::post('/user', 'UserController@store');
Route::get('/user/paginate', 'UserController@paginate');
Route::get('/user/{id}', 'UserController@show');
Route::get('/user/delete/{id}', 'UserController@delete');
Route::get('/user/search/{search_val}', 'UserController@search');
Route::get('/user', 'UserController@view');

// Tes Route
Route::group(['prefix'=>'daftarmenu'], function(){
	Route::post('/', 'DaftarMenuController@store');
	Route::get('paginate', 'DaftarMenuController@paginate');
	Route::get('datas', 'DaftarMenuController@datas');
	Route::get('{id_menu}', 'DaftarMenuController@show')->where('id_menu', '[0-9]+');
	Route::get('search/{search_val}', 'DaftarMenuController@search');
	Route::get('/', 'DaftarMenuController@view')->name('indexDaftarMenu');
});

Route::group(['prefix'=>'pemesanan'], function(){

	// Tes Route
	Route::get('/add', 'PemesananController@add');
	Route::post('/', 'PemesananController@store');
	Route::get('/paginate', 'PemesananController@paginate');
	Route::get('/{id_pemesanan}', 'PemesananController@show')->where('id_pemesanan', '[0-9]+');
	Route::get('/search/{search_val}', 'PemesananController@search');
	Route::get('/', 'PemesananController@view')->name('indexPemesanan');
	Route::get('/{any}', 'PemesananController@view')->where('any', '.*');
});