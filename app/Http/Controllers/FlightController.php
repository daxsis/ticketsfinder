<?php

namespace App\Http\Controllers;

use App\Flight;
use App\Http\Resources\FlightResource;
use App\Filters\FlightFilters;
use Illuminate\Http\Request;

class FlightController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param FlightFilters $filters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(FlightFilters $filters)
    {
        $flights = Flight::with('departure', 'arrival', 'airline')->filter($filters)->paginate(15);

        return FlightResource::collection($flights);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Flight  $flight
     * @return Flight
     */
    public function show(Flight $flight)
    {
        return $flight;
    }
}
