<?php

namespace App\Http\Filters\Item;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;




class MaxQuantityInventoryFilter extends Filter
{
    public function filter(Builder $query, $item_id)
    {
        dd($item_id);
        return $query->join('inventory_items', 'inventory_id', '=', 'id')->where('item_id', $item_id)->orderBy('quantity', 'DESC')->limit(1);
    }
}
