<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use GuzzleHttp\Client;

class ControllerController extends Controller
{
    private $sessionUser;

    public function __construct()
    {
        //$this->middleware('controller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/check/showChecksOfAController',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status == '400'){

            return view('controller.controller', ['NoChecks' => 'You have no Checks']);
        }

        return view('controller.controller', ['checks' => $response]);
    }
}