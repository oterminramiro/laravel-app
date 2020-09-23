<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutTable extends Migration
{
	public function up()
	{
		Schema::create('layout', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('idorganization');
			$table->foreign('idorganization')
				  ->references('id')
				  ->on('organization')
				  ->onDelete('cascade');
			$table->index('idorganization');
			$table->unsignedBigInteger('idlocation');
			$table->foreign('idlocation')
				  ->references('id')
				  ->on('location')
				  ->onDelete('cascade');
			$table->index('idlocation');
			$table->string('name');
			$table->integer('col');
			$table->integer('row');
			$table->integer('available');
			$table->uuid('guid');
			$table->timestamps();
		});

		Schema::disableForeignKeyConstraints();
	}

	public function down()
	{
		Schema::dropIfExists('layout');
	}
}
