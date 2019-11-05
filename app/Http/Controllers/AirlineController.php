<?php

namespace App\Http\Controllers;

use App\Airline;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AirlineController extends Controller
{
    /**
     * Get all airlines
     *
     * @return mixed
     */
    public function index()
    {
        return Airline::all()->orderBy('name');
    }

    /**
     * Display the specified resource.
     *
     * @param Airline $airline
     * @return Airline
     */
    public function show(Airline $airline)
    {
        return $airline;
    }

}
