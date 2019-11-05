<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class AirportResource extends Resource
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
            'icao' => $this->icao,
            'code' => $this->code,
            'name' => $this->name,
            'city' => $this->city,
            'region' => $this->region,
            'country_code' => $this->country_code,
            'latitude' => (float)$this->latitude,
            'longitude' => (float)$this->longitude,
            'timezone' => $this->timezone,
        ];
    }
}
