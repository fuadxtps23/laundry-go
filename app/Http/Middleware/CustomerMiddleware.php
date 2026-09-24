<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('web');
        $user = $guard->user();

        if (! $user instanceof User || ! $user->isCustomer()) {
            if ($user) {
                $guard->logout();
            }

            return redirect()->guest(route('login'))
                ->with('error', 'Silakan login menggunakan akun pelanggan.');
        }

        Auth::shouldUse('web');
        $request->setUserResolver(fn (): User => $user);

        return $next($request);
    }
}
