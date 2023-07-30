<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ItemsMaxPriceFilter extends Filter
{
    public function filter(Builder $query, $price)
    {
        return $query->where('price', '<=',  $price );
    }
}
