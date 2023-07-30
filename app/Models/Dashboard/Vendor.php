<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\Filter;
use App\Models\Address\Address;
use App\Models\Item\Item;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function scopeFilter(Builder $query, $request)
    {

        Filter::apply($query, $request);
    }



    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function Inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class, 'inventory_vendors')->withTimestamps();
    }


    public function Items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'vendor_items')->withPivot(
            [
                'quantity',
                'created_at',
                'updated_at',
            ]
        );
    }
}
