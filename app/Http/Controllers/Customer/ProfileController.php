<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdatePasswordRequest;
use App\Http\Requests\Customer\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('customer.profile', [
            'user' => Auth::guard('web')->user(),
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        $user->update($request->validated());

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        $user->update(['password' => $request->string('password')->toString()]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
