<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomerAuthController extends Controller
{
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
}
