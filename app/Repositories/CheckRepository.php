<?php

namespace App\Repositories;

use App\Check;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class AnnounceRepository.
 */
class CheckRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Check::class;
    }

    public static function selectCheckUndone(){

        return DB::table('Checks')
            ->join('Users','Checks.Users_idUser','=','Users.idUser')
            ->where('check_status_verification','=','In progress')
            ->orWhere('check_status_verification', '=','waiting')
            ->get();
    }

}
