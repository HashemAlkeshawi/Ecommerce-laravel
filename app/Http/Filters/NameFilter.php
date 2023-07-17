<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;




class NameFilter extends Filter
{
    public function filter(Builder $query, $name)
    {
        $first_name = explode(' ', $name)[0];
        $last_name = explode(' ', $name)[1];
        return $query->where('first_name', 'like',  '%' . $first_name)->where('last_name', 'like',  '%' . $last_name);
    }
}
