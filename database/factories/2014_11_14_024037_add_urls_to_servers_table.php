<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlsToServersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('servers', function(Blueprint $table)
		{
			$table->string('production');
			$table->string('stage');
			$table->string('dev');
			$table->string('github');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servers', function(Blueprint $table)
		{
			$table->dropColumn(['production','stage','dev','github']);
		});
	}

}
