<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
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
            'barang_id' => 'required|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
