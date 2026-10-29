<?php

namespace App\Services\Inquiry;

use App\DTOs\Inquiry\InquiryDataDTO;
use App\DTOs\Inquiry\WhatsAppInquiryDTO;
use App\Models\Layanan;
use App\Models\SpecialOffer;
use Carbon\Carbon;

class InquiryService implements InquiryServiceInterface
{
    /**
     * Process inquiry data and construct formatted WhatsApp payload.
     */
    public function processInquiry(InquiryDataDTO $dto): WhatsAppInquiryDTO
    {
        $adminPhone = (string) config('whatsapp.admin_phone', '6282266478147');
        $adminPhone = ltrim(preg_replace('/[^0-9]/', '', $adminPhone), '+');

        // Resolve Layanan / Special Offer
        $layanan = null;
        $specialOffer = null;
        $packageName = 'Paket Wisata';

        if ($dto->specialOfferId) {
            $specialOffer = SpecialOffer::with('layanan')->find($dto->specialOfferId);
            $layanan = $specialOffer?->layanan;
            $packageName = $specialOffer?->title ?? 'Promo Spesial';
        } elseif ($dto->layananId) {
            $layanan = Layanan::find($dto->layananId);
            $packageName = $layanan?->nama_layanan ?? 'Paket Wisata';
        }

        // Calculate Pricing
        $pax = max(1, $dto->jumlahPeserta);
        $hargaBase = 0.0;
        $hargaDiskon = 0.0;
        $selectedOptionsBreakdown = [];
        $totalAddOns = 0.0;

        if ($specialOffer) {
            $original = (float) $specialOffer->original_price;
            $discPct = (float) $specialOffer->discount_percentage;
            $hargaBase = $original * $pax;
            $hargaDiskon = ($hargaBase * $discPct) / 100;
        } elseif ($layanan) {
            $hargaBase = (float) $layanan->harga_mulai * $pax;
        }

        // Hitung Add-ons dari Layanan (berlaku untuk paket reguler maupun promo spesial)
        if ($layanan && !empty($dto->selectedOptions) && !empty($layanan->pricing_options)) {
            foreach ($layanan->pricing_options as $option) {
                if (in_array($option['type'], $dto->selectedOptions)) {
                    $unitPrice = (float) $option['price'];
                    $subtotal = $unitPrice * $pax;
                    $totalAddOns += $subtotal;
                    $selectedOptionsBreakdown[] = [
                        'type'        => $option['type'],
                        'price'       => $unitPrice,
                        'total_price' => $subtotal,
                    ];
                }
            }
        }

        $totalEstimasi = ($hargaBase - $hargaDiskon) + $totalAddOns;

        // Build WhatsApp message
        $message = $this->buildMessage($dto, $packageName, $layanan, $specialOffer, $selectedOptionsBreakdown, $hargaBase, $hargaDiskon, $totalAddOns, $totalEstimasi);

        $whatsappUrl = 'https://api.whatsapp.com/send?phone=' . $adminPhone . '&text=' . rawurlencode($message);

        return new WhatsAppInquiryDTO(
            whatsappUrl: $whatsappUrl,
            formattedMessage: $message,
            totalEstimasi: $totalEstimasi,
            packageName: $packageName,
            selectedOptionsBreakdown: $selectedOptionsBreakdown,
        );
    }

    /**
     * Build the structured message text for WhatsApp.
     */
    private function buildMessage(
        InquiryDataDTO $dto,
        string $packageName,
        ?Layanan $layanan,
        ?SpecialOffer $specialOffer,
        array $options,
        float $hargaBase,
        float $hargaDiskon,
        float $totalAddOns,
        float $totalEstimasi,
    ): string {
        $tglFormatted = Carbon::parse($dto->tanggalKeberangkatan)->translatedFormat('d F Y');

        $lines = [];
        $lines[] = "Halo Admin Justtrip, saya ingin melakukan pemesanan paket wisata dengan rincian berikut:\n";
        $lines[] = "*DETAIL PAKET*";
        $lines[] = "• Paket: " . $packageName;

        if ($layanan) {
            $lines[] = "• Destinasi: " . $layanan->lokasi_tujuan;
            $lines[] = "• Durasi: " . ($layanan->durasi_format ?? ($layanan->durasi_hari . ' Hari'));
        }

        $lines[] = "• Tgl Keberangkatan: " . $tglFormatted;
        $lines[] = "• Jumlah Peserta: " . $dto->jumlahPeserta . " Orang";

        $lines[] = "\n*BIODATA PEMESAN*";
        $lines[] = "• Nama: " . $dto->namaLengkap;
        $lines[] = "• No. WhatsApp: " . $dto->nomorWhatsapp;
        if (!empty($dto->email)) {
            $lines[] = "• Email: " . $dto->email;
        }
        if (!empty($dto->alamat)) {
            $lines[] = "• Alamat/Kota: " . $dto->alamat;
        }

        // Add-ons
        if (!empty($options)) {
            $lines[] = "\n*ADD-ON & SERVICE TAMBAHAN YANG DIPILIH*";
            foreach ($options as $opt) {
                $lines[] = "• " . $opt['type'] . " (@ Rp " . number_format($opt['price'], 0, ',', '.') . " x " . $dto->jumlahPeserta . " pax = Rp " . number_format($opt['total_price'], 0, ',', '.') . ")";
            }
        }

        // Custom service request
        if (!empty($dto->requestTambahan)) {
            $lines[] = "\n*REQUEST SERVICE KHUSUS*";
            $lines[] = $dto->requestTambahan;
        }

        // Special notes
        if (!empty($dto->catatanTambahan)) {
            $lines[] = "\n*CATATAN KHUSUS*";
            $lines[] = $dto->catatanTambahan;
        }

        // Price breakdown
        $lines[] = "\n*RINCIAN BIAYA (ESTIMASI)*";
        $lines[] = "• Biaya Paket: Rp " . number_format($hargaBase, 0, ',', '.');
        if ($hargaDiskon > 0) {
            $lines[] = "• Diskon Promo: -Rp " . number_format($hargaDiskon, 0, ',', '.');
        }
        if ($totalAddOns > 0) {
            $lines[] = "• Total Add-on: Rp " . number_format($totalAddOns, 0, ',', '.');
        }
        $lines[] = "• *TOTAL ESTIMASI: Rp " . number_format($totalEstimasi, 0, ',', '.') . "*";

        $lines[] = "\nMohon konfirmasi ketersediaan jadwal dan instruksi pembayaran selanjutnya. Terima kasih!";

        return implode("\n", $lines);
    }
}
