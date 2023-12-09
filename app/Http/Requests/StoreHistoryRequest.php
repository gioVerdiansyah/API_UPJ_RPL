<?php

namespace App\Http\Requests;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreHistoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|string',
            'jenis' => 'required|string',
            'harga_bahan' => 'required|numeric',
            'harga_jasa' => 'required|numeric',
            'tipe_pembayaran' => 'required|string',
            'jumlah_barang' => 'required|integer',
            'jumlah_bayar' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User ID harus diisi.',
            'user_id.string' => 'User ID harus berupa string.',
            'jenis.required' => 'Jenis harus diisi.',
            'jenis.string' => 'Jenis harus berupa teks.',
            'harga_bahan.required' => 'Harga bahan harus diisi.',
            'harga_bahan.numeric' => 'Harga bahan harus berupa angka.',
            'harga_jasa.required' => 'Harga jasa harus diisi.',
            'harga_jasa.numeric' => 'Harga jasa harus berupa angka.',
            'jumlah_bayar.required' => 'Harga jasa harus diisi.',
            'jumlah_barang.required' => 'Harga jasa harus diisi.',
            'jumlah_bayar.numeric' => 'Harga jasa harus berupa angka.',
            'jumlah_barang.integer' => 'Harga jasa harus berupa angka.',
            'tipe_pembayaran.required' => 'Tipe pembayaran harus diisi.',
            'tipe_pembayaran.string' => 'Tipe pembayaran harus berupa teks.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();

        $messages = [];
        $i = 0;
        foreach ($errors as $field => $errorMessages) {
            $formattedMessages = [];
            foreach ($errorMessages as $errorMessage) {
                $i++;
                $formattedMessages[] = $i . ". {$errorMessage}";
            }
            $messages[] = implode(', ', $formattedMessages);
        }

        $response = response()->json(['payment' => ['success' => false, 'message' => "Validasi Error: " . implode(', ', $messages)]], 422);

        throw new ValidationException($validator, $response);
    }
}
