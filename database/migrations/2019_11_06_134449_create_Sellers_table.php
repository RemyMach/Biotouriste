<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Sellers', function(Blueprint $table)
		{
			$table->integer('idSeller', true);
			$table->boolean('seller_product_bio')->nullable();
			$table->boolean('seller_verify')->nullable();
			$table->text('seller_description')->nullable();
			$table->integer('Users_idUser')->index('fk_Sellers_Users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Sellers');
	}

}
