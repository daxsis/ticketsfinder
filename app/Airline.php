<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->icao;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'icao';
    }

    /**
     * Return flights referenced for this airline
     *
     * @return HasMany
     */
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
