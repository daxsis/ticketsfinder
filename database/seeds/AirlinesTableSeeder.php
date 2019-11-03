<?php

use App\Airline;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AirlinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airline::truncate();

        $airlinesAll = json_decode(Storage::get('test_data/airlines.json'), true);
        $airlines = [];
        $timestamp = Carbon::now();

        foreach($airlinesAll as $airline) {
            if($airline['active'] == 'N' || $airline['icao'] == '') {
                continue;
            }

            $airlines[] = [
                'iata' => $airline['iata'],
                'icao' => $airline['icao'],
                'name' => $airline['name'],
                'created_at' => NOW(),
                'updated_at' => NOW()
            ];
        }

        Airline::insert($airlines);

    }
}
