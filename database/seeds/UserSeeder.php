<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert(array(
            array(
                'user_name' => 'tourist',
                'user_surname' => 'tourist',
                'user_adress' => '12 rue balec',
                'user_postal_code' => '98272',
                'user_phone' => '0276373828',
                'user_mail' => 'tourist@tourist.fr',
                'password' => Hash::make('azertyuiop'),
                'Status_User_idStatus_User' => 1,
                'api_token' => Str::random(80),
            ),
            array(
                'user_name' => 'controller',
                'user_surname' => 'controller',
                'user_adress' => '12 rue balec',
                'user_postal_code' => '98272',
                'user_phone' => '0276373829',
                'user_mail' => 'controller@controller.fr',
                'password' => Hash::make('azertyuiop'),
                'Status_User_idStatus_User' => 2,
                'api_token' => Str::random(80),
            ),
            array(
                'user_name' => 'seller',
                'user_surname' => 'seller',
                'user_adress' => '12 rue balec',
                'user_postal_code' => '98272',
                'user_phone' => '0276373869',
                'user_mail' => 'seller@seller.fr',
                'password' => Hash::make('azertyuiop'),
                'Status_User_idStatus_User' => 3,
                'api_token' => Str::random(80),
            ),
            array(
                'user_name' => 'touristSeller',
                'user_surname' => 'touristSeller',
                'user_adress' => '12 rue balec',
                'user_postal_code' => '98272',
                'user_phone' => '0276573829',
                'user_mail' => 'touristSeller@touristSeller.fr',
                'password' => Hash::make('azertyuiop'),
                'Status_User_idStatus_User' => 4,
                'api_token' => Str::random(80),
            ),
            array(
                'user_name' => 'admin',
                'user_surname' => 'admin',
                'user_adress' => '12 rue balec',
                'user_postal_code' => '98272',
                'user_phone' => '0246373829',
                'user_mail' => 'admin@admin.fr',
                'password' => Hash::make('azertyuiop'),
                'Status_User_idStatus_User' => 5,
                'api_token' => Str::random(80),
            ),

        ));
    }
}