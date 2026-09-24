<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('staff.auth.admin-login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $login = Str::lower(trim((string) $request->string('login')));
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::guard('admin')->attempt([
            $field => $login,
            'password' => $request->string('password')->toString(),
        ], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'Username/email atau password tidak cocok.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        if (Auth::guard('web')->check() || Auth::guard('karyawan')->check()) {
            $request->session()->regenerate();
        } else {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('admin.login')->with('success', 'Anda telah keluar.');
    }
}
