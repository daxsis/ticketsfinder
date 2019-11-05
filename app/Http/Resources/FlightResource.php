<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class FlightResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'airline' => new AirlineResource($this->airline),
            'number' => $this->number,
            'uid' => $this->uid,
            'departure_airport' => new AirportResource($this->departure),
            'arrival_airport' => new AirportResource($this->arrival),
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'hours' => (int)$this->hours,
            'minutes' => (int)$this->minutes,
            'price' => $this->price,
        ];
    }
}
