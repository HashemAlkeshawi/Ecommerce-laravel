<?php

namespace App\Http\Controllers;

use App\Http\Filters\ActivationFilter;
use App\Http\Filters\AdministrationFilter;
use App\Http\Filters\EmailFilter;
use App\Http\Filters\NameFilter;
use App\Http\Filters\UsernameFilter;
use App\Http\Requests\FiltersRequest;
use App\Models\d_user;
use Illuminate\Http\Request;

class FiltersController extends Controller
{
    //
    public function index(FiltersRequest $request)
    {
        $query = d_user::query();   

        $filters = [];
        if ($request->input('EmailFilter')) {
            array_push($filters,  EmailFilter::class);
        }
        if ($request->input('UsernameFilter')) {
            array_push($filters, UsernameFilter::class);
        }
        if ($request->input('NameFilter')) {
            array_push($filters,  NameFilter::class);
        }

        if ($request->ActivationFilter == 1)  array_push($filters,  ActivationFilter::class);
        if ($request->AdministrationFilter == 1) array_push($filters,  AdministrationFilter::class);


        foreach($filters as $filter){
            $filterPathArray = explode('\\', $filter);
            $filterName = end($filterPathArray);
            app($filter)->filter($query, $request[$filterName]);
        }


   
        $d_users = $query->paginate(4);
        return view('d_user.index')->with('d_users', $d_users)->with('filters', $request);
    }
}
