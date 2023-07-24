<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;



class ActivationFilter extends Filter
{
    public function filter(Builder $query, $active)
    {
        $table_name = $query->from;
        return $query->where($table_name.'.is_active', $active);
    }
}
