<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airport extends Model
{
    use Filterable;

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->code;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * Get departure flights from the airport
     *
     * @return HasMany
     */
    public function departures()
    {
        return $this->hasMany(Flight::class, 'departure_airport');
    }

    /**
     * Get all arrival flights to this airport
     *
     * @return HasMany
     */
    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'arrival_airport');
    }
}
