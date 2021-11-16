<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->command->info('Users table seeded!');

		$this->call('PlatformsTableSeeder');
		$this->command->info('Platforms table seeded!');

		$this->call('ServersTableSeeder');
		$this->command->info('Servers table seeded!');

		$this->call('TasksTableSeeder');
		$this->command->info('Tasks table seeded!');

		$this->command->info('Test Account: EMAIL: test@tt.com PASSWORD: secret');
		
		
		$this->call('ConferSeeder');
		$this->command->info('confer table seeded!');


	}

}
