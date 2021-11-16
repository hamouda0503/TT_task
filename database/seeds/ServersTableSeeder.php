<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServersTableSeeder extends Seeder {


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		DB::table('servers')->truncate();

		DB::table('servers')->insert(
		    array(
		    	'name' 				=>	"First Server",
		    	'user_id' 			=> 	1,
		    	'platform_id'			=>	1,
		    	)
		);

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}
