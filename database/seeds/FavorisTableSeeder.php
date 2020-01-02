<?php

use Illuminate\Database\Seeder;

class FavorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Favoris')->insert(array(
            array(
                'Users_idUser'          => 2,
                'Announces_idAnnounce'  => 1,
            ),
            array(
                'Users_idUser'          => 1,
                'Announces_idAnnounce'  => 2,
            ),
            array(
                'Users_idUser'          => 1,
                'Announces_idAnnounce'  => 3,
            ),
            array(
                'Users_idUser'          => 1,
                'Announces_idAnnounce'  => 1,
            )
        ));
    }
}