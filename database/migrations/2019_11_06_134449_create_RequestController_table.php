<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestControllerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('RequestController', function(Blueprint $table)
		{
			$table->integer('idRequestController', true);
			$table->dateTime('requestcontroller_date');
			$table->integer('Users_idUser')->index('fk_RequestController_Users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('RequestController');
	}

}
