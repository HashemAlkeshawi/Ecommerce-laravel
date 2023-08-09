<?php

namespace App\Http\Controllers\APiControllers\Auth;

use App\Events\UserAuthLogEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\Dashboard\storeUserRequest;
use App\Models\Dashboard\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function store(storeUserRequest $request)
    {
        // $request->validated();
        $user = new User;
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->is_admin = $request['is_admin'] == '1' ? 1 : 0;
        $user->password =  Hash::make($request['password']);

        $user->save();

        return response()->json($user);
        // return redirect('api/user/login');
    }

    public function login(AuthenticationRequest $request)
    {



        $authenticated = Auth::attempt(
            [
                'email' => $request['email'],
                'password' => $request['password']
            ],
            $request['remember_me'] == "1"
        );
        $user = User::where('email', $request['email'])->first();
        $token = $user->createToken('token-name', ['*'], Carbon::now()->addMinutes())->plainTextToken;
        // return $token;
        if ($authenticated) {

            return response()->json(['user' => $user, 'token' => $token], 200);
        }
        return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }


    // Log out 
    public function logout(Request $request)
    {
        return;
    }
}
