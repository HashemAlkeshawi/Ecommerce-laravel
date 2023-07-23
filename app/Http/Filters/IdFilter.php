<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class IdFilter extends Filter
{
    public function filter(Builder $query, $id)
    {


        return  $query->where('id' ,$id);
    }
}
