<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Airline;
use App\Airport;
use App\Flight;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Flight::class, function (Faker $faker) {
    $departure_time = Carbon::instance($faker->dateTimeBetween(
        Carbon::now()->toDateTimeString(),
        Carbon::now()->addMonth()->toDateTimeString()
    ));
    $hours = $faker->numberBetween(1, 12);
    $minutes = $faker->numberBetween(1, 59);
    $airline = factory(Airline::class)->create()->id;
    $number = $faker->numberBetween(0, 999);

    return [
        'airline_id' => $airline,
        'number' => $number,
        'uid' => $airline . $number,
        'departure_airport' => function() { return factory(Airport::class)->create()->id; },
        'arrival_airport' => function() { return factory(Airport::class)->create()->id; },
        'departure_time' => $departure_time->toDateTimeString(),
        'arrival_time' => $departure_time->addHours($hours)->addMinutes($minutes)->toDateTimeString(),
        'hours' => $hours,
        'minutes' => $minutes,
        'price' => $faker->randomFloat(2, 0, 5000),
    ];
});
