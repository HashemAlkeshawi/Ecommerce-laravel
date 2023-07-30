<?php

namespace App\Http\Filters\Item;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ItemQuantityFilter extends Filter
{
    public function filter(Builder $query, $quantity)
    {
        $subquery = DB::table('inventory_items')
            ->select('item_id', DB::raw('SUM(quantity) as sum_quantity'))
            ->groupBy('item_id')
            ->having('sum_quantity', '>=', 50);

        return $query->joinSub($subquery, 'inventory_item_sum', function ($join) {
            $join->on('items.id', '=', 'inventory_item_sum.item_id');
        })->select('items.*');
    }
}
