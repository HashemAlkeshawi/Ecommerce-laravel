<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;



class AdministrationFilter extends Filter
{
    public function scopeFilter(Builder $query, $admin)
    {
        return  $query->where('is_admin', $admin);
    }
}
