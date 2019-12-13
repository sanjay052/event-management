<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
		
		foreach (range(1,5) as $index) {
	        DB::table('locations')->insert([
	            'name' => $faker->name,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
	        ]);
			
			DB::table('categories')->insert([
	            'name' => $faker->name,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
	        ]);
		}
		
		DB::table('users')->insert([
			'name' => 'Sanjay',
			'role_id' => 1,
			'email' => 'sanjay@gmail.com',
			'password' => bcrypt('Simple1'),			
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
	    ]);
			
		
    	foreach (range(1,5) as $index) {
	        DB::table('events')->insert([
	            'title' => $faker->name,
	            'slug' => $faker->slug,
	            'location_id' => $faker->numberBetween($min = 1, $max = 5), 
	            'description' => $faker->text,
	            'date' => $faker->dateTime(),				
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
	        ]);
		}
		
		foreach (range(1,5) as $index) {			
			DB::table('event_categories')->insert([
	            'event_id' => $faker->numberBetween($min = 1, $max = 5),
	            'category_id' => $faker->numberBetween($min = 1, $max = 5),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
	        ]);
		}
    }
}
