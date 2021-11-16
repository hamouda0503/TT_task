<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('platform_id');
			$table->string('name');
			$table->text('description');
			$table->string('cpu');
            $table->string('os');
            $table->string('os_ver');
            $table->string('ram');
            $table->string('stockage');
            $table->string('nbr_partition');
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
		Schema::drop('servers');
	}

}
