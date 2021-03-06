<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AirportsTableSeeder::class);

        $this->call(AirlinesTableSeeder::class);

        $this->call(FlightsSeeder::class);
    }
}
