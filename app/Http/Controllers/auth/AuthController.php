<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;
use DB;

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

        $rateLimiterKey = $request->ip() . '|' . $request->email;

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

            if ($user->hasRole('company') == true) {
                return redirect()->route('public.dashboard');
            } else {
                return redirect()->intended('/dashboard');
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

    public function register_form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'position' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $input = $request->all();
            $input['company_id'] = 0;

            if (isset($input['password']) && !empty($input['password'] AND ($input['password'] && $input['password_confirm']))) {
                $input['password'] = Hash::make($input['password']);
            } else {
                unset($input['password']);
            }

            $user = User::create($input);

            $validRoles = Role::where('id', 10)->pluck('id')->toArray();
            $user->syncRoles($validRoles);

            DB::commit();
            return redirect()->route('login')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.dashboard')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.dashboard')->with(['error' => @$e->getMessage()]);
        }

    }
}
