<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function flights() {
        return $this->hasMany(Flight::class);
    }
}
