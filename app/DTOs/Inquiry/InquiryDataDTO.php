<?php

namespace App\DTOs\Inquiry;

use App\Http\Requests\Inquiry\SendInquiryRequest;

readonly class InquiryDataDTO
{
    /**
     * @param array<string> $selectedOptions
     */
    public function __construct(
        public string $namaLengkap,
        public string $nomorWhatsapp,
        public ?string $email,
        public ?string $alamat,
        public int $jumlahPeserta,
        public string $tanggalKeberangkatan,
        public ?string $catatanTambahan = null,
        public ?string $layananId = null,
        public ?string $specialOfferId = null,
        public array $selectedOptions = [],
        public ?string $requestTambahan = null,
    ) {}

    public static function fromRequest(SendInquiryRequest $request): self
    {
        return new self(
            namaLengkap: (string) $request->validated('nama_lengkap'),
            nomorWhatsapp: (string) $request->validated('nomor_whatsapp'),
            email: $request->validated('email'),
            alamat: $request->validated('alamat'),
            jumlahPeserta: (int) $request->validated('jumlah_peserta'),
            tanggalKeberangkatan: (string) $request->validated('tanggal_keberangkatan'),
            catatanTambahan: $request->validated('catatan_tambahan'),
            layananId: $request->validated('layanan_id'),
            specialOfferId: $request->validated('special_offer_id'),
            selectedOptions: $request->validated('selected_options') ?? [],
            requestTambahan: $request->validated('request_tambahan'),
        );
    }
}
