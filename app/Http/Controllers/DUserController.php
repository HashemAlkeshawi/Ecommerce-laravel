<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Models\d_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DUserController extends Controller
{

    public function index()
    {
        $d_user = d_user::OrderBy('id', 'desc')->where('is_admin', "!=", 1)->paginate(4);
        return view('d_user.index')->with('d_users', $d_user);
    }


    public function create()
    {
        return view('d_user.create');
    }


    public function store(storeUserRequest $request)
    {
        $validated = $request->validated();
        // dd($request);
        // dd($validated);
        /***
         $table->string('username');
         $table->string('email');
         $table->string('first_name', 20);
         $table->string('last_name', 20);
         $table->boolean('is_admin')->default(0);
         $table->boolean('is_active')->default(1);
         $table->string('password');
         */
        $d_user = new d_user;

        $d_user->username = $request['username'];
        $d_user->email = $request['email'];
        $d_user->first_name = $request['first_name'];
        $d_user->last_name = $request['last_name'];
        $d_user->is_admin = $request['is_admin'] == '1' ? 1 : 0;
        $d_user->password =  Hash::make($request['password']);

        $d_user->save();

        if (Auth::check() && Auth::user()->is_admin != 1) {
            Auth::login($d_user);
        }

        return redirect('/d_user');
    }

    public function show(d_user $d_user)
    {
    }


    public function edit(d_user $d_user)
    {
        return view('d_user.edit')->with('d_user', $d_user);
    }

    public function update(updateUserRequest $request, d_user $d_user)
    {
        $validated = $request->validated();
        // dd($request);
        // dd($validated);
        /***
         $table->string('username');
         $table->string('email');
         $table->string('first_name', 20);
         $table->string('last_name', 20);
         $table->boolean('is_admin')->default(0);
         $table->boolean('is_active')->default(1);
         $table->string('password');
         */
        // dd($request['username']);

        $d_user->update(
            [
                'username' => $request['username'],
                'email' => $request['email'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'is_admin' => $request['is_admin'],
                'is_active' => $request['is_active'] == '1' ? 0 : 1,
                'is_admin' => $request['is_admin'] == '1' ? 1 : 0

            ]
        );


        return redirect('/d_user');
    }


    public function destroy(d_user $d_user)
    {
        $d_user->delete();

        return redirect('/d_user');
    }
}
