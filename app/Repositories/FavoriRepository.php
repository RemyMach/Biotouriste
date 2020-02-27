<?php

namespace App\Repositories;

use App\Favori;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class FavoriRepository.
 */
class FavoriRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Favori::class;
    }

    public static function selectIdFavoriWithUserAndAnnounce($idUser, $idAnnounce){
        return DB::table('Favoris')
            ->select('Favoris.idFavori')
            ->where('Favoris.Users_idUser','=',$idUser)
            ->where('Favoris.Announces_idAnnounce','=',$idAnnounce)
            ->get()
            ->toArray();
    }

    public static function allFavorisAnnounceOfAUser($idUser){

        return DB::table('Favoris')
            ->join('Announces','Favoris.Announces_idAnnounce','=','Announces.idAnnounce')
            ->select('Announces.*','Favoris.idFavori','Favoris.Users_idUser as favoriUser')
            ->where('Favoris.Users_idUser','=',$idUser)
            ->where('Announces.announce_is_available','=',true)
            ->get();
    }

    public static function FavorisFromAnIdAnnounceAndAnIdUser($idUser, $idAnnounce){

        return DB::table('Favoris')
            ->where('Users_idUser','=',$idUser)
            ->where('Announces_idAnnounce','=',$idAnnounce)
            ->get();
    }

    public static function verifyOwnerFavori($idUser, $idFavori){

        return DB::table('Favoris')
            ->where('idFavori','=',$idFavori)
            ->where('Users_idUser','=',$idUser)
            ->get();
    }
}
