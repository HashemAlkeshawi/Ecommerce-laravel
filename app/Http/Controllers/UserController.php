<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiltersRequest;
use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(FiltersRequest $request)
    { 
            $query = User::query();

            $users =   User::filter($request, $query)->paginate(10);
            $countries = Country::get();

            return view('user.index')->with('countries', $countries)->with('users', $users)->with('filters', $request);
        
    }


    public function create()
    {
        return view('user.create');
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
        $user = new User;

        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->is_admin = $request['is_admin'] == '1' ? 1 : 0;
        $user->password =  Hash::make($request['password']);

        $user->save();

        if (!Auth::check()) {
            Auth::login($user, false);
        }

        return redirect('/user');
    }

    public function show(User $user)
    {
        return view('user.show')->with('user', $user);


    }


    public function edit(User $user)
    {
        return view('user.edit')->with('user', $user);
    }

    public function update(updateUserRequest $request, User $user)
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

        $user->update(
            [
                'username' => $request['username'],
                'email' => $request['email'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'is_admin' => $request['is_admin'],
                'is_active' => $request['is_active'] == '1' ? 0 : 1,
                'is_admin' => $user->is_admin,

            ]
        );


        return redirect('/user');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/user');
    }
}
