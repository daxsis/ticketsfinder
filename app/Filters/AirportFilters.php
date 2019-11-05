<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class AirportFilters extends QueryFilters
{
    /**
     * Filter by city.
     *
     * @param string $city
     * @return Builder
     */
    public function city(string $city)
    {
        return $this->builder->where('city', 'like', "%$city%");
    }

    /**
     * Filter by ICAO code.
     *
     * @param string $iata
     * @return Builder
     */
    public function icao(string $icao)
    {
        return $this->builder->where('icao', 'like', "%$icao%");
    }

    /**
     * Filter by name.
     *
     * @param string $name
     * @return Builder
     */
    public function name(string $name)
    {
        return $this->builder->where('name', 'like', "%$name%");
    }

    /**
     * Filter by the region.
     *
     * @param $region
     * @return mixed
     */
    public function region($region)
    {
        return $this->builder->where('region', 'like', "%$region%");
    }
}
