<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\UpdatePasswordRequest;
use App\Http\Requests\Staff\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends StaffController
{
    public function edit(): View
    {
        return $this->staffView('staff.profiles.edit', [
            'user' => $this->currentUser(),
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $user = $this->currentUser();
        $data = $request->safe()->only(['nama_lengkap', 'username', 'email', 'no_hp', 'posisi_jabatan']);
        $user->update(array_filter($data, fn (mixed $value): bool => $value !== null && $value !== ''));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $user = $this->currentUser();
        $user->update(['password' => $request->string('password')->toString()]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
