<?php

namespace App\Http\Controllers;

use App\Announce;
use App\Repositories\AnnounceRepository;
use App\User;
use App\Status_User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnounceController extends Controller
{
    public function __construct(){
        $this->middleware('seller')->only('store', 'update');
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
//    public function update(Request $request, Client $client){
////        announce is available
////        quantity
//
//    }
//
//    public function destroy(Request $request, Client $client){
//        available
//        //Apres annulation de la comande si il ya des commandes en cours , on envoie un mail pour lui dire de pas baiser le client et de lui donner son du
//        //Si il n'y a pas de commande BAS ON envoie un mail au mec
//    }
    public function store(Request $request, Client $client){
        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $query = $client->request('POST', 'http://localhost:8001/api/store', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }
    }

    public function teststore(Request $request, Client $client){
        $data = [
            'announce_name' => 'TestSTORAGE',
            'announce_price' => 8,
            'announce_comment' => 'TestSTORAGE',
            'announce_adresse' => 'TestSTORAGE',
            'announce_date' => '2012-01-01 11:00:00',
            'announce_city' => 'punta cana',
            'announce_img' => '',
            'products_idProduct' => 130,
            'Users_idUser' => 4,
            'announce_lat' => 18.582010,
            'announce_lng' => -68.405472,
            'announce_quantity' => 3
        ];
        $data['idUser'] = 3;
        $data['api_token'] = 'Up8uzXkdLEBQ766VEpJBBgimf6AaKfsoQaamitbObWy6Y8VBXwzab8vkI9PMEGm7PccNy0SE8gbtgCFv';
        $query = $client->request('POST', 'http://localhost:8001/api/announce/store', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);
        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }

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

    public function testfilterByCity(Request $request, Client $client)
    {
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');

        $data['cityData']['lng'] = '2.3488';
        $data['cityData']['lat'] = '48.85341';

        $query = $client->request('POST', 'http://localhost:8001/api/filterByCity', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);
        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }
        return response()->json([
            'error' => $response
        ]);
    }


    public function testfilterByCity1(Request $request){
        $cityData = $request->get('cityData');
        $lng = $cityData['lng'];
        $lat = $cityData['lat'];

        $data['lng'] = '2.3488';
        $data['lat'] = '48.85341';

        $announces = AnnounceRepository::filterByLngAndLatOrAndCategorie($lng, $lat);

        $data = [
            'success' => true,
            'announces' => $announces,
            'lng' => $lng,
            'lat' => $lat
        ];
        return response()->json($data);
    }
}
