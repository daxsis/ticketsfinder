<?php

use App\Airline;
use App\Airport;
use App\Flight;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flight::truncate();

        $timestamp = Carbon::now();
        $airlineIds = Airline::pluck('id')->toArray();
//        $airlineIata = Airline::pluck('iata')->toArray();
        $airports = Airport::pluck('id')->toArray();

        $flights = array();
        for($i = 0; $i <= 500; $i++) {
            $number = rand(100, 999);
            $airlineId = $airlineIds[array_rand($airlineIds)];
            $airlineIata = Airline::where('id', $airlineId)->first()->iata;

            $flights[] = factory(Flight::class)->raw([
                'airline_id' => $airlineId,
                'number' => $number,
                'uid' => $airlineIata . $number,
                'departure_airport' => $airports[array_rand($airports)],
                'arrival_airport' => $airports[array_rand($airports)],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }

        Flight::insert($flights);

    }
}
