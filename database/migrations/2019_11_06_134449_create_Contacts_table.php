<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class  CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Contacts', function(Blueprint $table)
		{
			$table->integer('idContact', true);
			$table->string('contact_subject');
			$table->text('contact_content');
			$table->dateTime('contact_date');
			$table->integer('Users_idUser')->index('fk_Contacts_Users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Contacts');
	}

}
