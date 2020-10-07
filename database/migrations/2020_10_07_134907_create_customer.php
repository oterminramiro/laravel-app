<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomer extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function (Blueprint $table) {
			$table->id();
			$table->char('name', 100)->nullable();
			$table->char('lastname', 100)->nullable();
			$table->char('phone', 200);
			$table->char('email', 200)->nullable();
			$table->uuid('guid');
			$table->boolean('verify')->default(0);
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
		Schema::dropIfExists('customer');
	}
}
