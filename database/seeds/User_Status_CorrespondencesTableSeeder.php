<?php

use Illuminate\Database\Seeder;

class User_Status_CorrespondencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('User_Status_Correspondences')->insert(array(
            array(
                'Users_idUser' => 1,
                'Status_User_idStatus_User' => 1,
            ),
            array(
                'Users_idUser' => 2,
                'Status_User_idStatus_User' => 2,
            ),
            array(
                'Users_idUser' => 3,
                'Status_User_idStatus_User' => 3,
            ),
            array(
                'Users_idUser' => 4,
                'Status_User_idStatus_User' => 1,
            ),
            array(
                'Users_idUser' => 4,
                'Status_User_idStatus_User' => 3,
            ),
            array(
                'Users_idUser' => 5,
                'Status_User_idStatus_User' => 4,
            ),
        ));
    }
}
