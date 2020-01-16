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
                'payment_status'       => 'succeeded',
                'payment_amount'       => 20,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/22',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'succeeded',
                'payment_amount'       => 40,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/19',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'succeeded',
                'payment_amount'       => 30,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/11/22',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'succeeded',
                'payment_amount'       => 40,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/17',
                'Users_idUser'         => 1,
                'Announces_idAnnounce' => 3
            ),
            array(
                'payment_status'       => 'failed',
                'payment_amount'       => 40,
                'payment_currency'     => 'euros',
                'payment_date'         => '2019/12/18',
                'Users_idUser'         => 2,
                'Announces_idAnnounce' => 3
            ),
        ));
    }
}