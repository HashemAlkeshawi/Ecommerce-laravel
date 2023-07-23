<?php

namespace App\Models;

use App\Http\Filters\IdFilter;
use App\Http\Filters\Filter;
use App\Http\Filters\ItemNameFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    use HasFactory;


    public function scopeFilter($query, $request)
    {
      
        Filter::apply($query, $request);

    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
