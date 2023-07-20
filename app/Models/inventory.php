<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class inventory extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
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
        return $this->belongsToMany(Vendor::class, 'inventory_items')->withTimestamps();
    }
}
