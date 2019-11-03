<?php


namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilters
{

    /**
     * The request object
     *
     * @var Request
     */
    protected $request;

    /**
     * The builder instance
     *
     * @var
     */
    protected $builder;

    /**
     * Create a new QueryFilters instance
     *
     * QueryFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply all existing filters to the builder
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder) {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value)  {
            if(! method_exists($this, $name)) {
                continue;
            }

            if(strlen($value)) {
                $this->$name($value);
            } else {
//                $this->$name();
            }
        }

        return $this->builder;
    }

    /**
     * Get all filters from request
     *
     * @return array
     */
    public function filters() {
        return $this->request->all();
    }
}
