<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCode extends Migration
{
	public function up()
	{
		Schema::create('customercode', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('idcustomer');
			$table->foreign('idcustomer')
				  ->references('id')
				  ->on('customer')
				  ->onDelete('cascade');
			$table->char('code', 100);
		});
	}

	public function down()
	{
		Schema::dropIfExists('customercode');
	}
}
