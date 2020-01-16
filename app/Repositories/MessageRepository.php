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

    public static function getAllAnnouncesWhereUserSendAMessage($idUser){

        return DB::table('messages')
            ->join('Announces','messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->select('messages.Announces_idAnnounce')
            ->where('messages.Users_idUser','=',$idUser)
            ->groupBy('messages.Announces_idAnnounce')
            ->get();
    }

    public static function getAllMessagesFromAnnouncesAndTouristController($idUser,array $idAnnounces){

        return DB::table('messages')
            ->join('Announces','messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->join('Users','Announces.Users_idUser','=','Users.idUser')
            ->select('messages.*','Announce_name','announce_is_available','Users.*')
            ->where('messages.Users_idUser','=',$idUser)
            ->whereIn('Announces_idAnnounce',$idAnnounces)
            ->orderByDesc('messages.message_date')
            ->get();
    }

    public static function getAllAnnouncesWithMessagesFromASeller($idUser){

        return DB::table('messages')
            ->join('Announces','messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->select('messages.Announces_idAnnounce')
            ->where('Announces.Users_idUser','=',$idUser)
            ->groupBy('messages.Announces_idAnnounce')
            ->get();
    }

    public static function getAllMessagesFromAnnouncesAndSeller($idUser,array $idAnnounces){

        return DB::table('messages')
            ->join('Announces','messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->join('Users','messages.Users_idUser','=','Users.idUser')
            ->select('messages.*','Announce_name','announce_is_available','Users.*')
            ->where('Announces.Users_idUser','=',$idUser)
            ->whereIn('Announces_idAnnounce',$idAnnounces)
            ->orderByDesc('messages.message_date')
            ->get();
    }
}
