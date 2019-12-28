<?php

use Illuminate\Database\Seeder;

class ReportCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Report_Categories')->insert(array(
            array('Report_Categorie_label' => 'Message'),
            array('Report_Categorie_label' => 'Announce'),
            array('Report_Categorie_label' => 'Commentary'),
            array('Report_Categorie_label' => 'behavior'),
        ));
    }
}
