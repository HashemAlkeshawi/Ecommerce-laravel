<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;




class NameFilter extends Filter
{
    public function filter(Builder $query, $name)
    {
        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);
    }
}
