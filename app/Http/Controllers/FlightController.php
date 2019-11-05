<?php

namespace App\Http\Controllers;

use App\Flight;
use App\Http\Resources\FlightResource;
use App\Filters\FlightFilters;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FlightController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param FlightFilters $filters
     * @return AnonymousResourceCollection
     */
    public function index(FlightFilters $filters)
    {
        $flights = Flight::with('departure', 'arrival', 'airline')->filter($filters)->paginate(15);

        return FlightResource::collection($flights);
    }


    /**
     * Display the specified resource.
     *
     * @param Flight $flight
     * @return FlightResource
     */
    public function show(Flight $flight)
    {
        return new FlightResource($flight);
    }

}
