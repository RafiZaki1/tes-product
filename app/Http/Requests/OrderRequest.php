<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

      public function messages(): array
        {
            return [
            'product_id.required' => 'ID Produk wajib diisi, tidak boleh kosong.',
            'product_id.exists'   => 'Produk yang Anda pilih tidak terdaftar di database.',

            'quantity.required'   => 'Jumlah pesanan (quantity) wajib diisi.',
            'quantity.integer'    => 'Jumlah pesanan harus berupa angka bulat.',
            'quantity.min'        => 'Jumlah pesanan minimal adalah 1 pcs.',
            ];
}
}
