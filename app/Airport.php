<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
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

    public function departures()
    {
        return $this->hasMany(Flight::class, 'departure_airport');
    }

    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'arrival_airport');
    }
}
