<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Comments')->insert(array(
            array(
                'comment_content'       => 'je suis une pomme et toi',
                'comment_note'          => 4,
                'comment_subject'       => 'je suis une chèvre',
                'comment_date'          => '2019-07-23 10-32-10',
                'Announces_idAnnounce'  => 1,
                'Users_idUser'          => 1
            ),
            array(
                'comment_content'       => 'je suis un geux',
                'comment_note'          => 2,
                'comment_subject'       => 'je suis une contrex',
                'comment_date'          => '2020-02-13 10-22-10',
                'Announces_idAnnounce'  => 2,
                'Users_idUser'          => 3
            ),
            array(
                'comment_content'       => 'test1111',
                'comment_note'          => 2,
                'comment_subject'       => 'test1111test1111',
                'comment_date'          => '2020-01-23 10-22-10',
                'Announces_idAnnounce'  => 2,
                'Users_idUser'          => 3
            ),
            array(
                'comment_content'       => 'test2222',
                'comment_note'          => 2,
                'comment_subject'       => 'test2222test2222',
                'comment_date'          => '2019-11-23 10-22-10',
                'Announces_idAnnounce'  => 1,
                'Users_idUser'          => 4
            ),
            ));
    }
}