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
        $inventory_id =  Inventory::MaxQuantityInvenotry($item_id);
        $quantity = $request['quantity'];
        $purchaseOrder = new PurchaseOrder();

        $purchaseOrder->user_id = $user_id;
        $purchaseOrder->item_id = $item_id;
        $purchaseOrder->inventory_id = $inventory_id;
        $purchaseOrder->quantity = $quantity;
        $purchaseOrder->status = 0;

        $resutl = $purchaseOrder->save();
        if ($resutl) {
            $this->updateRelevants($item_id, $inventory_id, $quantity);
            session()->forget("cart.$item_id");
            return redirect('purchase')->with('messages', ['New Order Done Successfuly']);
        }
        return redirect()->back()->with('messages', ['Something went wrong!']);
    }
    public function storeAll(Request $request)
    {

        $user_id = $request->user()->id;

        $cart = session()->get('cart');

        foreach ($cart as $item) {

            $inventory_id =  Inventory::MaxQuantityInvenotry($item->id);

            $purchaseOrder = new PurchaseOrder();

            $purchaseOrder->user_id = $user_id;
            $purchaseOrder->item_id = $item->id;
            $purchaseOrder->inventory_id = $inventory_id;
            $purchaseOrder->quantity = $item->quantity;
            $purchaseOrder->status = 0;

            $resutl = $purchaseOrder->save();

            if ($resutl)
                $this->updateRelevants($item->id, $inventory_id, $item->quantity);
        }


        session()->forget("cart");
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $PurchaseOrder)
    {
        //
    }


    public function updateRelevants($item_id, $inventory_id, $quantity)
    {

        $pre_quantity = DB::table('inventory_items')->where('item_id', $item_id)->where('inventory_id', $inventory_id)->value('quantity');
        DB::table('inventory_items')
            ->where('item_id', $item_id)
            ->where('inventory_id', $inventory_id)
            ->update(['quantity' => ($pre_quantity - $quantity)]);


        Item::find($item_id)->increaseSales($quantity);
    }
}
