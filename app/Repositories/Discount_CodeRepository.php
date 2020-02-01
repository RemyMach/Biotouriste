<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class Discount_CodeRepository.
 */
class Discount_CodeRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public static function allDiscountCodesValidForAUser($idUser){

        return DB::table('Discount_Codes')
            ->where('is_use','=','true')
            ->where('discount_code_expiration_date','>',\Carbon\Carbon::now())
            ->where('Users_idUser','=',$idUser)
            ->get();
    }
}
