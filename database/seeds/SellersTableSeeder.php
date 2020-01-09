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
                'seller_description' => 'je suis un super vendeur',
                'Users_idUser' => 3,
            ),
            array(
                'seller_product_bio' => true,
                'seller_verify' => true,
                'seller_description' => 'je suis un super vendeur bio',
                'Users_idUser' => 4,
            )
        ));
    }
}