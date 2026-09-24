<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Karyawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class KaryawanAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('karyawan')->check()) {
            return redirect()->route('karyawan.dashboard');
        }

        return view('staff.auth.karyawan-login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $login = Str::lower(trim((string) $request->string('login')));
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! Auth::guard('karyawan')->attempt([
            $field => $login,
            'password' => $request->string('password')->toString(),
            'role' => Karyawan::ROLE_KARYAWAN,
        ], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => 'Username/email atau password tidak cocok.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('karyawan.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('karyawan')->logout();

        if (Auth::guard('web')->check() || Auth::guard('admin')->check()) {
            $request->session()->regenerate();
        } else {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('karyawan.login')->with('success', 'Anda telah keluar.');
    }
}
