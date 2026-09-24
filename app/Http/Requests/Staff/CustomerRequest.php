<?php

namespace App\Http\Requests\Staff;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customer = $this->route('user');

        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9._-]+$/i', Rule::unique('users', 'username')->ignore($customer instanceof User ? $customer->id : null)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($customer instanceof User ? $customer->id : null)],
            'no_hp' => ['required', 'string', 'max:30', 'regex:/^[0-9+() -]+$/', Rule::unique('users', 'no_hp')->ignore($customer instanceof User ? $customer->id : null)],
            'alamat' => ['required', 'string', 'max:1000'],
            'password' => [$this->isMethod('post') ? 'required' : 'nullable', 'confirmed', Password::min(8)],
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
