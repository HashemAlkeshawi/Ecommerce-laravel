<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthenticationRequest;

class LoginController extends Controller
{
    public function authenticate(AuthenticationRequest $request)
    {
        $validated = $request->validated();
        $authenticated = Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ]);
        if ($authenticated) {
            $request->session()->regenerate();

            return redirect('/home')->with('user', Auth::user());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

        // if (Auth::attempt([
        //     'email' => $request['email'],
        //     'password' => $request['password']
        //     ])) {
        //     dd('somthing');
        //     $request->session()->regenerate();

        //     return redirect('/home');
        // }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }

    // Login view
    public function login()  {
        return view('auth.login')   ;     
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
