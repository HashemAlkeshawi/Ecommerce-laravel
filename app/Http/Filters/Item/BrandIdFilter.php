<?php

namespace App\Http\Filters\Item;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class BrandIdFilter extends Filter
{
    public function filter(Builder $query, $brand_id)
    {


        return  $query->whereHas('brand', function ($query) use ($brand_id) {
            $query->where('id', $brand_id);
        });
    }
}
