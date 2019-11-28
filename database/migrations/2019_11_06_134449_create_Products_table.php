<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Products', function(Blueprint $table)
		{
			$table->integer('idProduct', true);
			$table->string('product_name', 45);
			$table->integer('Types_measure_idTypes_measure')->index('fk_Products_Types_measure1_idx');
			$table->integer('product_categories_idproduct_category')->index('fk_Products_product_categories1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Products');
	}

}
