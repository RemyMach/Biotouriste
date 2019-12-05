<?php

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Product_categories')->insert(array(
            array('product_label' => 'Fruits'),
            array('product_label' => 'Légumes'),
            array('product_label' => 'Céréales'),
            array('product_label' => 'Boissons'),
            array('product_label' => 'Gateaux'),
            array('product_label' => 'Epices'),
        ));
    }
}
