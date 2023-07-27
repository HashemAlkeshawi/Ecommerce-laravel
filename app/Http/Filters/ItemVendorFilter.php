<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;




class ItemVendorFilter extends Filter
{
    public function filter(Builder $query, $name)
    {



        return  $query->whereHas('vendors', function ($query) use ($name) {
            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);
            });

            
     /**
      * Using inventory_vendor -> before implementing vendor_items relation
      */

        
        // return $query
        //     ->join('inventory_items as inventory_items_vendors', 'items.id', '=', 'inventory_items_vendors.item_id')
        //     ->join('inventory_vendors', 'inventory_items_vendors.inventory_id', '=', 'inventory_vendors.inventory_id')
        //     ->join('vendors', 'inventory_vendors.vendor_id', '=', 'vendors.id')
        //     ->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);
    }
}
