<?php

namespace App\Http\Controllers;

use App\Http\Filters\MaxQuantityInventoryFilter;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = PurchaseOrder::with('item')->orderBy('created_at', 'DESC')->paginate(20);

        return view('order.index', compact('orders'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user_id = $request->user()->id;
        $item_id = $request['item_id'];
        $quantity = $request['quantity'];
        if (InventoryItemController::checkAvailability($item_id, $quantity)) {
            while ($quantity > 0) {
                $inventory_items = InventoryItemController::MaxQuantityInvenotry($item_id);
                $inventory_id = array_key_first($inventory_items);
                $inventory_available_quantity =  $inventory_items[$inventory_id];

                $purchaseOrder = new PurchaseOrder();

                $purchaseOrder->user_id = $user_id;
                $purchaseOrder->item_id = $item_id;
                $purchaseOrder->inventory_id = $inventory_id;
                $purchaseOrder->status = 0;

                $inventory_available_quantity < $quantity ?
                    $purchaseOrder->quantity = $inventory_available_quantity :
                    $purchaseOrder->quantity = $quantity;

                $resutl = $purchaseOrder->save();

                if ($resutl) {
                    $quantity =  $quantity -= $purchaseOrder->quantity;
                    if ($quantity == 0) {
                        session()->forget("cart.$item_id");
                        return redirect('purchase')->with('messages', ['New Order Done Successfuly']);
                    } else {
                        continue;
                    }
                }
                return redirect()->back()->with('messages', ['Something went wrong!']);
            }
        } else {
            return redirect()->back()->with('messages', ['Sorry, quantity is not available now']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $PurchaseOrder)
    {
        //
    }
}
