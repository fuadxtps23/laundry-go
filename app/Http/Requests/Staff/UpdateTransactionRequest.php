<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'layanan_id' => ['required', Rule::exists('layanan', 'id')],
            'berat' => ['required', 'numeric', 'min:0.1', 'max:10000'],
            'tanggal_masuk' => ['required', 'date'],
            'tanggal_estimasi_selesai' => ['required', 'date', 'after_or_equal:tanggal_masuk'],
            'catatan' => ['nullable', 'string', 'max:1000'],
            'karyawan_id' => ['nullable', Rule::exists('karyawan', 'id')],
        ];
    }
}
