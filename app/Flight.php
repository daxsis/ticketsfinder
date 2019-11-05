<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Flight extends Model
{
    use Filterable;

    /**
     * Properties to cast into native types
     *
     * @var array
     */
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price' => 'float',
    ];

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
     * Find a departure airport for the flight
     *
     * @return BelongsTo
     */
    public function departure()
    {
        return $this->belongsTo(Airport::class, 'departure_airport', 'id');
    }

    /**
     * Find an arrival airport for the flight
     *
     * @return BelongsTo
     */
    public function arrival()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport', 'id');
    }

    /**
     * Find an airline responsible for serving the flight
     *
     * @return BelongsTo
     */
    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    /**
     * Get all trips referenced for this flight
     *
     * @return BelongsToMany
     */
    public function trips()
    {
        return $this->belongsToMany('App\Trips', 'flight_trip', 'flight_id', 'trip_id');
    }
}
