<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking Promo - JustTrip</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #dc2626 0%, #ec4899 100%); padding: 40px 30px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 800;">
                    🎉 Booking Promo Berhasil!
                </h1>
                <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0; font-size: 14px;">
                    Terima kasih telah memesan paket promo kami
                </p>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 40px 30px;">
                <p style="font-size: 16px; color: #1e293b; margin: 0 0 20px;">
                    Halo <strong>{{ $customerName }}</strong>,
                </p>
                <p style="font-size: 14px; color: #64748b; line-height: 1.6; margin: 0 0 25px;">
                    Booking promo Anda telah berhasil dicatat. Tim kami akan segera memproses dan menghubungi Anda untuk konfirmasi lebih lanjut.
                </p>

                <!-- Promo Badge -->
                <div style="background: linear-gradient(135deg, #fef3c7 0%, #fbbf24 100%); border-radius: 12px; padding: 15px 20px; margin-bottom: 25px; text-align: center;">
                    <span style="background-color: #dc2626; color: white; font-size: 10px; font-weight: 800; padding: 5px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px;">
                        ⚡ Paket Promo Spesial
                    </span>
                    <h2 style="color: #92400e; margin: 15px 0 5px; font-size: 20px;">{{ $specialOffer->title }}</h2>
                </div>

                <!-- Booking Details -->
                <div style="background-color: #f8fafc; border-radius: 16px; padding: 25px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
                    <h3 style="color: #1e293b; margin: 0 0 20px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">
                        📋 Detail Pemesanan
                    </h3>
                    <table width="100%" cellspacing="0" cellpadding="0" style="font-size: 14px;">
                        <tr>
                            <td style="padding: 8px 0; color: #64748b;">Nomor Booking:</td>
                            <td style="padding: 8px 0; color: #1e293b; font-weight: 700; text-align: right;">{{ $booking->booking_number }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #64748b;">Status:</td>
                            <td style="padding: 8px 0; text-align: right;">
                                <span style="background-color: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Menunggu Konfirmasi</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #64748b;">Tanggal Keberangkatan:</td>
                            <td style="padding: 8px 0; color: #1e293b; font-weight: 600; text-align: right;">{{ \Carbon\Carbon::parse($booking->tanggal_keberangkatan)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #64748b;">Jumlah Peserta:</td>
                            <td style="padding: 8px 0; color: #1e293b; font-weight: 600; text-align: right;">{{ $booking->jumlah_peserta }} Orang</td>
                        </tr>
                    </table>
                </div>

                <!-- Price Summary -->
                <div style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 16px; padding: 25px; margin-bottom: 25px; color: white;">
                    <h3 style="margin: 0 0 20px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">
                        💰 Rincian Biaya
                    </h3>
                    <table width="100%" cellspacing="0" cellpadding="0" style="font-size: 14px;">
                        <tr>
                            <td style="padding: 8px 0; color: #94a3b8;">Harga Normal x {{ $booking->jumlah_peserta }} Orang</td>
                            <td style="padding: 8px 0; color: #94a3b8; font-weight: 500; text-align: right; text-decoration: line-through;">Rp {{ number_format($booking->original_amount, 0, ',', '.') }}</td>
                        </tr>
                        @if($booking->discount_amount > 0)
                        <tr>
                            <td style="padding: 8px 0; color: #94a3b8;">Diskon Promo</td>
                            <td style="padding: 8px 0; color: #4ade80; font-weight: 500; text-align: right;">- Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2" style="border-top: 1px solid #475569; padding-top: 15px; margin-top: 10px;"></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #ffffff; font-size: 16px; font-weight: 700;">Total Pembayaran</td>
                            <td style="padding: 8px 0; color: #f87171; font-size: 20px; font-weight: 800; text-align: right;">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Next Steps -->
                <div style="background-color: #fef3c7; border-radius: 12px; padding: 20px; margin-bottom: 25px; border-left: 4px solid #f59e0b;">
                    <h4 style="color: #92400e; margin: 0 0 10px; font-size: 14px; font-weight: 700;">📌 Langkah Selanjutnya:</h4>
                    <ol style="color: #92400e; margin: 0; padding-left: 20px; font-size: 13px; line-height: 1.8;">
                        <li>Tim kami akan memverifikasi pemesanan Anda</li>
                        <li>Anda akan menerima email konfirmasi persetujuan</li>
                        <li>Lakukan pembayaran sesuai instruksi setelah disetujui</li>
                        <li>Tunggu invoice dan tiket dari tim kami</li>
                    </ol>
                </div>

                <!-- Contact Box -->
                <div style="text-align: center; padding: 25px; background-color: #f1f5f9; border-radius: 12px;">
                    <p style="color: #64748b; font-size: 13px; margin: 0 0 15px;">Ada pertanyaan? Hubungi kami:</p>
                    <a href="https://wa.me/6281234567890" style="display: inline-block; background-color: #22c55e; color: white; text-decoration: none; padding: 12px 25px; border-radius: 8px; font-size: 14px; font-weight: 600; margin: 0 5px;">
                        💬 WhatsApp
                    </a>
                    <a href="mailto:justtrip20@gmail.com" style="display: inline-block; background-color: #3b82f6; color: white; text-decoration: none; padding: 12px 25px; border-radius: 8px; font-size: 14px; font-weight: 600; margin: 0 5px;">
                        ✉️ Email
                    </a>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #1e293b; padding: 30px; text-align: center;">
                <p style="color: #94a3b8; font-size: 12px; margin: 0 0 10px;">
                    © {{ date('Y') }} JustTrip. All rights reserved.
                </p>
                <p style="color: #64748b; font-size: 11px; margin: 0;">
                    Email ini dikirim secara otomatis, harap jangan dibalas langsung.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
