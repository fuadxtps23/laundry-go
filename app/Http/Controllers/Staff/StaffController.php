<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

abstract class StaffController extends Controller
{
    protected function role(): string
    {
        return Auth::getDefaultDriver() === 'admin' ? 'admin' : 'karyawan';
    }

    protected function currentUser(): Karyawan|Admin
    {
        $user = Auth::guard($this->role())->user();

        abort_unless($user instanceof Karyawan || $user instanceof Admin, 403);

        return $user;
    }

    protected function staffView(string $view, array $data = []): View
    {
        return view($view, array_merge(['role' => $this->role(), 'staffUser' => $this->currentUser()], $data));
    }
}
