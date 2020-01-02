<?php

namespace App\Http\Controllers;

use App\Check;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    private $sessionUser;

    public function __construct()
    {
        $this->middleware('controller')->only(
            'controllerSendACompleteCheck','create','storeForAController','showChecksOfAController','updateStatus'
        );

        $this->middleware('admin')->only(
            'storeForAnAdmin','destroy'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::find(1);
        dd($user->announces);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testCheck');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeForAnAdmin(Request $request, Client $client)
    {

        $data = request()->all();
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');


        $query = $client->request('POST','http://localhost:8001/api/check/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck',["response" => $response]);
    }

    public function storeForAController(Request $request, Client $client)
    {

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;
        //à remplacer par l'id du seller
        $data['idSeller'] = 1;

        $query = $client->request('POST','http://localhost:8001/api/check/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck',["response" => $response]);
    }

    public function controllerSendACompleteCheck(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/check/controllerSendACompleteCheck',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck',["response" => $response]);
    }

    /**
     * Display the specified resource.
     */
    public function showChecksOfAController(Request $request, Client $client)
    {
        $sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $data['idSeller'] = 1;

        $query = $client->request('POST','http://localhost:8001/api/check/showChecksOfAController',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck',["response" => $response]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Check $check)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, Check $check, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['status'] = request('status');
        $data['idCheck'] = $check->idCheck;
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/check/UpdateStatusVerification',
            ['form_params' => $data]);


        $response = json_decode($query->getBody()->getContents());

        //dd($response);

        //mettre la bonne réponse
        return view('testCheck');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/check/destroy',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck',["response" => $response]);
    }
}
