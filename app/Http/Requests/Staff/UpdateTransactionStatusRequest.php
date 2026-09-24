<?php

namespace App\Http\Requests\Staff;

use App\Enums\LaundryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransactionStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status_laundry' => ['required', Rule::in(LaundryStatus::values())],
        ];
    }
}
