<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Payments')->insert(array(
            array(
                'payment_status'       => 'valid',
                'payment_amount'       => 20,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/22',
                'payer_first_name'     => 'jean',
                'payer_last_name'      => 'onche',
                'order_quantity'       => '3kilos',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'valid',
                'payment_amount'       => 40,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/19',
                'payer_first_name'     => 'jean',
                'payer_last_name'      => 'onche',
                'order_quantity'       => '3kilos',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'valid',
                'payment_amount'       => 30,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/11/22',
                'payer_first_name'     => 'jean',
                'payer_last_name'      => 'onche',
                'order_quantity'       => '3kilos',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'waiting',
                'payment_amount'       => 40,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/17',
                'payer_first_name'     => 'jean',
                'payer_last_name'      => 'onche',
                'order_quantity'       => '3kilos',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'valid',
                'payment_amount'       => 40,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/18',
                'payer_first_name'     => 'jean',
                'payer_last_name'      => 'onche',
                'order_quantity'       => '3kilos',
                'Users_idUser'         => 2,
                'Announces_idAnnounce' => 3
            ),
        ));
    }
}