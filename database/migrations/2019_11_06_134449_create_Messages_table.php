<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Messages', function(Blueprint $table)
		{
			$table->integer('idMessage', true);
			$table->string('message_subject')->nullable();
			$table->text('message_content');
			$table->dateTime('message_date');
			$table->integer('message_idSender');
			$table->integer('Announces_idAnnounce')->index('fk_Posts_Announces1_idx');
			$table->integer('Users_idUser')->index('fk_Posts_Users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Messages');
	}

}
