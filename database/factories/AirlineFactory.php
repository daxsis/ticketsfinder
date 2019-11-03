<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Airline;
use Faker\Generator as Faker;

$factory->define(Airline::class, function (Faker $faker) {
    $iata = strtoupper($faker->lexify('???'));
    return [
        'iata' => $iata,
        'icao' => strtoupper($faker->lexify('?')) . $iata,
        'name' => $faker->sentence(3),
    ];
});
