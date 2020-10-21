<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooking extends Migration
{
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idcustomer');
            $table->foreign('idcustomer')
                  ->references('id')
                  ->on('customer')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('idorganization');
            $table->foreign('idorganization')
                  ->references('id')
                  ->on('organization')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('idlocation');
            $table->foreign('idlocation')
                  ->references('id')
                  ->on('location')
                  ->onDelete('cascade');
            $table->integer('people');
            $table->integer('people');
			$table->timestamp('date', 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
