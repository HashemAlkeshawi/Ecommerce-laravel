<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;



class UsernameFilter extends Filter
{
    public function filter(Builder $query, $username)
    {
        return $query->where('username', 'like',  '%' . $username . '%');
    }
}
