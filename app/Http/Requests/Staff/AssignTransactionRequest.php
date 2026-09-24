<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'karyawan_id' => ['required', Rule::exists('karyawan', 'id')],
        ];
    }
}
