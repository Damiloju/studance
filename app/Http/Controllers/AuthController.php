<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticateUser(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->rememberMe))
        {
            if(Auth::user()->isSuper() || Auth::user()->role == 3){
                return apiSuccess('User Correct', []);
            }

            return apiSuccess('User Correct', []);
        }

        return apiFailure('Username and password combination incorrect', [], 1);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function login()
    {
        return redirect()->route('home');
    }
}
