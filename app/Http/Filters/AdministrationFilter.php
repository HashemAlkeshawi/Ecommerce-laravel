<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;



class AdministrationFilter
{
    public function filter(Builder $query, $admin)
    {
        return  $query->where('is_admin', $admin);
    }
}
