<?php

use Illuminate\Database\Seeder;

class TypeMeasureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Types_measure')->insert(array(
            array('Type_measure_label' => 'Unité'),
            array('Type_measure_label' => 'Kilogramme'),
            array('Type_measure_label' => 'Litre'),
        ));
    }
}
