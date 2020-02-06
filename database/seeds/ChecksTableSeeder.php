<?php

use Illuminate\Database\Seeder;

class ChecksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Checks')->insert(array(
            array(
                'check_status_verification' => 'waiting',
                'Users_idUser' => 2,
                'Sellers_idSeller' => 3,
            ),
            array(
                'check_status_verification' => 'In Progress',
                'Users_idUser' => 2,
                'Sellers_idSeller' => 4,
            ),
            array(
                'check_prevision_date' => 'Test1',
                'check_status_verification' => 'done',
                'check_date' => '2019-11-03 11:00:00',
                'check_comment' => 'ce fut une belle boutique',
                'check_customer_service' => '3',
                'check_state_place' => '3',
                'check_quality_product' => '4',
                'check_bio_status' => 'bio',
                'Users_idUser' => 2,
                'Sellers_idSeller' => 3,
            ),
            array(
                'check_status_verification' => 'waiting',
                'Users_idUser' => 2,
                'Sellers_idSeller' => 4,
            ),
            array(
                'check_status_verification' => 'In progress',
                'Users_idUser' => 2,
                'Sellers_idSeller' => 3,
            ),
        ));
    }
}
