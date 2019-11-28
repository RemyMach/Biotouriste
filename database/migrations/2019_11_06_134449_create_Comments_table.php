<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Comments', function(Blueprint $table)
		{
			$table->integer('idComment', true);
			$table->text('comment_content');
			$table->decimal('comment_note', 2, 1)->nullable();
			$table->string('comment_subject', 45);
			$table->integer('Announces_idAnnounce')->index('fk_Comments_Announces1_idx');
			$table->integer('Users_idUser')->index('fk_Comments_Users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Comments');
	}

}
