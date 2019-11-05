<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trip extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Whenever a Trip instance is being created, assign a uid to it.
         */
        self::creating(function ($trip) {
            $trip->uid = uniqid();
        });

        /**
         * Whenever a Trip instance is being deleted, detach its flights.
         */
        self::deleting(function ($trip) {
            $trip->flights()->detach();
        });
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->uid;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uid';
    }

    /**
     * Get referenced flight to the trip
     *
     * @return BelongsToMany
     */
    public function flights()
    {
        return $this->belongsToMany('App\Flight', 'flight_trip', 'trip_id', 'flight_id');
    }
}
