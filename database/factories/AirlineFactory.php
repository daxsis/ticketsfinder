<?php

/** @var Factory $factory */

use App\Airline;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Airline::class, function (Faker $faker) {
    $iata = strtoupper($faker->lexify('???'));
    return [
        'iata' => $iata,
        'icao' => strtoupper($faker->lexify('?')) . $iata,
        'name' => $faker->sentence(3),
    ];
});
