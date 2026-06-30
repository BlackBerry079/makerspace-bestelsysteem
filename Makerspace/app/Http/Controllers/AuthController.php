<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        return view('auth.login', [
            'redirect' => $request->query('redirect', route('home')),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = DB::table('user')
            ->select('id', 'name', 'email')
            ->where('email', $request->email)
            ->first();

        $displayName = $user?->name ?: explode('@', $request->email)[0];

        $request->session()->put('auth_user', [
            'id' => $user?->id,
            'name' => $displayName,
            'email' => $request->email,
        ]);

        $redirectTo = $request->input('redirect');
        if (! is_string($redirectTo) || ! str_starts_with($redirectTo, '/')) {
            $redirectTo = route('home');
        }

        return redirect()
            ->to($redirectTo)
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

    public function logout(Request $request)
    {
        $request->session()->forget('auth_user');
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Je bent uitgelogd.');
    }
}
