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
        return  $query
            ->join('inventory_items as inventory_items_inventory', 'items.id', '=', 'inventory_items_inventory.item_id')
            ->join('inventories', 'inventory_items_inventory.inventory_id', '=', 'inventories.id')->select('items.*', 'inventories.name as inventory_name')
            ->where('inventories.name', 'like', '%' . $name . '%');
    }
}
