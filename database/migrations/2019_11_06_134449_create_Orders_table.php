<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Orders', function(Blueprint $table)
		{
			$table->integer('idOrders', true);
			$table->string('order_quantity', 45);
			$table->integer('Users_idUser')->index('fk_Orders_Users1_idx');
			$table->integer('Announces_idAnnounce')->index('fk_Orders_Announces1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Orders');
	}

}
