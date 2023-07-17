<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EmailFilter extends Filter
{
    public function filter(Builder $query, $email)
    {
        return $query->where('email', 'like',  '%' . $email . '%');
    }
}
