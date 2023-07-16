<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiltersRequest;
use App\Models\d_user;
use Illuminate\Http\Request;

class FiltersController extends Controller
{
    //
    public function index(FiltersRequest $request)
    {

        $query = d_user::query();
        switch ($request->filter_by) {
            case "email":
                $query->where('email', 'like',  '%' . $request->email . '%');
                // dd($query->paginate(4));

                break;
            case "username":
                $query->where('username', 'like',  '%' . $request->username . '%');

                break;
            case "name":
                $query->where('first_name', 'like',  '%' . explode(' ',$request->name)[0])->where('last_name', 'like',  '%' . explode(' ',$request->name)[1]);

                break;
        }

        // if ($request['username']) {
        $d_users = $query->paginate(4);
        return view('d_user.index')->with('d_users', $d_users);
        // }   
        //  return view('d_user.index');

    }
}
