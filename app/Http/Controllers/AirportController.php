<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Filters\AirportFilters;
use App\Http\Resources\AirportResource;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AirportFilters $filters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(AirportFilters $filters)
    {
        $airports = Airport::filter($filters)->paginate(15);

        return AirportResource::collection($airports);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Airport  $airport
     * @return Airport
     */
    public function show(Airport $airport)
    {
        return $airport;
    }
}
