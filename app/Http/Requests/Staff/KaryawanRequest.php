<?php

namespace App\Http\Requests\Staff;

use App\Models\Karyawan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class KaryawanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employee = $this->route('karyawan');

        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9._-]+$/i', Rule::unique('karyawan', 'username')->ignore($employee instanceof Karyawan ? $employee->id : null)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('karyawan', 'email')->ignore($employee instanceof Karyawan ? $employee->id : null)],
            'no_hp' => ['required', 'string', 'max:30', 'regex:/^[0-9+() -]+$/', Rule::unique('karyawan', 'no_hp')->ignore($employee instanceof Karyawan ? $employee->id : null)],
            'posisi_jabatan' => 'required|in:Operator Cuci,Operator Setrika,Operator Packing,Operator Cuci & Lipat,Kurir,Kasir,Supervisor',
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
