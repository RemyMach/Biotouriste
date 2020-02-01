<?php

use Illuminate\Database\Seeder;

class AnnouncesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Announces')->insert(array(
            array(
                'announce_name' => 'Test1',
                'announce_is_available' => true,
                'announce_price' => 23.22,
                'announce_comment' => 'Test1',
                'announce_adresse' => 'Test1',
                'announce_date' => '2019-11-03 11:00:00',
                'announce_city' => 'paris',
                'announce_img' => '',
                'products_idProduct' => 20,
                'Users_idUser' => 1,
                'announce_lat' => 48.837273,
                'announce_lng' => 2.33538,
                'announce_quantity' => 1,
                'announce_measure' => 'unity'
            ),
            array(
                'announce_name' => 'Test2',
                'announce_is_available' => true,
                'announce_price' => 5.99,
                'announce_comment' => 'Test2',
                'announce_adresse' => 'Test2',
                'announce_date' => '2019-11-13 11:00:00',
                'announce_city' => 'paris',
                'announce_img' => '',
                'products_idProduct' => 80,
                'Users_idUser' => 2,
                'announce_lat' => 48.789612,
                'announce_lng' => 2.452600,
                'announce_quantity' => 1,
                'announce_measure' => 'unity'
            ),
            array(
                'announce_name' => 'Test3',
                'announce_is_available' => true,
                'announce_price' => 15.59,
                'announce_comment' => 'Test3',
                'announce_adresse' => 'Test3',
                'announce_date' => '2019-11-20 11:00:00',
                'announce_city' => 'paris',
                'announce_img' => '',
                'products_idProduct' => 10,
                'Users_idUser' => 3,
                'announce_lat' => 33.5731104,
                'announce_lng' => -7.5898434,
                'announce_quantity' => 1,
                'announce_measure' => 'gramme'
            ),
            array(
                'announce_name' => 'Test4',
                'announce_is_available' => false,
                'announce_price' => 999.99,
                'announce_comment' => 'Test4',
                'announce_adresse' => 'Test4',
                'announce_date' => '2019-11-22 11:00:00',
                'announce_city' => 'paris',
                'announce_img' => '',
                'products_idProduct' => 97,
                'Users_idUser' => 4,
                'announce_lat' => 48.833832,
                'announce_lng' => 2.243230,
                'announce_quantity' => 1,
                'announce_measure' => 'gramme'
            ),
            array(
                'announce_name' => 'Test5',
                'announce_is_available' => true,
                'announce_price' => 23.35,
                'announce_comment' => 'Test5',
                'announce_adresse' => 'Test5',
                'announce_date' => '2019-11-03 11:00:00',
                'announce_city' => 'paris',
                'announce_img' => '',
                'products_idProduct' => 20,
                'Users_idUser' => 1,
                'announce_lat' => 55.751244,
                'announce_lng' => 37.618423,
                'announce_quantity' => 1,
                'announce_measure' => 'gramme'
            ),
        ));
    }
}
