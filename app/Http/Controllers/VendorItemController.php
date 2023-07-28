<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeItemFomVendorRequest;
use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorItemController extends Controller
{
    //
    public function create($vendor_id, Request $request)
    {

        $query = Item::query();
        $items = Item::filter($request->all(), $query)->paginate(8);
        


        $inventories = Inventory::select('id', 'name')->get();
        $brands = Brand::select('id', 'name')->get();

        return view('vendor.members.items', compact('items', 'brands', 'inventories'))->with('filters', $request);
    }

    public function store($vendor_id, storeItemFomVendorRequest $request)
    {

        $vendor = Vendor::find($vendor_id);
        $inventory_id = $request['inventory_id'];
        $item_id =  $request['item_id'];
        $quantity = $request['quantity'];
        
        $vendor->items()->syncWithoutDetaching([$item_id => ['quantity' => $quantity]]);

        $inventoryController = app(InventoryItemController::class);
        $inventoryController->storeOne($inventory_id, $request);




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
