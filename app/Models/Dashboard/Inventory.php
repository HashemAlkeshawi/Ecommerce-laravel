<?php

namespace App\Models\Dashboard;

use App\Http\Filters\Filter;
use App\Models\Address\City;
use App\Models\Item\Item;
use App\Models\Item\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function scopeFilter($query, $request)
    {
        Filter::apply($query, $request);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function purchase_orders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'inventory_items')->withPivot(
            [
                'quantity',
                'created_at',
                'updated_at',
                'deleted_at'
            ]
        );
    }
    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class, 'inventory_vendors')->withTimestamps();
    }
}
