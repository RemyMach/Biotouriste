<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Products', function(Blueprint $table)
		{
			$table->foreign('product_categories_idProduct_category', 'fk_Products_product_categories1')->references('idProduct_category')->on('Product_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Types_measure_idTypes_measure', 'fk_Products_Types_measure1')->references('idTypes_measure')->on('Types_measure')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Products', function(Blueprint $table)
		{
			$table->dropForeign('fk_Products_product_categories1');
			$table->dropForeign('fk_Products_Types_measure1');
		});
	}

}
