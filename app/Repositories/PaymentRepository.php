<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class PaymentRepository.
 */
class PaymentRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public static function filterPaymentDateAndPaymentAmountByUser($limitDate, $minimum_amount){

        return DB::table('payments')
            ->join('Users','payments.Users_idUser','=','Users.idUser')
            ->select('payments.Users_idUser',DB::raw('SUM(payment_amount) as total'))
            ->where('payment_date','>',$limitDate)
            ->where('payment_status','=','valid')
            ->groupBy('Users.idUser')
            ->havingRaw('total > ?', [$minimum_amount])
            ->get();
    }
}
