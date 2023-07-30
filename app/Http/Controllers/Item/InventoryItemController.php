<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Inventory;
use App\Models\Item\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryItemController extends Controller
{
    public static function storeOne($inventory_id, $request)
    {
        $inventory = Inventory::find($inventory_id);
        $item_id =  $request['item_id'];
        $quantity = $request['quantity'];

        $item_in_relation = $inventory->items()->wherePivot('item_id', $item_id)->exists();
        if (!$item_in_relation) {
            $inventory->items()->attach($item_id, ['quantity' => $quantity]);
        } else {
            $pre_quantity = $inventory->items()->where('item_id', $item_id)->value('quantity');
            $new_quantity = $pre_quantity + $quantity;
            $inventory->items()->updateExistingPivot($item_id, ['quantity' => $new_quantity]);
        }
        $item = Item::find($item_id);
        $item->updatePurchases($quantity);
        $item->activate();
    }


    public function destroy(Request $request)
    {
        $item_id = $request['item_id'];
        if ($item_id != null) {
            $inventory = Inventory::find($request['inventory_id']);

            // $quantity = $inventory->items()->where('item_id', $item_id)->value('quantity');
            // Item::find($item_id)->decreaseTotalPurchases($quantity);

            $inventory->items()->detach($item_id);
        }
        return redirect()->back();
    }



    public static function MaxQuantityInvenotry($item_id): array
    {
        return DB::table('inventory_items')
            ->select('inventory_id', 'quantity')
            ->where('item_id', $item_id)
            ->orderBy('quantity', 'DESC')
            ->limit(1)
            ->pluck('quantity', 'inventory_id')
            ->toArray();
    }

    public static function decreaseQuantity($inventory_id, $item_id, $quantity)
    {
        $pre_quantity = DB::table('inventory_items')->where('item_id', $item_id)->where('inventory_id', $inventory_id)->value('quantity');
        DB::table('inventory_items')
            ->where('item_id', $item_id)
            ->where('inventory_id', $inventory_id)
            ->update(['quantity' => ($pre_quantity - $quantity)]);
    }


    public static function checkAvailability($item_id, $quantity)
    {
        $available_quantity = DB::table('inventory_items')->where('item_id', $item_id)->sum('quantity');
        return ($available_quantity - $quantity) > -1;
    }
}
