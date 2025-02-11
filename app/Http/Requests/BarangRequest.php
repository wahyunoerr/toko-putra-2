<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'stok' => 'required|integer',
            'hargaBeli' => 'required|numeric',
            'hargaJual' => 'required|numeric',
            'jenis_id' => 'required|exists:jenis_barangs,id',
            'satuan_id' => 'required|exists:satuan_barangs,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama barang wajib diisi.',
            'name.string' => 'Nama barang harus berupa teks.',
            'name.max' => 'Nama barang maksimal 100 karakter.',
            'stok.required' => 'Stok barang wajib diisi.',
            'stok.integer' => 'Stok barang harus berupa angka.',
            'hargaBeli.required' => 'Harga beli barang wajib diisi.',
            'hargaBeli.numeric' => 'Harga beli barang harus berupa angka.',
            'hargaJual.required' => 'Harga jual barang wajib diisi.',
            'hargaJual.numeric' => 'Harga jual barang harus berupa angka.',
            'jenis_id.required' => 'Jenis barang wajib dipilih.',
            'jenis_id.exists' => 'Jenis barang tidak valid.',
            'satuan_id.required' => 'Satuan barang wajib dipilih.',
            'satuan_id.exists' => 'Satuan barang tidak valid.',
            'supplier_id.required' => 'Supplier barang wajib dipilih.',
            'supplier_id.exists' => 'Supplier barang tidak valid.',
        ];
    }
}
