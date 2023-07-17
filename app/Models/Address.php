<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    use HasFactory;


    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
    public function vendor():HasOne{
        return $this->hasOne(Vendor::class, 'addressable_id');
    }
    public function d_user():HasOne{
        return $this->hasOne(d_user::class, 'addressable_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
