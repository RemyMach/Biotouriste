<?php

namespace App\Repositories;

use App\Payment;
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
        return Payment::class;
    }

    /*public static function filterPaymentDateAndPaymentAmountByUser($limitDate, $minimum_amount){

        return DB::table('payments')
            ->join('Users','payments.Users_idUser','=','Users.idUser')
            ->select('payments.Users_idUser',DB::raw('SUM(payment_amount) as total'))
            ->where('payment_date','>',$limitDate)
            ->where('payment_status','=','valid')
            ->groupBy('Users.idUser')
            ->havingRaw('total > ?', [$minimum_amount])
            ->get();
    }*/
    public static function filterPaymentDateAndPaymentAmountByUser($limitDate, $minimum_amount){

        return DB::table('Payments')
            ->join('Users','payments.Users_idUse','=','Users.idUser')
            ->select('payments.Users_idUser')
            ->where('payment_date','>',$limitDate)
            ->where('payment_status','=','succeeded')
            ->groupBy('Users.idUser')
            ->get();
    }

    public static function findPaymentsForProfil($idUser){

        return DB::table('Payments')
            ->select('Payments.*', 'Users.*', 'Announces.*', 'Products.*', DB::raw('SUM(Payments.payment_amount) as totalAmount'))
            ->where('Payments.Users_idUser','=',$idUser)
            ->join('Users','Users.idUser','=','Payments.Users_idUser')
            ->join('Announces','Announces.idAnnounce','=','Payments.Announces_idAnnounce')
            ->join('Products','Products.idProduct','=','Announces.products_idProduct')
            ->groupBy('Payments.id_order')
            ->orderBy('Payments.payment_date')
            ->get();
    }

    public static function findPaymentsOfAUserForASeller($idUserSeller,$idUserTourist){

        return DB::table('Payments')
            ->join('Announces','Payments.Announces_idAnnounce','Announces.idAnnounce')
            ->where('Payments.Users_idUser','=',$idUserTourist)
            ->where('Announces.Users_idUser','=',$idUserSeller)
            ->where('Payments.payment_status','=','succeeded')
            ->get();
    }
}
