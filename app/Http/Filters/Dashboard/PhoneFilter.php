<?php

namespace App\Http\Filters\Dashboard;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PhoneFilter extends Filter
{
    public function filter(Builder $query, $phone)
    {
        return $query->where('phone', 'like',  '%' . $phone . '%');
    }
}
