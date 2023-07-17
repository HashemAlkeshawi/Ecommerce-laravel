<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;



class UsernameFilter
{
    public function filter(Builder $query, $username)
    {
        return $query->where('username', 'like',  '%' . $username . '%');
    }
}
