<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class MessageRepository.
 */
class MessageRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public static function getAllMessagesOfATouristControllerForAnAnnounce($idAnnounce, $idUser){

        return DB::table('messages')
            ->where('Announces_idAnnounce','=',$idAnnounce)
            ->where('Users_idUser','=',$idUser)
            ->get();
    }
}
