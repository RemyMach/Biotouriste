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

        $this->middleware('touristController');

    }
    public function isFavoris(Request $request, Client $client){
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST', 'http://localhost:8001/api/favori/isFavoris', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        return response()->json($response);
    }

    public function findIdFavori(Request $request, Client $client){
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;
        $query = $client->request('POST','http://localhost:8001/api/favori/findIdFavori', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        return response()->json(['response' => $response]);
    }

    public function showFavorisOfAUser(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/favori/showFavorisOfAUser',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());
        return view('favorite',["response" => $response->favoris]);
    }

    public function testShowFavorisOfAUser(Request $request, Client $client)
    {

        $this->sessionUser = $request->session()->get('user');

        $data['idUser']     = 5;
        $data['api_token']  = config('api.api_admin_token');

        $query = $client->request('POST','http://localhost:8001/api/favori/showFavorisOfAUser',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        return view('testFavori',["response" => $response]);

    }


    public function store(Request $request, Client $client){
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;
        $query = $client->request('POST','http://localhost:8001/api/favori/store', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());
        return response()->json(["response" => $response]);
    }

    public function destroy(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');
        $data = request()->all();
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/favori/destroy',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());
        if($request->request->get('pageFavorite')){
            return redirect('favori/show');
        } else {
            return response()->json(["response" => $response]);
        }
    }
}
