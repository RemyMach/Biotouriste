<?php

namespace App\Http\Controllers;

use App\Type_Measure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class User_Status_CorrespondenceController extends Controller
{

    private $sessionUser;

    public function changeDefaultUserStatus(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/user/login', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);
        if($response->status === "400")
        {
            return redirect('login');
        }
    }

    public function testChangeDefaultUserStatus(Request $request, Client $client){

        $data['idUser'] = 4;
        $data['api_token'] = 'my0t5u6lbJPVIHaXC0GSN9Wg84bJ7GGNnFOj5uVs5QyX7nkAW85VUxakMyYLFDt1sGyuNDaNZdk6kj13';
        $data['default_status'] = 'tourist';

        $query = $client->request('POST','http://localhost:8001/api/user/change', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);
        if($response->status === "400")
        {
            return redirect('login');
        }
    }

    public function addUserStatusTouristOrSeller(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/user/login', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        if($response->status === "400")
        {
            return redirect('login');
        }

    }

    public function testaddUserStatusTouristOrSeller(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data['new_status'] = 'Seller';
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/user/addStatus', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        if($response->status === "400")
        {
            return redirect('login');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type_Measure  $type_Measure
     * @return \Illuminate\Http\Response
     */
    public function show(Type_Measure $type_Measure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type_Measure  $type_Measure
     * @return \Illuminate\Http\Response
     */
    public function edit(Type_Measure $type_Measure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type_Measure  $type_Measure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_Measure $type_Measure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_Measure  $type_Measure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_Measure $type_Measure)
    {
        //
    }
}
