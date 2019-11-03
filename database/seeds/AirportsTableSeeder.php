<?php

use Carbon\Carbon;
use App\Airport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AirportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airport::truncate();

        $airportsAll = json_decode(Storage::get('test_data/airports.json'), true);
        $airports = [];
        $timestamp = Carbon::now()->toDateTimeString();

        foreach($airportsAll as $airport) {
            if($airport['country'] !== 'CA') {
                continue;
            }
            $airports[] = [
                'icao' => $airport['icao'],
                'code' => $airport['iata'] !== '' ? $airport['iata'] : null,
                'name' => $airport['name'],
                'city' => $airport['city'],
                'country_code' => $airport['country'],
                'region' => $airport['state'],
                'latitude' => $airport['lat'],
                'longitude' => $airport['lon'],
                'timezone' => $airport['tz'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        Airport::insert($airports);

    }
}
