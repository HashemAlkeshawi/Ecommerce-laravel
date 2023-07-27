<?php

namespace App\Models;

use App\Http\Filters\ActivationFilter;
use App\Http\Filters\BrandIdFilter;
use App\Http\Filters\ItemNameFilter;
use App\Http\Filters\Filter;
use App\Http\Filters\IdFilter;
use App\Http\Filters\NameFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeFilter($query, $request)
    {
        Filter::apply($query, $request);
    }

    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class, 'inventory_items')->withPivot(
            [
                'quantity',
                'created_at',
                'updated_at',
                'deleted_at'
            ]
        );
    }
    /***
     * implementing the cart with database -> now it is by session;
     */

    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'user_items')->withPivot(
    //         [
    //             'quantity',
    //             'created_at',
    //             'updated_at',
    //             'deleted_at'
    //         ]
    //     );
    // }

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class, 'vendor_items')->withPivot(
            [
                'quantity',
                'created_at',
                'updated_at',
            ]
        );
    }

    public function isActive(): bool
    {
        return $this->is_active == 1;
    }
}
