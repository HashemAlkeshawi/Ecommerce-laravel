<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;




class ItemNameFilter extends Filter
{
    public function filter(Builder $query, $name)
    {
      $table_name = $query->from;
      return  $query->where($table_name.'.name', 'like',  "%" . "$name" . "%");
    }
}
