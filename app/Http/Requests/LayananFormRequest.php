<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LayananFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $jenisLayananOptions = \App\Models\Layanan::getJenisLayananOptions();

        return [
            'nama_layanan' => 'required|string|max:255',
            'jenis_layanan' => 'required|in:' . implode(',', array_keys($jenisLayananOptions)),
            'deskripsi' => 'nullable|string',
            'harga_mulai' => 'required|numeric|min:0',
            'durasi_hari' => 'required|integer|min:1',
            'maks_orang' => 'required|integer|min:1',
            'lokasi_tujuan' => 'required|string|max:255',
            'fasilitas' => 'nullable|array',
            'gambar_destinasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'information_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:aktif,nonaktif',
            'catatan' => 'nullable|string',
            // Adventure trip fields
            'adventure_difficulty' => 'nullable|string|max:100',
            'adventure_activity_type' => 'nullable|string|max:100',
            'adventure_gear' => 'nullable|string|max:255',
            'adventure_meeting_point' => 'nullable|string|max:255',
            // Edukasi trip pricing fields
            'edu_harga_per_orang' => 'nullable|numeric|min:0',
            'edu_harga_per_kelompok' => 'nullable|numeric|min:0',
            'edu_catatan_kelompok' => 'nullable|string|max:255',
            // New fields
            'start_time' => 'nullable|string|max:50',
            'finish_time' => 'nullable|string|max:50',
            'itinerary_note' => 'nullable|string',
            'itinerary' => 'nullable|array',
            'include_services' => 'nullable|array',
            'exclude_services' => 'nullable|array',
            'destinations' => 'nullable|array',
            'pricing_types' => 'nullable|array',
            'pricing_prices' => 'nullable|array',
            'terms_registration' => 'nullable|array',
            'terms_cancelation' => 'nullable|array',
            'terms_not_responsible' => 'nullable|array',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama_layanan.required' => 'Nama layanan wajib diisi',
            'jenis_layanan.required' => 'Jenis layanan wajib dipilih',
            'harga_mulai.required' => 'Harga mulai wajib diisi',
            'harga_mulai.numeric' => 'Harga mulai harus berupa angka',
            'durasi_hari.required' => 'Durasi hari wajib diisi',
            'durasi_hari.integer' => 'Durasi hari harus berupa bilangan bulat',
            'maks_orang.required' => 'Maksimal orang wajib diisi',
            'maks_orang.integer' => 'Maksimal orang harus berupa bilangan bulat',
            'lokasi_tujuan.required' => 'Lokasi tujuan wajib diisi',
            'status.required' => 'Status wajib dipilih',
        ];
    }
}