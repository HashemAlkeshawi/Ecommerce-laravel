<?php

namespace App\Http\Filters;

use App\Http\Filters\Address\AddressCountryFilter;
use App\Http\Filters\Address\CountryFilter;
use App\Http\Filters\Dashboard\AdministrationFilter;
use App\Http\Filters\Dashboard\EmailFilter;
use App\Http\Filters\Dashboard\IdFilter;
use App\Http\Filters\Dashboard\NameFilter;
use App\Http\Filters\Dashboard\PhoneFilter;
use App\Http\Filters\Dashboard\UsernameFilter;
use App\Http\Filters\Item\ActivationFilter;
use App\Http\Filters\Item\BrandIdFilter;
use App\Http\Filters\Item\ItemInventoryFilter;
use App\Http\Filters\Item\ItemNameFilter;
use App\Http\Filters\Item\ItemQuantityFilter;
use App\Http\Filters\Item\ItemsMaxPriceFilter;
use App\Http\Filters\Item\ItemVendorFilter;
use App\Http\Filters\Item\MaxQuantityInventoryFilter;
use Illuminate\Database\Eloquent\Builder;




abstract class Filter
{
    public abstract function filter(Builder $query, String $queryParam);

    public static function apply(Builder $query,  $filters)
    {

        $available_filters = [
            'NameFilter' => NameFilter::class,
            'CountryFiler' => CountryFilter::class,
            'IdFilter' => IdFilter::class,
            'BrandIdFilter' => BrandIdFilter::class,
            'EmailFilter' => EmailFilter::class,
            'PhoneFilter' => PhoneFilter::class,
            'ItemNameFilter' => ItemNameFilter::class,
            'AddressCountryFilter' => AddressCountryFilter::class,
            'ItemInventoryFilter' => ItemInventoryFilter::class,
            'ItemVendorFilter' => ItemVendorFilter::class,
            'AdministrationFilter' => AdministrationFilter::class,
            'UsernameFilter' => UsernameFilter::class,
            'ActivationFilter' => ActivationFilter::class,
            'ItemQuantityFilter' => ItemQuantityFilter::class,
            'MaxQuantityInventoryFilter' => MaxQuantityInventoryFilter::class,
            'ItemsMaxPriceFilter' => ItemsMaxPriceFilter::class,
        ];
        
        foreach ($filters as $filter_name => $value) {
            if (!isset($available_filters[$filter_name]) || $value == null)
            continue;
            $filter_object = app($available_filters[$filter_name]);
            $filter_object->filter($query, $value);
        }
    }
}
