<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class FlightFilters extends QueryFilters
{
    /**
     * Filter by departure city.
     *
     * @param string $city
     * @return Builder
     */
    public function departure(string $city)
    {
        return $this->airport('city', $city, 'departure');
    }

    /**
     * Filter by arrival city.
     *
     * @param string $city
     * @return Builder
     */
    public function arrival(string $city)
    {
        return $this->airport('city', $city, 'arrival');;
    }

    /**
     * Filter fights by airport ICAO code
     *
     * @param string $icao
     * @return mixed
     */
    public function icao_from(string $icao)
    {
        return $this->airport('icao', $icao, 'departure');
    }

    /**
     * Filter fights by airport ICAO code
     *
     * @param string $icao
     * @return mixed
     */
    public function icao_to(string $icao)
    {
        return $this->airport('icao', $icao, 'arrival');
    }


    /**
     * Filter by departure time.
     *
     * @param string $date
     * @return Builder
     */
    public function date(string $date)
    {
        return $this->builder->whereDate('departure_time', $date);
    }

    /**
     * Filter by airline name.
     *
     * @param string $airline
     * @return Builder
     */
    public function airline(string $airline)
    {
        return $this->builder->whereHas('airline', function (Builder $builder) use ($airline) {
            $builder->where('name', 'like', '%' . trim($airline) . '%');
        });
    }

    /**
     * Use departure/arrival relation to find airport that contains city.
     *
     * @param string $column
     * @param string $parameter
     * @param string $relationship
     * @return mixed
     */
    private function airport($column, $parameter, $relationship)
    {
        return $this->builder->whereHas($relationship, function ($builder) use ($column, $parameter) {
            $builder->where($column, 'like', '%' . $parameter . '%');
        });
    }
}
