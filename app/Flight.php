<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
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

    public function departure() {
        return $this->belongsTo(Airport::class, 'id','departure_airport');
    }

    public function arrival() {
        return $this->belongsTo(Airport::class, 'id', 'arrival_airport');
    }
}
