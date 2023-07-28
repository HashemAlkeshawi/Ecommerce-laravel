<?php

namespace App\Models;

use App\Http\Filters\ActivationFilter;
use App\Http\Filters\AdministrationFilter;
use App\Http\Filters\CountryFilter;
use App\Http\Filters\EmailFilter;
use App\Http\Filters\NameFilter;
use App\Http\Filters\UsernameFilter;
use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\FiltersRequest;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;


    public function scopeFilter(Builder $query,   $request)
    {

        Filter::apply($query, $request);
    }
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    // public function items(): BelongsToMany
    // {
    //     return $this->belongsToMany(Item::class, 'user_items')->withPivot(
    //         [
    //             'quantity',
    //             'created_at',
    //             'updated_at',
    //             'deleted_at'
    //         ]
    //     );
    // }

    public function purchase_orders(): HasMany{
        return $this->hasMany(PurchaseOrder::class);
    }


    function isAdmin(): bool
    {
        return $this->is_admin == 1;
    }


    protected $fillable = ['username', 'email', 'first_name', 'last_name', 'is_admin', 'password', 'is_active'];
}
