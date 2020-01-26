<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Payments', function(Blueprint $table)
		{
			$table->integer('idPayment', true);
			$table->string('payment_status', 45)->nullable();
			$table->decimal('payment_amount', 6,2)->nullable();
			$table->string('payment_currency', 45)->nullable();
			$table->dateTime('payment_date')->nullable();
            $table->integer('order_quantity');
            $table->integer('id_order');
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
		Schema::drop('Payments');
	}

}
