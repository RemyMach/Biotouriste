<?php

namespace App\Http\Controllers\API;

use App\Favori;
use App\Http\Controllers\Controller;
use App\Repositories\AnnounceRepository;
use App\Repositories\FavoriRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriController extends Controller
{
    private $request;
    private $favori;

    public function __construct()
    {
        $this->middleware('apiTouristController')->only(
          'showFavorisOfAUser','apiTouristController','destroy'
        );
    }

    public function showFavorisOfAUser(Request $request){

        $this->request = $request;

        $favoris = FavoriRepository::allFavorisAnnounceOfAUser($this->request->input('idUser'));
        @$firstFavori = $favoris[0];

        if(!isset($firstFavori)){

            return response()->json([
                'message'   => 'No Favoris for this User',
                'status'    => '400',
            ]);
        }

        return response()->json([
            'message'           => 'There are your favoris Announces',
            'status'            => '200',
            'discount_codes'    => $favoris,
        ]);
    }

    public function store(Request $request){

        $this->request = $request;

        $validator = $this->validateIdAnnounceFormat();

        if($validator->original['status'] == '400') {
            return $validator;
        }

        $announce = AnnounceRepository::AnnounceThatIsAvailable($this->request->input('idAnnounce'));
        if(!isset($announce[0])){
            return response()->json([
                'message'   => 'No Announce correspond to this id or this announce is not available',
                'status'    => '400',
            ]);
        }

        $validData = $this->setValidDataForRegister();

        $favori = FavoriRepository::FavorisFromAnIdAnnounceAndAnIdUser($validData['Users_idUser'], $validData['Announces_idAnnounce']);
        if(isset($favori[0])){
            return response()->json([
                'message'   => 'This Announce is already a favorite one',
                'status'    => '400',
            ]);
        }

        $favori = Favori::create($validData);

        return response()->json([
            'message'   => 'Your Favori has been register',
            'status'    => '200',
            'favori'     => $favori,
        ]);

    }

    public function destroy(){

        //je vérifie que les informations correspondent bien à ce user et que le favoris existe

    }

    private function validateIdAnnounceFormat(){

        $validator = Validator::make($this->request->all(), [
            'idAnnounce'      => 'required|integer',
        ]);

        if($validator->fails()) {

            return response()->json([
                'message' => 'The request is not good',
                'error' => $validator->errors(),
                'status' => '400'
            ]);
        }

        return response()->json([
            'message'   => 'The request is good',
            'status'    => '200'
        ]);
    }

    private function setValidDataForRegister(){

        $validData['Users_idUser'] = (int) $this->request->input('idUser');
        $validData['Announces_idAnnounce'] = (int) $this->request->input('idAnnounce');

        return $validData;
    }
}
