<?php

namespace App\Models\Dashboard;

use App\Http\Filters\Filter;
use App\Models\Address\Address;
use App\Models\Item\PurchaseOrder;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens;
    use SoftDeletes;
    use HasFactory;
    use Notifiable;


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

    public function purchase_orders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }


    function isAdmin(): bool
    {
        return $this->is_admin == 1;
    }


    // protected $fillable = ['username', 'email', 'first_name', 'last_name', 'is_admin', 'password', 'is_active'];
}
