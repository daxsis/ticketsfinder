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
        return $this->airport_city($city, 'departure');
    }

    /**
     * Filter by arrival city.
     *
     * @param string $city
     * @return Builder
     */
    public function arrival(string $city)
    {
        return $this->airport_city($city, 'arrival');;
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
     * @param $city
     * @param $relationship
     * @return mixed
     */
    private function airport_city($city, $relationship)
    {
        return $this->builder->whereHas($relationship, function ($builder) use ($city) {
            $builder->where('city', 'like', '%' . $city . '%');
        });
    }
}
