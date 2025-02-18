<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|string|min:2',
            'phone' => 'required|string|min:12'
        ];
    }

    function messages()
    {
        return [
            'name.required' => 'Nama wajib di isi',
            'name.string' => 'Nama Berupa karakter',
            'name.min' => 'minimal 2 karakter',
            'phone.required' => 'nomor telpon wajib diisi',
            'phone.string' => 'Phone must be a string',
            'phone.min' => 'Nomor telepon minimal 12 angka'
        ];
    }
}
