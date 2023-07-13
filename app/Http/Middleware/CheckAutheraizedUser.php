<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAutheraizedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($next);
        // dd($request->route()->getActionMethod());
        if (!Auth::check() || (Auth::user()->is_admin == 1 && $request->route()->getActionMethod() == "create"))
            return $next($request);

        return redirect('/')->with('error', 'You are already logged in!');
    }
}
