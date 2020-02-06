<?php

namespace App\Repositories;

use App\Announce;
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
        return Announce::class;
    }

    public static function selectCheckUndone(){

        return DB::table('Checks')
            ->where('check_status_verification','=','In progress')
            ->orWhere('check_status_verification', '=','waiting')
            ->get();
    }

}
