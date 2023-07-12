<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLogin extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect('home');
        }
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $remember = $request->has('remember-me') ? true : false;
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            return redirect('home');
        }
    }
}
