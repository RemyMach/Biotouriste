<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnnouncesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Announces', function(Blueprint $table)
		{
			$table->foreign('Products_idProduct', 'fk_Announces_Products1')->references('idProduct')->on('Products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Users_idUser', 'fk_Announces_Users1')->references('idUser')->on('Users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Announces', function(Blueprint $table)
		{
			$table->dropForeign('fk_Announces_Products1');
			$table->dropForeign('fk_Announces_Users1');
		});
	}

}
