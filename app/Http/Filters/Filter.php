<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\FiltersRequest;

abstract class Filter
{
    public abstract function filter(Builder $query, String $queryParam);

    public static function apply(Builder $query, FiltersRequest $request, array $filters)
    {
        foreach ($filters as $filter) {
           
            $filter->filter($query, $request[class_basename($filter)]);
        }
    }
}
