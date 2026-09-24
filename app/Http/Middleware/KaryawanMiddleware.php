<?php

namespace App\Http\Middleware;

use App\Models\Karyawan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KaryawanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('karyawan');
        $user = $guard->user();

        if (! $user instanceof Karyawan || $user->role !== Karyawan::ROLE_KARYAWAN) {
            if ($user) {
                $guard->logout();
            }

            return redirect()->guest(route('karyawan.login'))
                ->with('error', 'Silakan masuk sebagai karyawan untuk mengakses area ini.');
        }

        Auth::shouldUse('karyawan');
        $request->setUserResolver(fn (): Karyawan => $user);

        return $next($request);
    }
}
