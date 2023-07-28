<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CountryFilter extends Filter
{
    public function filter(Builder $query, $country_id)
    {
        return  $query->whereHas('city.country', function ($query) use ($country_id) {
            $query->where('id', $country_id);
        });
    }
}
