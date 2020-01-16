<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ReportRepository.
 */
class ReportRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public static function getAllReportsFromAnUser($idUser){

        return DB::table('Reports')
            ->where('Users_idUser','=',$idUser)
            ->get();
    }
}
