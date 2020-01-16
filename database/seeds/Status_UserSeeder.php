<?php

use Illuminate\Database\Seeder;

class Status_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Status_User')->insert(array(
            array('status_user_label' => 'Tourist'),
            array('status_user_label' => 'Controller'),
            array('status_user_label' => 'Seller'),
            array('status_user_label' => 'Admin'),
        ));
    }
}
