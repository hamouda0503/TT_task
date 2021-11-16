<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPointOfContactToPlatformsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('platforms', function(Blueprint $table)
		{
			$table->string('point_of_contact');
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
			$table->dropColumn(['point_of_contact']);
		});
	}

}
