<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ReportRepository.
 */
class SellerRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public static function GetAllSellersWithComments(){

        return DB::table('Sellers')
            ->join('Comments','Sellers.Users_idUser','Comments.Users_idUser')
            ->where('Comments.comment_note','!=',null)
            ->get();
    }

}