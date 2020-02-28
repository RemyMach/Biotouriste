<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRequestControllerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('RequestController', function(Blueprint $table)
		{
			$table->foreign('Users_idUser', 'fk_RequestController_Users1_idx')->references('idUser')->on('Users')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Reports', function(Blueprint $table)
		{
			$table->dropForeign('fk_RequestController_Users1_idx');
        });
	}

}
