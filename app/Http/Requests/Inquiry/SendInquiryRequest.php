<?php

namespace App\Http\Requests\Inquiry;

use Illuminate\Foundation\Http\FormRequest;

class SendInquiryRequest extends FormRequest
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
            'nama_lengkap'          => ['required', 'string', 'max:255'],
            'nomor_whatsapp'        => ['required', 'string', 'max:25'],
            'email'                 => ['nullable', 'email', 'max:255'],
            'alamat'                => ['nullable', 'string', 'max:500'],
            'jumlah_peserta'        => ['required', 'integer', 'min:1', 'max:500'],
            'tanggal_keberangkatan' => ['required', 'date', 'after:today'],
            'catatan_tambahan'      => ['nullable', 'string', 'max:1000'],
            'layanan_id'            => ['nullable', 'exists:layanan,layanan_id'],
            'special_offer_id'      => ['nullable', 'exists:special_offers,id'],
            'selected_options'      => ['nullable', 'array'],
            'selected_options.*'    => ['nullable', 'string'],
            'request_tambahan'      => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama_lengkap.required'          => 'Nama lengkap wajib diisi.',
            'nomor_whatsapp.required'        => 'Nomor WhatsApp wajib diisi.',
            'jumlah_peserta.required'        => 'Jumlah peserta wajib diisi.',
            'jumlah_peserta.min'             => 'Jumlah peserta minimal 1 orang.',
            'tanggal_keberangkatan.required' => 'Tanggal keberangkatan wajib diisi.',
            'tanggal_keberangkatan.after'    => 'Tanggal keberangkatan harus setelah hari ini.',
        ];
    }
}
