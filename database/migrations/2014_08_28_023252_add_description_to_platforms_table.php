<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDescriptionToPlatformsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('platforms', function(Blueprint $table)
		{
			$table->string('description',255);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('platforms', function(Blueprint $table)
		{
			$table->dropColumn(['description']);
		});
	}

}
