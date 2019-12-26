<?php

namespace App\Repositories;

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
        //return YourModel::class;
    }

    public static function allFavorisAnnounceOfAUser($idUser){

        return DB::table('Favoris')
            ->join('Announces','Favoris.Announces_idAnnounce','=','Announces.idAnnounce')
            ->select('Announces.*','Favoris.idFavoris','Favoris.Users_idUser as favoriUser')
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
}
