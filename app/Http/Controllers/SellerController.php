<?php

namespace App\Http\Controllers;

use App\Seller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->only(
            'updateBioStatus'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBioStatus(Request $request, Client $client){

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');
        $data = request()->all();

        $query = $client->request('POST','http://localhost:8001/api/user_status/login', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        if($response->status === "400")
        {
            return redirect('login');
        }
    }

    public function testupdateBioStatus(Request $request, Client $client){

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');
        $data['idSeller'] = 1;

        $query = $client->request('POST','http://localhost:8001/api/seller/updateBio', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        if($response->status === '400')
        {
            return redirect('login');
        }
    }

    public function updateDescription(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/seller/updateDescription', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        if($response->status === '400')
        {
            return redirect('login');
        }
    }

    public function testupdateDescription(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $data['seller_description'] = 'je suis la nouvelle description';

        $query = $client->request('POST','http://localhost:8001/api/seller/updateDescription', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        if($response->status === '400')
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
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
