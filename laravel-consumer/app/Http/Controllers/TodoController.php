<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        return view('todo');
    }

    public function getTodoList(){
        $client = new Client();
        $response = $client->get('http://127.0.0.1:8000/api/todo', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token.access_token')
            ]
        ]);

        return json_decode((string)$response->getBody(), true);
    }
}
