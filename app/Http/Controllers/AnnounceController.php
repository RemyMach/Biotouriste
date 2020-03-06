<?php

namespace App\Http\Controllers;

use App\Announce;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    private $sessionUser;


//    public function __construct(){
//        $this->middleware('seller');
//        $this->middleware('SessionAuth');
//    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('announces');
    }

    public function selectHistorySeller(Request $request, Client $client){
        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST', 'http://localhost:8001/api/announce/historySeller', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        return view('historySeller', [
            'announces' => $response->announces,
            'totalAnnounces' => $response->totalAnnounces,
            'products' => $response->products
        ]);

    }

    public function update(Request $request, Client $client){
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST', 'http://localhost:8001/api/announce/update', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }
        return response()->json($response);
    }

    public function delete(Request $request, Client $client){
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST', 'http://localhost:8001/api/announce/delete', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }
        return response()->json($response);
    }

    public function store(Request $request, Client $client){
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $query = $client->request('POST', 'http://localhost:8001/api/announce/store', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }
        return response()->json($response);

    }

    public function filterByCategorie(Request $request, Client $client){
        $data = request()->all();
        $this->sessionUser = $request->session()->get('user');
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');

        $query = $client->request('POST', 'http://localhost:8001/api/filterByCategorie', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }

        return response()->json($response);

    }

    public function filterByCity(Request $request, Client $client){
        $data = request()->all();
        $this->sessionUser = $request->session()->get('user');
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');

        $query = $client->request('POST', 'http://localhost:8001/api/filterByCity', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }

        return response()->json($response);
    }
}
