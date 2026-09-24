<?php

namespace App\Http\Requests\Customer;

use App\Enums\PaymentMethod;
use App\Models\Transaksi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'metode' => ['required', Rule::in(PaymentMethod::values())],
            'jumlah_bayar' => ['required', 'numeric', 'min:0.01'],
            'bukti_pembayaran' => [
                Rule::requiredIf(fn (): bool => in_array($this->input('metode'), [PaymentMethod::Qris->value, PaymentMethod::Transfer->value], true)),
                'nullable',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $transaction = $this->route('transaksi');

                if (! $transaction instanceof Transaksi || $validator->errors()->hasAny(['metode', 'jumlah_bayar'])) {
                    return;
                }

                if ((float) $this->input('jumlah_bayar') < (float) $transaction->total_harga) {
                    $validator->errors()->add('jumlah_bayar', 'Jumlah bayar tidak boleh kurang dari total tagihan.');
                }
            },
        ];
    }
}
