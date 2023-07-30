<?php

namespace App\Http\Filters\Address;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class AddressCountryFilter extends Filter
{
    public function filter(Builder $query, $country_id)
    {


        return  $query->whereHas('address.city.country', function ($query) use ($country_id) {
            $query->where('id', $country_id);
        });
    }
}
