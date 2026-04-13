<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPageController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        return redirect()
            ->route('auth.login')
            ->with('success', 'Inloggen gelukt (demo).');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required|string',
        ]);

        return redirect()
            ->route('auth.register')
            ->with('success', 'Registratie gelukt (demo).');
    }
}
