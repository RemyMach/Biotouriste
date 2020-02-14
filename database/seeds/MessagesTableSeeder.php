<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Messages')->insert(array(
            array(
                'message_subject'       => 'message1',
                'message_content'       => 'je suis le message 1',
                'message_date'          => date('Y-m-d h-i-s'),
                'message_idSender'      => 2,
                'Announces_idAnnounce'  => 1,
                'Users_idUser'          => 2
            ),
            array(
                'message_subject'       => 'message2',
                'message_content'       => 'je suis le message 2',
                'message_date'          => '2019-12-23 10-22-10',
                'message_idSender'      => 3,
                'Announces_idAnnounce'  => 1,
                'Users_idUser'          => 2
            ),
            array(
                'message_subject'       => 'message23',
                'message_content'       => 'je suis un autre message',
                'message_date'          => '2019-12-24 10-22-10',
                'message_idSender'      => 2,
                'Announces_idAnnounce'  => 1,
                'Users_idUser'          => 2
            ),
            array(
                'message_subject'       => 'messag32',
                'message_content'       => 'je suis une autre annonce',
                'message_date'          => '2019-12-13 10-22-10',
                'message_idSender'      => 2,
                'Announces_idAnnounce'  => 2,
                'Users_idUser'          => 2
            ),
            array(
                'message_subject'       => 'message3',
                'message_content'       => 'je suis le message 3',
                'message_date'          => '2019-11-23 10-22-10',
                'message_idSender'      => 4,
                'Announces_idAnnounce'  => 2,
                'Users_idUser'          => 2
            ),
            array(
                'message_subject'       => 'message4',
                'message_content'       => 'je suis le message 4',
                'message_date'          => '2019-11-21 10-40-10',
                'message_idSender'      => 2,
                'Announces_idAnnounce'  => 4,
                'Users_idUser'          => 2
            ),
            array(
                'message_subject'       => 'message que je veux',
                'message_content'       => 'je suis le message que je veux',
                'message_date'          => '2019-10-10 10-40-10',
                'message_idSender'      => 4,
                'Announces_idAnnounce'  => 4,
                'Users_idUser'          => 2
            ),
            array(
                'message_subject'       => 'message5',
                'message_content'       => 'je suis le message 5',
                'message_date'          => '2019-12-13 10-40-10',
                'message_idSender'      => 1,
                'Announces_idAnnounce'  => 4,
                'Users_idUser'          => 1
            ),
        ));
    }
}