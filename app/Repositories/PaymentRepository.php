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

    public static function findPaymentsForProfil($idUser){

        return DB::table('Payments')
            ->where('Payments.Users_idUser','=',$idUser)
            ->join('Users','Users.idUser','=','Payments.Users_idUser')
            ->join('Announces','Announces.idAnnounce','=','Payments.Announces_idAnnounce')
            ->join('Products','Products.idProduct','=','Announces.products_idProduct')
            ->groupBy('Payments.id_order')
            ->orderBy('Payments.payment_date')
            ->get();
    }


}
