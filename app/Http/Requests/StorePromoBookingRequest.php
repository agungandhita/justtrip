<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromoBookingRequest extends FormRequest
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
            'special_offer_id' => 'required|exists:special_offers,id',
            'layanan_id' => 'nullable|exists:layanan,layanan_id',
            'tanggal_keberangkatan' => 'required|date|after_or_equal:today',
            'jumlah_peserta' => 'required|integer|min:1|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'catatan' => 'nullable|string|max:1000'
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
            'special_offer_id.required' => 'Promo tidak valid.',
            'special_offer_id.exists' => 'Promo tidak ditemukan.',
            'tanggal_keberangkatan.required' => 'Tanggal keberangkatan wajib diisi.',
            'tanggal_keberangkatan.after_or_equal' => 'Tanggal keberangkatan minimal hari ini.',
            'jumlah_peserta.required' => 'Jumlah peserta wajib diisi.',
            'jumlah_peserta.min' => 'Jumlah peserta minimal 1 orang.',
            'jumlah_peserta.max' => 'Jumlah peserta maksimal 50 orang.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
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
            'nama_lengkap' => 'nama lengkap',
            'nomor_telepon' => 'nomor telepon',
        ];
    }
}
