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
			$table->string('payment_amount', 45)->nullable();
			$table->string('payment_currency', 45)->nullable();
			$table->dateTime('payment_date')->nullable();
			$table->string('payer_email', 45)->nullable();
			$table->integer('payer_paypal_id')->nullable();
			$table->string('payer_first_name', 45)->nullable();
			$table->string('payer_last_name', 45)->nullable();
			$table->integer('Orders_idOrders')->index('fk_Bills_Orders1_idx');
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
