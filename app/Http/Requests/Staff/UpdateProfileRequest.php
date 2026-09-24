<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->user();
        $table = $this->isAdmin() ? 'admins' : 'karyawan';
        $ignore = $user?->getAuthIdentifier();

        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9._-]+$/i', Rule::unique($table, 'username')->ignore($ignore)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique($table, 'email')->ignore($ignore)],
            'no_hp' => ['required', 'string', 'max:30', 'regex:/^[0-9+() -]+$/', Rule::unique($table, 'no_hp')->ignore($ignore)],
            'posisi_jabatan' => [$this->isAdmin() ? 'nullable' : 'required', 'string', 'max:255'],
        ];
    }

    public function isAdmin(): bool
    {
        return auth()->getDefaultDriver() === 'admin';
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => strtolower(trim((string) $this->input('username'))),
            'email' => strtolower(trim((string) $this->input('email'))),
        ]);
    }
}
