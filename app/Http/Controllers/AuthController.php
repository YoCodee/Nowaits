<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'], // Input name is password
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', Rule::in(['farmer', 'mitra'])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Map role input to database enum
        $peranMap = [
            'farmer' => 'petani',
            'mitra' => 'mitra',
        ];

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'sandi' => Hash::make($validated['password']),
            'peran' => $peranMap[$validated['role']],
        ]);

        // Do not auto-login after registration. Redirect user to login page
        // so the session is created only after a successful login.
        return redirect()->route('login')->with('status', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
