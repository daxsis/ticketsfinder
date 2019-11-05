<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Trip;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Response;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $trips = Trip::with('flights')->get();

        return TripResource::collection($trips);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Trip $trip
     * @return array
     */
    public function update(Request $request, Trip $trip)
    {
        $flights = json_decode($request->getContent());
        $ids = [];
        foreach ($flights as $flight) {
            array_push($ids, $flight->id);
        }
        $trip->flights()->sync($ids);

        return $trip->flights()->sync($ids);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $trip = Trip::create([]);

        return (new TripResource($trip))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Trip $trip
     * @return TripResource
     */
    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Trip $trip
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return Response::json([], 204);
    }
}
