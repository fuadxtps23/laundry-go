<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9._-]+$/i', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'no_hp' => ['required', 'string', 'max:30', 'regex:/^[0-9+() -]+$/', 'unique:users,no_hp'],
            'alamat' => ['required', 'string', 'max:1000'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => strtolower(trim((string) $this->input('username'))),
            'email' => strtolower(trim((string) $this->input('email'))),
        ]);
    }

    public function createUser(): User
    {
        return User::create($this->safe()->only([
            'nama_lengkap',
            'username',
            'email',
            'no_hp',
            'alamat',
            'password',
        ]));
    }
}
