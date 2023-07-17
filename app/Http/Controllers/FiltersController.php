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

        $d_users =   d_user::Filter($query, $request)->paginate(10);

        return view('d_user.index')->with('d_users', $d_users)->with('filters', $request);
    }
}
