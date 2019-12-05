<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Reports', function(Blueprint $table)
		{
			$table->integer('idReport', true);
			$table->dateTime('report_date')->nullable();
			$table->string('report_subject', 45)->nullable();
			$table->text('report_comment')->nullable();
			$table->integer('Users_idUser')->index('fk_Reports_Users1_idx');
			$table->integer('Announces_idAnnounce')->index('fk_Reports_Announces1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Reports');
	}

}
