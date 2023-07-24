<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;




class ItemVendorFilter extends Filter
{
    public function filter(Builder $query, $name)
    {
       return $query
            ->join('inventory_items', 'items.id', '=', 'inventory_items.item_id')
            ->join('inventory_vendors', 'inventory_items.inventory_id', '=', 'inventory_vendors.inventory_id')
            ->join('vendors', 'inventory_vendors.vendor_id', '=', 'vendors.id')
            ->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);

        
    }
}
