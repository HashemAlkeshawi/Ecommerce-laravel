<?php

namespace App\Http\Controllers;

use App\Http\Filters\ActivationFilter;
use App\Http\Filters\AdministrationFilter;
use App\Http\Filters\EmailFilter;
use App\Http\Filters\Filter;
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


        $d_users = $query->paginate(4);
        return view('d_user.index')->with('d_users', $d_users)->with('filters', $request);
    }
}
