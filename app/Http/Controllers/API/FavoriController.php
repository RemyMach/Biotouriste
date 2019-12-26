<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\FavoriRepository;

class FavoriController extends Controller
{
    private $request;
    private $favori;

    public function __construct()
    {
        $this->middleware('apiTouristController')->only(
          'showFavorisOfAUser'
        );
    }

    public function showFavorisOfAUser(Request $request){

        private $this->request = $request;

        //fait la requête et vérifie qu'elle renvoie quelque chose
        $favori = FavoriRepository::allFavorisAnnounceOfAUser($this->request->input('idUser'));
        @$firstFavori = $favori[0];
    }
}
