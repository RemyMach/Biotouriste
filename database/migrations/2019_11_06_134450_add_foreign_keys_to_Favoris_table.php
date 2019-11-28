<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFavorisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Favoris', function(Blueprint $table)
		{
			$table->foreign('Announces_idAnnounce', 'fk_Favoris_Announces1')->references('idAnnounce')->on('Announces')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Users_idUser', 'fk_Favoris_Users1')->references('idUser')->on('Users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Favoris', function(Blueprint $table)
		{
			$table->dropForeign('fk_Favoris_Announces1');
			$table->dropForeign('fk_Favoris_Users1');
		});
	}

}
