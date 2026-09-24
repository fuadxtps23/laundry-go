<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function isAdmin(): bool
    {
        return auth()->getDefaultDriver() === 'admin';
    }

    public function rules(): array
    {
        return [
            'password_lama' => ['required', 'current_password:'.($this->isAdmin() ? 'admin' : 'karyawan')],
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }
}
