<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Sellers')->insert(array(
            array(
                'seller_product_bio' => false,
                'seller_verify' => false,
                'seller_adress' => '15 rue Montparnasse',
                'seller_postal_code' => '75015',
                'seller_city' => 'Paris',
                'seller_description' => 'je suis un super vendeur',
                'Users_idUser' => 3,
            ),
            array(
                'seller_product_bio' => true,
                'seller_verify' => true,
                'seller_adress' => '12 rue de Mona Lisa',
                'seller_postal_code' => '75018',
                'seller_city' => 'Paris',
                'seller_description' => 'je suis un super vendeur bio',
                'Users_idUser' => 4,
            )
        ));
    }
}