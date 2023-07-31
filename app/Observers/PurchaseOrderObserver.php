<?php

namespace App\Observers;

use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\Item\InventoryItemController as ItemInventoryItemController;
use App\Mail\NotifyVendorQuantityDropMail;
use App\Models\Item\Item;
use App\Models\Item\PurchaseOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PurchaseOrderObserver
{
    /**
     * Handle the PurchaseOrder "created" event.
     */
    public function created(PurchaseOrder $purchaseOrder): void
    {
        //
        ItemInventoryItemController::decreaseQuantity($purchaseOrder->inventory_id, $purchaseOrder->item_id, $purchaseOrder->quantity);
        Item::find($purchaseOrder->item_id)->increaseSales($purchaseOrder->quantity);

        $available_quantity = DB::table('inventory_items')->where('item_id', $purchaseOrder->item_id)->sum('quantity');
        if ($available_quantity < 50) {
            $item_vendors = DB::table('vendor_items')
                ->select('vendors.*')
                ->join('vendors', 'vendor_items.vendor_id', '=', 'vendors.id')
                ->where('vendor_items.item_id',  $purchaseOrder->item_id)->get();
            $item = Item::find($purchaseOrder->item_id);

            //send email to vendors
            /**
             * Disabeling this due to email sending cost!
             */

            foreach ($item_vendors as $item_vendor) {
                if ($item_vendor->is_active)
                    Mail::to($item_vendor)->queue(new NotifyVendorQuantityDropMail("$item_vendor->first_name $item_vendor->last_name", $item));
            }
        }
    }

    /**
     * Handle the PurchaseOrder "updated" event.
     */
    public function updated(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "deleted" event.
     */
    public function deleted(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "restored" event.
     */
    public function restored(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "force deleted" event.
     */
    public function forceDeleted(PurchaseOrder $purchaseOrder): void
    {
        //
    }
}
