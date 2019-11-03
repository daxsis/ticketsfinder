<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FlightResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'airline' => new AirlineResource($this->airline),
            'number' => $this->number,
            'uid' => $this->uid,
            'departure_airport' => new AirportResource($this->departure),
            'arrival_airport' => new AirportResource($this->arrival),
            'departed_time' => $this->departed_time,
            'arrived_time' => $this->arrived_time,
            'hours' => (int) $this->hours,
            'minutes' => (int) $this->minutes,
            'price' => $this->price,
        ];
    }
}
