<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PlatformsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		DB::table('platforms')->truncate();
		DB::table('platforms')->insert(
		    array(
		    	'name' 				=>	$faker->name,
		    	'user_id' 			=> 	1,
		    	'description'		=>	"1-55-555-555",
		    
		    	)
		);

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}
