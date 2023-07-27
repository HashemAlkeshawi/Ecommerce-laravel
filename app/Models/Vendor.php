<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\NameFilter;
use App\Http\Filters\ActivationFilter;
use App\Http\Filters\CountryFilter;
use App\Http\Filters\EmailFilter;
use App\Http\Filters\PhoneFilter;
use App\Http\Filters\Filter;
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
