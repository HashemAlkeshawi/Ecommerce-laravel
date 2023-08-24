<?php

namespace app\Http\Controllers\APiControllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthenticationRequest;
use Modules\User\App\Models\User;
use Illuminate\Http\Response;

class ApiLoginController extends Controller
{

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

        $token = $user->createToken('Access_Token')->accessToken;


        // $refresh_token = $user->createToken('token-refresh_token', ['refresh'], Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration')))->plainTextToken;
        // return $token;
        if ($authenticated) {

            return response()->json(['user' => $user, 'token' => $token], 200);
        }
        return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }


    public function refresh(Request $request)
    {
    }

    // Log out 
    public function logout(Request $request)
    {
        return;
    }
}
