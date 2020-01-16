<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Reports')->insert(array(
            array(
                'report_date'                           => date('Y-m-d h-i-s'),
                'report_subject'                        => 'je suis le message 1',
                'report_comment'                        => 'attitude désastreuse',
                'ReportCategories_idReportCategorie'    => 2,
                'Users_Reported'                        => 3,
                'Users_idUser'                          => 1,
                'Announces_idAnnounce'                  => null
            ),
            array(
                'report_date'                           => '2019-11-29 10-42-10',
                'report_subject'                        => 'je suis le message 2',
                'report_comment'                        => 'attitude désastreuse encore une fois',
                'ReportCategories_idReportCategorie'    => 2,
                'Users_Reported'                        => 3,
                'Users_idUser'                          => 1,
                'Announces_idAnnounce'                  => null
            ),
            array(
                'report_date'                           => '2019-12-23 10-22-10',
                'report_subject'                        => 'je suis le message',
                'report_comment'                        => 'attitude désastreuse',
                'ReportCategories_idReportCategorie'    => 3,
                'Users_Reported'                        => 3,
                'Users_idUser'                          => 1,
                'Announces_idAnnounce'                  => 3
            ),
            array(
                'report_date'                           => '2018-12-20 10-22-10',
                'report_subject'                        => 'je suis le message test',
                'report_comment'                        => 'un escroc',
                'ReportCategories_idReportCategorie'    => 2,
                'Users_Reported'                        => 4,
                'Users_idUser'                          => 2,
                'Announces_idAnnounce'                  => null
            ),
            array(
                'report_date'                           => '2019-01-20 10-22-10',
                'report_subject'                        => 'je suis le message test encore',
                'report_comment'                        => 'un escroc je vous le redis',
                'ReportCategories_idReportCategorie'    => 1,
                'Users_Reported'                        => 4,
                'Users_idUser'                          => 2,
                'Announces_idAnnounce'                  => 4
            ),
            array(
                'report_date'                           => '2019-09-23 10-22-10',
                'report_subject'                        => 'je suis le message qui te test',
                'report_comment'                        => 'attitude désastreuse',
                'ReportCategories_idReportCategorie'    => 1,
                'Users_Reported'                        => 4,
                'Users_idUser'                          => 2,
                'Announces_idAnnounce'                  => 4
            ),
            array(
                'report_date'                           => '2019-12-23 10-22-10',
                'report_subject'                        => 'encore et toujours',
                'report_comment'                        => 'attitude maladroite',
                'ReportCategories_idReportCategorie'    => 3,
                'Users_Reported'                        => 4,
                'Users_idUser'                          => 1,
                'Announces_idAnnounce'                  => null
            ),
            array(
                'report_date'                           => '2019-09-23 10-22-10',
                'report_subject'                        => 'je suis le message qui te test',
                'report_comment'                        => 'attitude désastreuse',
                'ReportCategories_idReportCategorie'    => 1,
                'Users_Reported'                        => null,
                'Users_idUser'                          => 2,
                'Announces_idAnnounce'                  => 4
            ),
            array(
                'report_date'                           => '2019-12-23 10-22-10',
                'report_subject'                        => 'encore et toujours',
                'report_comment'                        => 'attitude maladroite',
                'ReportCategories_idReportCategorie'    => 3,
                'Users_Reported'                        => null,
                'Users_idUser'                          => 2,
                'Announces_idAnnounce'                  => null
            ),
        ));
    }
}