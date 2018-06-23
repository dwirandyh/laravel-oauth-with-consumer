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

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    $query = http_build_query([
        'client_id' => 4,
        'redirect_url' => 'http://127.0.0.1:8001/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('http://127.0.0.1:8000/oauth/authorize?' . $query);
});

Route::get('/callback', function (Request $request) {
    $client = new Client();
    $response = $client->post('http://127.0.0.1:8000/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 4,
            'client_secret' => 'ZvVSsZcVgukydAqh32zwdHTMaegcupvmNn7cgWjR',
            'redirect_uri' => 'http://127.0.0.1:8001/callback',
            'code' => Input::get('code')
        ]
    ]);

    session()->put('token', json_decode((string)$response->getBody(), true));

    return redirect('/todos');
});


/*
Route::get('/todos', function () {

});
*/

Route::get('/todos', 'TodoController@index');

Route::get('/refresh-token', function () {
    $client = new Client();
    $formParams = ['form_params' => [
        'grant_type' => 'refresh_token',
        'refresh_token' => session()->get('token.refresh_token'),
        'client_id' => 4,
        'client_secret' => 'ZvVSsZcVgukydAqh32zwdHTMaegcupvmNn7cgWjR',
        'scope' => ''
        ]
    ];

    $response = $client->post('http://127.0.0.1:8000/oauth/token', $formParams);


    session()->put('token', json_decode((string)$response->getBody(), true));
    session()->put('isRefresh', false);

    return redirect()->back();
});