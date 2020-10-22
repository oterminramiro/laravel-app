<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
	public function up()
	{
		Schema::create('location', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('idorganization');
			$table->foreign('idorganization')
				  ->references('id')
				  ->on('organization')
				  ->onDelete('cascade');
			$table->index('idorganization');
			$table->string('name');
			$table->integer('cols');
			$table->integer('rows');
			$table->uuid('guid');
			$table->time('since',0);
			$table->time('until',0);
			$table->timestamps();
		});

		Schema::disableForeignKeyConstraints();
	}

	public function down()
	{
		Schema::dropIfExists('location');
	}
}
