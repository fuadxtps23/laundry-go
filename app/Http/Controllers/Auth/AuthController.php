<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        foreach ([
            'admin' => 'admin.dashboard',
            'karyawan' => 'karyawan.dashboard',
            'web' => 'customer.dashboard',
        ] as $guard => $dashboardRoute) {
            if (Auth::guard($guard)->check()) {
                return redirect()->route($dashboardRoute);
            }
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $login = Str::lower(trim((string) $request->string('login')));
        $password = $request->string('password')->toString();
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $remember = $request->boolean('remember');

        $admin = Admin::query()->where($field, $login)->first();
        if ($admin instanceof Admin && Hash::check($password, $admin->password)) {
            return $this->loginAs($request, 'admin', $admin, 'admin.dashboard', $remember);
        }

        $karyawan = Karyawan::query()->where($field, $login)->first();
        if ($karyawan instanceof Karyawan
            && $karyawan->role === Karyawan::ROLE_KARYAWAN
            && Hash::check($password, $karyawan->password)) {
            return $this->loginAs($request, 'karyawan', $karyawan, 'karyawan.dashboard', $remember);
        }

        $user = User::query()->where($field, $login)->first();
        if ($user instanceof User
            && $user->isCustomer()
            && Hash::check($password, $user->password)) {
            return $this->loginAs($request, 'web', $user, 'customer.dashboard', $remember);
        }

        return back()
            ->withInput($request->only('login'))
            ->withErrors(['login' => 'Username/email atau password salah.']);
    }

    public function logout(Request $request): RedirectResponse
    {
        foreach (['web', 'karyawan', 'admin'] as $guard) {
            Auth::guard($guard)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah keluar.');
    }

    private function loginAs(Request $request, string $guard, Authenticatable $user, string $dashboardRoute, bool $remember): RedirectResponse
    {
        foreach (['web', 'karyawan', 'admin'] as $existingGuard) {
            Auth::guard($existingGuard)->logout();
        }

        Auth::guard($guard)->login($user, $remember);
        $request->session()->regenerate();

        return redirect()->route($dashboardRoute);
    }
}
