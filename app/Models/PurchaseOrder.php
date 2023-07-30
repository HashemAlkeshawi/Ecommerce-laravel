<?php

namespace App\Models;

use App\Http\Controllers\InventoryItemController;
use App\Mail\NotifyVendorQuantityDropMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PurchaseOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }

    protected static function booted(): void
    {
        static::created(function (PurchaseOrder $purchaseOrder) {
            // ...
            InventoryItemController::decreaseQuantity($purchaseOrder->inventory_id, $purchaseOrder->item_id, $purchaseOrder->quantity);
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
                
                // foreach ($item_vendors as $item_vendor) {
                //     Mail::to($item_vendor)->send(new NotifyVendorQuantityDropMail("$item_vendor->first_name $item_vendor->last_name", $item));
                // }
            }
        });
    }
}
