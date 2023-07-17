<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;



class ActivationFilter
{
    public function filter(Builder $query, $active)
    {
        return $query->where('is_active', $active);
    }
}
