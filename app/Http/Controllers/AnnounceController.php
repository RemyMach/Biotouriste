<?php

namespace App\Http\Controllers;

use App\Announce;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    private $sessionUser;


    public function __construct(){
        $this->middleware('seller')->only('store', 'update', 'selectHistorySeller');
    }
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

        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }
        return view('historySeller', [
            'announces' => $response->announces,
            'totalAnnounces' => $response->totalAnnounces,
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

        $data = [
            'announce_name' => 'TestSTORAGE',
            'announce_price' => 8,
            'announce_comment' => 'TestSTORAGEComment',
            'announce_adresse' => 'TestSTORAGEADRESSE',
            'announce_city' => 'punta cana',
            'announce_img' => null,
            'products_idProduct' => 130,
            'Users_idUser' => 3,
            'announce_lat' => 18.582010,
            'announce_lng' => -68.405472,
            'announce_quantity' => 3,
            'announce_measure' => 'Kilo',
            'announce_is_available' => true
        ];

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
