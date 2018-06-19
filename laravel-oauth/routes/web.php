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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/setting', 'SettingController@index');

// Comsumer/Client Pengguna OAuth
Route::get('/todo', function(){
    $query = http_build_query([
        'client_id' => '4',
        'redirect_url' => 'http://127.0.0.1:8000/callback',
        'response_code' => 'code',
        'scope' => ''
    ]);

    return redirect('http://127.0.0.1:8000/oauth/authorize?' . $query);
});

Route::get('/callback', function(){
    return 'callback route';
});