<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_layanan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:2000'],
            'harga_per_kg' => ['required', 'numeric', 'min:0', 'max:100000000'],
            'satuan' => ['required', Rule::in(['kg', 'pasang', 'potong', 'm2'])],
            'estimasi_hari' => ['required', 'integer', 'min:1', 'max:30'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
