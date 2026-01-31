<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all authenticated users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'layanan_id' => 'required|exists:layanan,layanan_id',
            'special_offer_id' => 'nullable|exists:special_offers,id',
            'jumlah_peserta' => 'required|integer|min:1|max:50',
            'tanggal_keberangkatan' => 'required|date|after:today',
            'catatan_khusus' => 'nullable|string|max:1000',
            'customer_name' => 'nullable|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'customer_address' => 'nullable|string|max:1000'
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'layanan_id.required' => 'Paket wisata wajib dipilih.',
            'layanan_id.exists' => 'Paket wisata tidak ditemukan.',
            'jumlah_peserta.required' => 'Jumlah peserta wajib diisi.',
            'jumlah_peserta.min' => 'Jumlah peserta minimal 1 orang.',
            'jumlah_peserta.max' => 'Jumlah peserta maksimal 50 orang.',
            'tanggal_keberangkatan.required' => 'Tanggal keberangkatan wajib diisi.',
            'tanggal_keberangkatan.after' => 'Tanggal keberangkatan harus setelah hari ini.',
            'customer_email.email' => 'Format email tidak valid.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'tanggal_keberangkatan' => 'tanggal keberangkatan',
            'jumlah_peserta' => 'jumlah peserta',
            'catatan_khusus' => 'catatan khusus',
        ];
    }
}
