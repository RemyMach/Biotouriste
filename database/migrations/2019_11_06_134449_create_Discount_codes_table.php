<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Discount_codes', function(Blueprint $table)
		{
			$table->integer('idDiscount_code', true);
			$table->integer('discount_code_amount');
			$table->boolean('is_use');
			$table->dateTime('discount_code_expiration_date')->nullable();
			$table->integer('Users_idUser')->index('fk_Discount_codes_Users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Discount_codes');
	}

}
