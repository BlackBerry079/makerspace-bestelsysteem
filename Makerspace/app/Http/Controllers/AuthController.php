<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

        $user = User::query()
            ->where('email', $request->email)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Ongeldige gebruikersnaam of wachtwoord.',
            ]);
        }

        $request->session()->regenerate();

        $request->session()->put('auth_user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $redirectTo = $request->input('redirect');
        if (! is_string($redirectTo) || ! str_starts_with($redirectTo, '/')) {
            $redirectTo = route('home');
        }

        return redirect()
            ->to($redirectTo)
            ->with('success', 'Inloggen gelukt.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user,name',
            'email' => 'required|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required|string',
        ]);

        $roleId = DB::table('role')->orderBy('id')->value('id');
        if (! $roleId) {
            $roleId = DB::table('role')->insertGetId([
                'name' => 'student',
            ]);
        }

        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => true,
            'role_id' => $roleId,
        ]);

        return redirect()
            ->route('auth.login')
            ->with('success', 'Account succesvol aangemaakt.');
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
