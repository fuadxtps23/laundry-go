<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $user = $this->user();

        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9._-]+$/i', Rule::unique('users', 'username')->ignore($user?->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'no_hp' => ['required', 'string', 'max:30', 'regex:/^[0-9+() -]+$/', Rule::unique('users', 'no_hp')->ignore($user?->id)],
            'alamat' => ['required', 'string', 'max:1000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => strtolower(trim((string) $this->input('username'))),
            'email' => strtolower(trim((string) $this->input('email'))),
        ]);
    }
}
