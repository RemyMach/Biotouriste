<?php

namespace App\Http\Controllers;

use App\Favori;
use App\Repositories\FavoriRepository;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FavoriController extends Controller
{
    private $sessionUser;

    public function __construct(){

        $this->middleware('touristController')->only(
            'showFavorisOfAUser'
        );

    }

    public function showFavorisOfAUser(Request $request, Client $client)
    {

        $this->sessionUser = $request->session()->get('user');

        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/favori/showFavorisOfAUser',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testFavori',["response" => $response]);

    }

    public function store(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        //$data['idAnnounce'] = 5;
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/favori/store',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testFavori',["response" => $response]);
    }

    public function destroy(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');
        //$data = request()->all();
        $data['idFavori']   = 3;
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/favori/destroy',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testFavori',["response" => $response]);
    }
}
