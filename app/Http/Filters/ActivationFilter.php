<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;



class ActivationFilter extends Filter
{
    public function scopeFilter(Builder $query, $active)
    {
        return $query->where('is_active', $active);
    }
}
