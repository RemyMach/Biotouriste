<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavorisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Favoris', function(Blueprint $table)
		{
			$table->integer('idFavoris', true);
			$table->integer('Users_idUser')->index('fk_Favoris_Users1_idx');
			$table->integer('Announces_idAnnounce')->index('fk_Favoris_Announces1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Favoris');
	}

}
