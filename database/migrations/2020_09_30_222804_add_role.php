<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRole extends Migration
{

	public function up()
	{
		Schema::create('role', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('key');
		});
	}

	public function down()
	{
		Schema::dropIfExists('role');
	}
}
