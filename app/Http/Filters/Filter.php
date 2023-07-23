<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\FiltersRequest;
use Illuminate\Http\Request;

abstract class Filter
{
    public abstract function filter(Builder $query, String $queryParam);

    public static function apply(Builder $query, Request $request)
    {
        $filters = [];
        if ($request->input('NameFilter')) {
            array_push($filters, new NameFilter());
        }
        if ($request->input('IdFilter')) {
            array_push($filters, new IdFilter());
        }
        if ($request->input('BrandIdFilter')) {
            array_push($filters, new BrandIdFilter());
        }
        if ($request->input('EmailFilter')) {
            array_push($filters, new EmailFilter());
        }

        if ($request->input('PhoneFilter')) {
            array_push($filters, new PhoneFilter());
        }
        if ($request->input('ItemNameFilter')) {
            array_push($filters, new ItemNameFilter());
        }

        if ($request->input('CountryFilter')) {
            array_push($filters, new CountryFilter());
        }

        if ($request->input('UsernameFilter')) {
            array_push($filters, new UsernameFilter());
        }

        if ($request->ActivationFilter !=null)  array_push($filters, new  ActivationFilter());
        if ($request->AdministrationFilter == 1) array_push($filters, new AdministrationFilter());

        foreach ($filters as $filter) {
            $filter->filter($query, $request[class_basename($filter)]);
        }
    }
}
