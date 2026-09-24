<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'layanan_id' => ['required', Rule::exists('layanan', 'id')->where('is_active', true)],
            'berat' => ['required', 'numeric', 'min:0.1', 'max:10000'],
            'tanggal_masuk' => ['required', 'date', 'before_or_equal:today'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
