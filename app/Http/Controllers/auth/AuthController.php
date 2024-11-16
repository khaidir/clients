<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Key unik untuk rate limiting berdasarkan IP dan email
        $rateLimiterKey = $request->ip() . '|' . $request->email;

        // Cek apakah pengguna telah melebihi batas percobaan
        if (RateLimiter::tooManyAttempts($rateLimiterKey, 10)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            return response()->json([
                'message' => "Too many login attempts. Please try again in {$seconds} seconds."
            ], 429);
        }

        RateLimiter::hit($rateLimiterKey, 60);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            RateLimiter::clear($rateLimiterKey);
            $user = Auth::user();

            if ($user->hasRole('company')) {
                return redirect()->route('public.dashboard');
            } else {
                // Arahkan pengguna lainnya ke dashboard
                return redirect()->intended('/');
            }

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect ke halaman login
    }
}
