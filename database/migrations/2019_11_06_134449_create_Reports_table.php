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
			$table->dateTime('report_date');
			$table->string('report_subject', 45);
			$table->text('report_comment');
			$table->integer('Report_Categories_idReportCategorie')->index('fk_Reports_Report_Categories1_idx');
			$table->integer('Users_Reported')->index('fk_Reports_UsersReported_idx')->nullable();
			$table->integer('Users_idUser')->index('fk_Reports_Users1_idx');
			$table->integer('Announces_idAnnounce')->index('fk_Reports_Announces1_idx')->nullable();
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
