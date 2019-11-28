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

        $this->user = $request->session()->get('user');

        $data['idUser']     = $this->user->idUser;
        $data['api_token']  = $this->user->api_token;
        // $data['idSeller']   =

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/check/store',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        dd($response);

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

        $this->user = $request->session()->get('user');

        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;
        $data['idSeller'] = 2;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/check/showChecksOfAController',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        dd($response);

        return view('testCheck');
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
    public function update(Request $request, Check $check)
    {
        //
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
