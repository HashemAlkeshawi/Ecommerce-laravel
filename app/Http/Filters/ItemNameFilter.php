<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;




class ItemNameFilter extends Filter
{
    public function filter(Builder $query, $name)
    {
      $resutl =   $query->where('name', 'like',  "%" . "$name" . "%");
    //   dd($resutl);
    }
}
