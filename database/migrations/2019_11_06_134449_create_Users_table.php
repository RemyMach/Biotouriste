<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Users', function(Blueprint $table)
		{
			$table->integer('idUser', true);
			$table->string('user_name', 45);
			$table->string('user_surname', 45);
			$table->string('user_adresse')->nullable();
			$table->string('user_postal_code')->nullable();
			$table->string('user_phone', 45)->nullable()->unique('user_phone_UNIQUE');
			$table->string('user_mail')->unique('user_mail_UNIQUE');
			$table->string('user_password');
			$table->boolean('user_controller');
			$table->boolean('user_buyer')->nullable();
			$table->boolean('user_seller')->nullable();
			$table->string('user_img', 45)->nullable();
            $table->rememberToken();
            $table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Users');
	}

}
