<?php

namespace App\Http\Filters\Item;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ItemsMaxPriceFilter extends Filter
{
    public function filter(Builder $query, $price)
    {
        return $query->where('price', '<=',  $price);
    }
}
