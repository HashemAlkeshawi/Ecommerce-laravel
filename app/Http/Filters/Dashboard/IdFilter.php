<?php

namespace App\Http\Filters\Dashboard;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class IdFilter extends Filter
{
    public function filter(Builder $query, $id)
    {


        return  $query->where('id' ,$id);
    }
}
