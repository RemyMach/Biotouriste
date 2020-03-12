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
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiTouristController')->only('showFavorisOfAUser', 'store', 'destroy', 'findIdFavori');
    }

    public function isFavoris(Request $request){

        $this->request = $request;


        $favoris = FavoriRepository::isFavoris($this->request->input('idAnnounce'), $this->request->input('idUser'));
        if(isset($favoris[0])){
            return response()->json(['succes' => true,'favoris' => $favoris[0]] );

        }
        return response()->json(false);
    }

    public function findIdFavori(Request $request){
        $this->request = $request;

        $favoris = FavoriRepository::selectIdFavoriWithUserAndAnnounce($this->request->input('idUser'), $this->request->input('idAnnounce'));

        if (count($favoris) > 0){
            $return = true;
        }else{
            $return = false;
        }
        return response()->json([
            'status'  => '200',
            'return' => $return,
            'favoris' => $favoris,
        ]);
    }
    public function showFavorisOfAUser(Request $request){

        $this->request = $request;

        $favoris = FavoriRepository::allFavorisAnnounceOfAUser($this->request->input('idUser'));
        @$firstFavori = $favoris[0];

        if(!isset($firstFavori)){

            return response()->json([
                'message'   => 'No Favoris for this User',
                'status'    => '400',
                'favoris'    => $favoris,
            ]);
        }

        return response()->json([
            'message'           => 'There are your favoris Announces',
            'status'            => '200',
            'favoris'    => $favoris,
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
                'message'   => 'Your favori has been remove',
                'status'    => '200',
            ]);
        }

        $favori = Favori::create($validData);

        return response()->json([
            'message'   => 'Your Favori has been register',
            'status'    => '200',
            'favori'     => $favori,
        ]);

    }

    public function destroy(Request $request){

        $this->request = $request;
        $validator = $this->validateIdFavoriFormat();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $favori = FavoriRepository::verifyOwnerFavori($this->request->input('idUser'), $this->request->input('idFavori'));
//        if($favori[0]){
//            return response()->json([
//                'message'   => 'This Favori is not yours',
//                'status'    => '400',
//            ]);
//        }
        Favori::destroy($favori[0]->idFavori);

        return response()->json([
            'message'   => 'The Favori has been deleted',
            'status'    => '200',
            'idUser'    => $favori[0]
        ]);
    }

    private function validateIdAnnounceFormat(){
        $validator = Validator::make($this->request->all(), [
            'idAnnounce'      => 'required|integer',
        ]);

        return $this->resultValidator($validator);
    }

    private function validateIdFavoriFormat(){
        $validator = Validator::make($this->request->all(), [
            'idFavori' => 'required|integer',
        ]);

        return $this->resultValidator($validator);
    }

    private function resultValidator($validator){

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
