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
			$table->string('user_adress')->nullable();
			$table->integer('user_postal_code')->nullable();
			$table->string('user_phone', 45)->nullable()->unique('user_phone_UNIQUE');
			$table->string('email')->unique('email_UNIQUE');
			$table->string('password');
			$table->string('user_img', 45)->nullable();
            $table->integer('Status_User_idStatus_User')->index('fk_Users_Status_User_idStatus_User1');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
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
