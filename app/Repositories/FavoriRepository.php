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
            ->where('Favoris.Users_idUser','=',$idUser)
            ->get();
    }
}
