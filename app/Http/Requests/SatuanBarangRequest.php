<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SatuanBarangRequest extends FormRequest
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
            'nama' => 'required|string|min:2'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.string' => 'Nama berupa karakter.',
            'nama.min' => 'Minimal 2 karakter'
        ];
    }
}
