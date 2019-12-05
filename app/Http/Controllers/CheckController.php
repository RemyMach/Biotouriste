<?php

namespace App\Http\Controllers;

use App\Check;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CheckController extends Controller
{

    public function __construct()
    {
        //$this->middleware('Controller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //seul un admin ou un controlleur peut register un check
        if(!$request->session()->has('user')){

            return redirect('home');
        }

        $sessionUser = $request->session()->get('user');

        $data['idUser']     = $sessionUser->idUser;
        $data['api_token']  = $sessionUser->api_token;
        //à remplacer par autre chose
        $data['idSeller'] = 1;

        $client = new Client();
        $query = $client->request('POST','http://localhost:8001/api/check/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck',["response" => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function showChecksOfAController(Request $request)
    {
        if(!$request->session()->has('user')){

            return redirect('home');
        }

        $sessionUser = $request->session()->get('user');

        $data['idUser'] = $sessionUser->idUser;
        $data['api_token'] = $sessionUser->api_token;
        $data['idSeller'] = 1;

        $client = new Client();
        $query = $client->request('POST','http://localhost:8001/api/check/showChecksOfAController',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck',["response" => $response]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function edit(Check $check)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Check $check)
    {
        if(!$request->session()->has('user')){

            return redirect('home');
        }

        $sessionUser = $request->session()->get('user');

        $data['status'] = $request->status
        $data['idcheck'] = $check->idCheck;
        $data['idUser'] = $sessionUser->idUser;
        $data['api_token'] = $sessionUser->api_token;

        $client = new Client();


        $query = $client->request('POST','http://localhost:8001/api/check/UpdateStatusVerification',
            ['form_params' => $data]);


        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testCheck');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function destroy(Check $check)
    {
        //
    }
}
