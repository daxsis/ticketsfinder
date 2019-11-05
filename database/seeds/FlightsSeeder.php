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
        $timestamp = Carbon::now();
        $airlineIds = Airline::pluck('id')->toArray();
        $airports = Airport::pluck('id')->toArray();

        $flights = array();
        for ($i = 0; $i <= 500; $i++) {
            $number = rand(100, 999);
            $airlineId = $airlineIds[array_rand($airlineIds)];
            $airline = Airline::where('id', $airlineId)->first();
            $departure_airport = Airport::where('id', $airports[array_rand($airports)])->first();
            $arrival_airport = Airport::where('id', $airports[array_rand($airports)])->first();

            $flight = factory(Flight::class)->raw([
                'airline_id' => $airlineId,
                'number' => $number,
                'uid' => $airline->iata . $number,
                'departure_airport' => $departure_airport->id,
                'arrival_airport' => $arrival_airport->id,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
            $flight['departure_time'] = Carbon::parse($flight['departure_time'])->setTimezone($departure_airport->timezone)->toDateTimeString();
            $flight['arrival_time'] = Carbon::parse($flight['arrival_time'])->setTimezone($arrival_airport->timezone)->toDateTimeString();

            array_push($flights, $flight);
        }

        Flight::insert($flights);

    }
}
