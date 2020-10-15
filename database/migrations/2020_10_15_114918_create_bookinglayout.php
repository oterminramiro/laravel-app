<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingLayout extends Migration
{
	public function up()
	{
		Schema::create('bookinglayout', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('idbooking');
			$table->foreign('idbooking')
				  ->references('id')
				  ->on('booking')
				  ->onDelete('cascade');
			$table->unsignedBigInteger('idlayout');
			$table->foreign('idlayout')
				  ->references('id')
				  ->on('layout')
				  ->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('bookinglayout');
	}
}
