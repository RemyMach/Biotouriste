<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDiscountCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Discount_codes', function(Blueprint $table)
		{
			$table->foreign('Users_idUser', 'fk_Discount_codes_Users1')->references('idUser')->on('Users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Discount_codes', function(Blueprint $table)
		{
			$table->dropForeign('fk_Discount_codes_Users1');
		});
	}

}
