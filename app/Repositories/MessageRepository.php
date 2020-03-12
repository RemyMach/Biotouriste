<?php

namespace App\Repositories;

use App\Message;
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
        return Message::class;
    }

    public static function getAllMessagesOfATouristControllerForAnAnnounce($idAnnounce, $idUser){

        return DB::table('Messages')
            ->where('Announces_idAnnounce','=',$idAnnounce)
            ->where('Users_idUser','=',$idUser)
            ->get();
    }

    public static function getAllAnnouncesWhereUserSendAMessage($idUser){

        return DB::table('Messages')
            ->join('Announces','Messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->select('Messages.Announces_idAnnounce')
            ->where('Messages.Users_idUser','=',$idUser)
            ->groupBy('Messages.Announces_idAnnounce')
            ->get();
    }

    public static function getAllMessagesFromAnnouncesAndTouristController($idUser,array $idAnnounces){

        return DB::table('Messages')
            ->join('Announces','Messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->join('Users','Announces.Users_idUser','=','Users.idUser')
            ->select('Messages.*','Announce_name','announce_is_available','Users.*')
            ->where('Messages.Users_idUser','=',$idUser)
            ->whereIn('Announces_idAnnounce',$idAnnounces)
            ->orderByDesc('Messages.message_date')
            ->get();
    }

    public static function getAllAnnouncesWithMessagesFromASeller($idUser){

        return DB::table('Messages')
            ->join('Announces','Messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->select('Messages.Announces_idAnnounce')
            ->where('Announces.Users_idUser','=',$idUser)
            ->groupBy('Messages.Announces_idAnnounce')
            ->get();
    }

    public static function getAllMessagesFromAnnouncesAndSeller($idUser,array $idAnnounces){

        return DB::table('Messages')
            ->join('Announces','Messages.Announces_idAnnounce','=','Announces.idAnnounce')
            ->join('Users','Messages.Users_idUser','=','Users.idUser')
            ->select('Messages.*','Announce_name','announce_is_available','Users.*')
            ->where('Announces.Users_idUser','=',$idUser)
            ->whereIn('Announces_idAnnounce',$idAnnounces)
            ->orderByDesc('Messages.message_date')
            ->get();
    }
}
