<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ReportRepository.
 */
class StatusUserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Status_User::class;
    }

    public static function getUserAndAlldata($idUser){
        return DB::table('Users')
            ->where('Users.idUser','=',$idUser)
            ->join('User_Status_Correspondences','User_Status_Correspondences.Users_idUser','=','Users.idUser')
            ->join('Status_User','Status_User.idStatus_User','=','User_Status_Correspondences.Status_User_idStatus_User')
            ->get();
    }

    public static function getAllStatusUserLabelFromAnUser($idUser){

        return DB::table('Status_User')
            ->join('User_Status_Correspondences','Status_User.idStatus_User','=','User_Status_Correspondences.Status_User_idStatus_User')
            ->join('Users','User_Status_Correspondences.Users_idUser','=','Users.idUser')
            ->select('Status_User.status_user_label')
            ->where('Users.idUser','=',$idUser)
            ->get();
    }

    public static function checkIfUserHasThisStatus($idUser, $status_user){

        return DB::table('Status_User')
            ->join('User_Status_Correspondences','Status_User.idStatus_User','=','User_Status_Correspondences.Status_User_idStatus_User')
            ->join('Users','User_Status_Correspondences.Users_idUser','=','Users.idUser')
            ->where('Users.idUser','=',$idUser)
            ->where('Status_User.status_user_label','=',$status_user)
            ->get();
    }

    public static function getDefaultStatus($idUser){

        return DB::table('Status_User')
            ->join('User_Status_Correspondences','Status_User.idStatus_User','=','User_Status_Correspondences.Status_User_idStatus_User')
            ->join('Users','User_Status_Correspondences.Users_idUser','=','Users.idUser')
            ->where('Users.idUser','=',$idUser)
            ->where('User_Status_Correspondences.default_status','=',true)
            ->get();
    }
}
