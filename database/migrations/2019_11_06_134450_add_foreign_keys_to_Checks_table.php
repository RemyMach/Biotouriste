<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Checks', function(Blueprint $table)
		{
			$table->foreign('Users_idUser', 'fk_Verifications_Users')->references('idUser')->on('Users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Sellers_idSeller', 'fk_Verifications_Sellers')->references('idSeller')->on('Sellers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Checks', function(Blueprint $table)
		{
			$table->dropForeign('fk_Verifications_Users');
			$table->dropForeign('fk_Verifications_Sellers');
		});
	}

}
