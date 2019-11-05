<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class AirlineResource extends Resource
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
            'iata' => $this->iata,
            'icao' => $this->icao,
            'name' => $this->name,
        ];
    }
}
