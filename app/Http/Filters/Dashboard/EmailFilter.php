<?php

namespace App\Http\Filters\Dashboard;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class EmailFilter extends Filter
{
    public function filter(Builder $query, $email)
    {
        return $query->where('email', 'like',  '%' . $email . '%');
    }
}
