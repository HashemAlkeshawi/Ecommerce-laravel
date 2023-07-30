<?php

namespace App\Http\Filters\Dashboard;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;




class NameFilter extends Filter
{
    public function filter(Builder $query, $name)
    {
        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);
    }
}
