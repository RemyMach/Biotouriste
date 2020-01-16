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

    public function insert(Request $request, Client $client){

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
