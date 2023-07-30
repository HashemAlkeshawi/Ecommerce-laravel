<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InventoryItemController extends Controller
{
    //
    public function create($inventory_id, Request $request)
    {

        $request['$inventory_id'] = $inventory_id;
        $brands = Brand::select('id', 'name')->get();
        $query = Item::query();

        $items = Item::filter($request->all(), $query)->paginate(8);
        foreach ($items as $item) {
            $item->image = Storage::url($item->image);
        }


        return view('inventory.members.items')->with('items', $items)->with('filters', $request)->with('brands', $brands);
    }

    public function store($inventory_id, Request $request)
    {

        $inventory = Inventory::find($inventory_id);
        $items_ids =  $request['items'];
        $quantities = $request['quantities'];
        if ($items_ids != null) {
            foreach ($items_ids as $item_id) {
                if ($quantities[$item_id] != null) {
                    $item_in_relation = $inventory->items()->wherePivot('item_id', $item_id)->exists();
                    if (!$item_in_relation) {

                        $inventory->items()->attach($item_id, ['quantity' => "$quantities[$item_id]"]);
                    } else {
                        $inventory->items()->updateExistingPivot($item_id, ['quantity' => $quantities[$item_id]]);
                    }
                }
            }
        }
        return redirect("inventory/$inventory_id#items");
    }

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
