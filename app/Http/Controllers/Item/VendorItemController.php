<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\storeItemFomVendorRequest;
use App\Models\Dashboard\Inventory;
use App\Models\Dashboard\Vendor;
use App\Models\Item\Brand;
use App\Models\Item\Item;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class VendorItemController extends Controller
{
    public function create($vendor_id, Request $request)
    {
        $query = Item::query();
        $items = Item::filter($request->all(), $query)->paginate(8);

        $inventories = Inventory::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();

        return view('dashboard.vendor.members.items', compact('items', 'brands', 'inventories'))->with('filters', $request);
    }

    public function store($vendor_id, storeItemFomVendorRequest $request)
    {
        $vendor = Vendor::find($vendor_id);
        $inventory_id = $request['inventory_id'];
        $item_id =  $request['item_id'];
        $quantity = $request['quantity'];

        $item_in_relation = $vendor->items()->wherePivot('item_id', $item_id)->exists();
        if (!$item_in_relation) {
            $vendor->items()->attach($item_id, ['quantity' => $quantity]);
        } else {
            $pre_quantity = $vendor->items()->where('item_id', $item_id)->value('quantity');
            $new_quantity = $pre_quantity + $quantity;
            $vendor->items()->updateExistingPivot($item_id, ['quantity' => $new_quantity]);
        }
        // DB

        InventoryItemController::storeOne($inventory_id, $request);

        return redirect("inventory/$inventory_id#items");
    }

    public function destroy(Request $request)
    {
        $item_id = $request['item_id'];
        if ($item_id != null) {
            $vendor = Vendor::find($request['vendor_id']);
            $vendor->items()->detach($item_id);
        }
        return redirect()->back();
    }
}
