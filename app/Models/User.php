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


class User extends Authenticatable 
{
    use SoftDeletes;
    use HasFactory;

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }



    public function scopeFilter(Builder $query,  FiltersRequest $request){
        $filters = [];
        if ($request->input('CountryFilter')) {
            array_push($filters, new CountryFilter());
        }
        if ($request->input('EmailFilter')) {
            array_push($filters, new EmailFilter());
        }
        if ($request->input('UsernameFilter')) {
            array_push($filters, new UsernameFilter());
        }
        if ($request->input('NameFilter')) {
            array_push($filters, new NameFilter());
        }

        if ($request->ActivationFilter == 1)  array_push($filters, new  ActivationFilter());
        if ($request->AdministrationFilter == 1) array_push($filters, new AdministrationFilter());

        Filter::apply($query, $request, $filters);

        
    }


   
    protected $fillable = ['username','email', 'first_name','last_name', 'is_admin', 'password', 'is_active'];

}
