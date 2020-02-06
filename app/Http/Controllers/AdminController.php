<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use GuzzleHttp\Client;

class AdminController extends Controller
{
    private $sessionUser;

    public function __construct()
    {


        $this->middleware('guest')->only('profil');
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

        $query = $client->request('POST','http://localhost:8001/api/contact/admin/all',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status == '400'){

            return view('admin.admin')->with('errorContact','You have no contacts');
        }

        return view('admin.admin')->with('contacts',$response->contacts);
    }

    public function showChecks(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/check/allUnDone',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);


            return view('admin.check')->with('checks',$response->checks);
    }

}