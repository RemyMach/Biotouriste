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
                'announce_status' => 'Test1',
                'announce_prix' => 23.22,
                'announce_comment' => 'Test1',
                'announce_adresse' => 'Test1',
                'announce_date' => '2019-11-03 11:00:00',
                'announce_img' => '',
                'products_idProduct' => 20,
                'Users_idUser' => 1,
                'announce_latLong' => '48.837273,2.33538',
            ),
            array(
                'announce_name' => 'Test2',
                'announce_status' => 'Test2',
                'announce_prix' => 5.99,
                'announce_comment' => 'Test2',
                'announce_adresse' => 'Test2',
                'announce_date' => '2019-11-13 11:00:00',
                'announce_img' => '',
                'products_idProduct' => 80,
                'Users_idUser' => 2,
                'announce_latLong' => '48.789612,2.452600',
            ),
            array(
                'announce_name' => 'Test3',
                'announce_status' => 'Test3',
                'announce_prix' => 15.59,
                'announce_comment' => 'Test3',
                'announce_adresse' => 'Test3',
                'announce_date' => '2019-11-20 11:00:00',
                'announce_img' => '',
                'products_idProduct' => 10,
                'Users_idUser' => 3,
                'announce_latLong' => '49.052502,2.038830',
            ),
            array(
                'announce_name' => 'Test4',
                'announce_status' => 'Test4',
                'announce_prix' => 999.99,
                'announce_comment' => 'Test4',
                'announce_adresse' => 'Test4',
                'announce_date' => '2019-11-22 11:00:00',
                'announce_img' => '',
                'products_idProduct' => 97,
                'Users_idUser' => 4,
                'announce_latLong' => '48.833832,2.243230',
            ),
        ));
    }
}
