<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('admin');
        $user = $guard->user();

        if (! $user instanceof Admin) {
            if ($user) {
                $guard->logout();
            }

            return redirect()->guest(route('admin.login'))
                ->with('error', 'Silakan masuk sebagai admin untuk mengakses area ini.');
        }

        Auth::shouldUse('admin');
        $request->setUserResolver(fn (): Admin => $user);

        return $next($request);
    }
}
