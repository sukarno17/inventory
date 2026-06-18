<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
<<<<<<< HEAD
=======
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
<<<<<<< HEAD
    { 
        return true; // Ubah menjadi true agar request diizinkan
=======
    {
        return true;
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama item wajib diisi.',
<<<<<<< HEAD
            'quantity.integer' => 'Jumlah harus berupa angka bulat.',
            'quantity.min' => 'Jumlah minimal adalah 0.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal adalah 0.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
        ];
    }
=======
            'quantity.required' => 'Quantity wajib diisi.',
            'quantity.integer' => 'Quantity harus berupa angka bulat.',
            'quantity.min' => 'The quantity field must be at least 0.',
            'price.required' => 'Price wajib diisi.',
            'price.numeric' => 'Price harus berupa angka.',
            'price.min' => 'The price field must be at least 0.',
            'category_id.required' => 'Category wajib diisi.',
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
    protected function prepareForValidation() {
        $input = $this->all();

        array_walk($input, function (&$val) {
            if (is_string($val)) {
                $val = trim(strip_tags($val));
            }
        });

        $this->merge($input); 
    }
>>>>>>> 1b222980c6ed6bd6c754b3ea762dfe7c271a7d81
}