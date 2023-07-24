<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;




class ItemInventoryFilter extends Filter
{
    public function filter(Builder $query, $name)
    {
        // 
        // return  $query->whereHas('inventories', function ($query) use ($name) {
        //     $query->where('name', 'like', '%' . $name . '%');
        // });
        // return 
        return  $query
            ->join('inventory_items', 'items.id', '=', 'inventory_items.item_id')
            ->join('inventories', 'inventory_items.inventory_id', '=', 'inventories.id')
            ->where('inventories.name', 'like', '%' . $name . '%');
    }
}
