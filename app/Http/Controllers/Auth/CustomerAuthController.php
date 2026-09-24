<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CustomerAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('customer.dashboard');
        }

        return view('auth.customer-login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $login = Str::lower(trim((string) $request->string('login')));
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::guard('web')->attempt([
            $field => $login,
            'password' => $request->string('password')->toString(),
            'role' => User::ROLE_PELANGGAN,
        ], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'Username/email atau password tidak cocok.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('customer.dashboard');
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('customer.dashboard');
        }

        return view('auth.customer-register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $request->createUser();
        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return redirect()->route('customer.dashboard')
            ->with('success', 'Selamat datang di Laundry Go, '.$user->nama_lengkap.'!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        if (Auth::guard('karyawan')->check() || Auth::guard('admin')->check()) {
            $request->session()->regenerate();
        } else {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('login')->with('success', 'Anda telah keluar.');
    }
}
