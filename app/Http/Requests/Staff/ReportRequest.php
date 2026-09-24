<?php

namespace App\Http\Requests\Staff;

use App\Enums\LaundryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'period' => ['nullable', Rule::in(['harian', 'mingguan', 'bulanan'])],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in(LaundryStatus::values())],
            'format' => ['nullable', Rule::in(['csv', 'pdf'])],
        ];
    }
}
