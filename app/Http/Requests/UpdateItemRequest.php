<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama item wajib diisi jika kolom ini dikirim.',
            'quantity.required' => 'Quantity wajib diisi jika kolom ini dikirim.',
            'quantity.integer' => 'Quantity harus berupa angka bulat.',
            'quantity.min' => 'The quantity field must be at least 0.',
            'price.required' => 'Price wajib diisi jika kolom ini dikirim.',
            'price.numeric' => 'Price harus berupa angka.',
            'price.min' => 'The price field must be at least 0.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $validator->errors()->first()
            ], 400)
        );
    }
}