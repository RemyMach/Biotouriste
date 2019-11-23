<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Payments', function(Blueprint $table)
		{
			$table->foreign('Orders_idOrders', 'fk_Bills_Orders1')->references('idOrders')->on('Orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Payments', function(Blueprint $table)
		{
			$table->dropForeign('fk_Bills_Orders1');
		});
	}

}
