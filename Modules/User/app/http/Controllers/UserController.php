<?php

namespace Modules\User\app\http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\App\Http\Requests\storeUserRequest;
use App\Http\Requests\FiltersRequest;
use App\Models\Address\Country;
use Modules\User\App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(FiltersRequest $request)
    {
        $query = User::query();

        $users =   User::filter($request->all(), $query)->paginate(10);
        $countries = Country::select('id', 'name')->get();

        return view('dashboard.user.index')->with('countries', $countries)->with('users', $users)->with('filters', $request);
    }


    public function create()
    {
        return view('dashboard.user.create');
    }


    public function store(storeUserRequest $request)
    {
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
        return view('dashboard.user.show')->with('user', $user);
    }


    public function edit(User $user)
    {
        return view('dashboard.user.edit')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => 'required|min:5',
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:3|max:15',
            'is_admin' => 'in:0,1',
            'is_active' => 'in:0,1',
        ];

        if ($request['username'] != $user->username) {
            $rules['username'] = 'required|unique:users';
        }
        $request->validate($rules);


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



    public function createEmail($user_id)
    {
        $user = User::findOrFail($user_id);
        $user_name = "$user->first_name $user->last_name";
        return view('dashboard.user.create_email', compact('user_name', 'user_id'));
    }

    public function email(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $type = $request['type'];
        switch ($type) {
            case 0:
                sendEmailtoUser($user);
                break;
            case 1:
                $rules = [
                    'subject' => 'required',
                    'content' => 'required'
                ];
                $request->validate($rules);
                sendCustomEmailtoUser($user, $request['subject'], $request['content']);
                break;
        }
        return redirect()->back()->with('messages', ["Email send successfully!"]);
    }
}
