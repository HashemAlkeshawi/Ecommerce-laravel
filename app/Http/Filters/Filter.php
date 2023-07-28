<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    public abstract function filter(Builder $query, String $queryParam);

    public static function apply(Builder $query,  $filters)
    {


        $available_filters = [
            'NameFilter' => NameFilter::class,
            'IdFilter' => IdFilter::class,
            'BrandIdFilter' => BrandIdFilter::class,
            'EmailFilter' => EmailFilter::class,
            'PhoneFilter' => PhoneFilter::class,
            'ItemNameFilter' => ItemNameFilter::class,
            'AddressCountryFilter' => AddressCountryFilter::class,
            'ItemInventoryFilter' => ItemInventoryFilter::class,
            'ItemVendorFilter' => ItemVendorFilter::class,
            'UsernameFilter' => UsernameFilter::class,
            'ActivationFilter' => ActivationFilter::class,
            'ItemQuantityFilter' => ItemQuantityFilter::class,
            'MaxQuantityInventoryFilter' => MaxQuantityInventoryFilter::class,
        ];

        foreach ($filters as $filter_name => $value) {
            if (!isset($available_filters[$filter_name]) || $value == null)
                continue;
            $filter_object = app($available_filters[$filter_name]);
            $filter_object->filter($query, $value);
        }
    }
}
