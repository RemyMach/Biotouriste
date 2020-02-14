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
     * Store a newly created resource in storage.
     */
    public function storeForAnAdmin(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;


        $query = $client->request('POST','http://localhost:8001/api/check/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        $checksQuery = $client->request('POST','http://localhost:8001/api/check/allUnDone',
            ['form_params' => $data]);

        $checksResponse = json_decode($checksQuery->getBody()->getContents());

        if($response->status === '400')
        {
            return view('admin.check',['error' => 'Your check has not been register','checks' => $checksResponse->checks]);
        }

        return view('admin.check',['success' => 'Your check has been register','checks' => $checksResponse->checks]);
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

        if($response->status == '400'){

            return back()->with('error', 'All the fields are required');
        }
        return redirect('controller')->with('completeCheck', 'The Check has been completed');
    }

    /**
     * Display the specified resource.
     */
    public function showChecksOfAController(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/check/showChecksOfAController',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status == '400'){

            return view('testCheck',["response" => $response]);
        }
        return view('testCheck',["response" => $response]);
        dd($response);

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
    public function updateStatusVerification(Request $request, Client $client, $idCheck)
    {
        $this->sessionUser = $request->session()->get('user');

        $data = $request->all();
        $data['idCheck'] = $idCheck;
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/check/UpdateStatusVerification',
            ['form_params' => $data]);


        $response = json_decode($query->getBody()->getContents());

        if($response->status === '400')
        {
            return redirect('controller')->with('messageStatus','The update has fail');
        }

        return redirect('controller')->with('messageStatus','The update is a success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Client $client, $idCheckDelete)
    {
        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;
        $data['idCheckDelete'] = $idCheckDelete;

        $query = $client->request('POST','http://localhost:8001/api/check/destroy',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());


        return redirect('admin/checks');
    }

    public function displayFormCheckregister(Request $request, $idCheck, $nameSeller){

        $data = $request->all();
        $data['idCheck'] = $idCheck;
        $data['user_name'] = $nameSeller;

        return view('controller.completeCheck',['check' => $data]);

    }
}
