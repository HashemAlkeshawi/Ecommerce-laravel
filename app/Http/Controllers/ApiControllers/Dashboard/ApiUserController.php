<?php

namespace App\Http\Controllers\ApiControllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\storeUserRequest;
use App\Http\Requests\FiltersRequest;
use App\Http\Resources\UserResource;
use App\Models\Address\Country;
use App\Models\Dashboard\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApiUserController extends Controller
{

    public function index(FiltersRequest $request)
    {
        $query = User::query();

        $users =   User::filter($request->all(), $query)->with('address')->paginate(10);

        return   UserResource::collection($users->items());
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

        return response()->json([
            "name" => "$user->first_name $user->last_name",
            "address" => $user->address,
        ]);
    }


    public function show(User $user)
    {
        return  new UserResource($user);
    }


    public function update(Request $request, User $user)
    {
        $rules = [

            'email' => 'unique:users',
            'username' => 'unique:users|min:5',
            'first_name' => 'min:3|max:20',
            'last_name' => 'min:3|max:20',
            'is_admin' => 'in:0,1',
            'is_active' => 'in:0,1',

        ];

        try {
            if ($request->validate($rules)) {
                $user->update($request->all());
                $user->save();
                return  response()->json(['updated user id' => $user->id], 200);
            } else {
                return  response()->json(['message' => 'Error while tying to update user '], 400);
            }

            // Process the validated data and return a response
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    public function destroy(User $user)
    {
        return  $user->delete();
    }
}
