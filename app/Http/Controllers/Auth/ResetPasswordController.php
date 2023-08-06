<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use Illuminate\Http\Request;
use App\Models\Dashboard\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{


    // Login view
    public function index()
    {
        return view('auth.reset_password');
    }

    public function setResetCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $reset_code = rand(10000, 99999);
            DB::table('password_reset_codes')->insert([
                'user_id' => $user->id,
                'reset_code' => $reset_code,
                'created_at' => now(),
            ]);
            Mail::to($user)->send(new ResetPasswordEmail($user->username, $reset_code));
            return view("auth.enter_code")->with('user_id', $user->id);
        } else {
            return redirect()->back()->with('messages', ['Email Not found']);
        }
    }

    public function resetPassword(Request $request)
    {
        $reset_code = $request->reset_code;
        $user_reset_code = DB::table('password_reset_codes')->where('user_id', $request->user_id)->where('reset_code', $reset_code)->first();
        // $user_reset_code->created_at 
        if ($user_reset_code) {
        } else {
            return redirect()->back()->with('messages', ['The code you provided is not correct']);
        }
    }
}
