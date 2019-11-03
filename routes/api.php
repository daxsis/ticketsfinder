<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('/airports', 'AirportController')->only(['index', 'show']);

Route::apiResource('/airlines', 'AirlineController')->only(['index', 'show']);

Route::apiResource('/flights', 'FlightController')->only(['index', 'show']);

Route::apiResource('/trips', 'TripsController')->only(['index', 'show', 'store']);

