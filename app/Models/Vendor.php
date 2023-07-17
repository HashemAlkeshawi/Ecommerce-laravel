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
use App\Http\Filters\EmailFilter;
use App\Http\Filters\PhoneFilter;
use App\Http\Filters\Filter;



class Vendor extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function scopeFilter(Builder $query, $request)
    {
        $filters = [];
        if ($request->input('EmailFilter')) {
            array_push($filters, new EmailFilter());
        }
        if ($request->input('PhoneFilter')) {
            array_push($filters, new PhoneFilter());
        }
        if ($request->input('NameFilter')) {
            array_push($filters, new NameFilter());
        }
        if ($request->ActivationFilter == 1)  array_push($filters, new  ActivationFilter());



        Filter::apply($query, $request, $filters);
    }



    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
