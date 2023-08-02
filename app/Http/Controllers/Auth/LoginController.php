<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserAuthLogEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthenticationRequest;

class LoginController extends Controller
{
    public function authenticate(AuthenticationRequest $request)
    {
        $validated = $request->validated();
        $authenticated = Auth::attempt(
            [
                'email' => $request['email'],
                'password' => $request['password']
            ],
            $request['remember_me'] == "1"
        );
        if ($authenticated) {
            // Here to fire the event...
            $request->session()->regenerate();
            event(new UserAuthLogEvent(Auth::user()));

            return redirect('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Login view
    public function login()
    {
        return view('auth.login');
    }

    // Log out 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
