<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking - Jussttrip</title>
    <style>
        /* Base layout */
        body {
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #f8fafc;
        }
        .container { background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.06); }
        /* Header */
        .header { background: #ffffff; border-bottom: 1px solid #e5e7eb; color: #111827; padding: 20px; text-align: center; }
        .header h1 { margin: 10px 0 0 0; font-size: 22px; font-weight: 700; }
        .header p { margin: 6px 0 0 0; color: #6b7280; }

        /* Content */
        .content { padding: 26px 20px; }

        /* Booking number */
        .booking-number {
            background: #eff6ff;
            border: 1px solid #93c5fd;
            border-radius: 10px;
            padding: 14px;
            text-align: center;
            margin: 18px 0;
        }
        .booking-number strong { color: #1d4ed8; font-size: 20px; font-weight: 700; }

        /* Details table */
        .details-table { width: 100%; border-collapse: collapse; margin: 18px 0; }
        .details-table th, .details-table td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        .details-table th { background-color: #f9fafb; font-weight: 600; color: #374151; width: 40%; }
        .details-table td { color: #1f2937; }

        /* Status */
        .status-badge { display: inline-block; padding: 6px 12px; background-color: #fef3c7; color: #92400e; border-radius: 9999px; font-size: 12px; font-weight: 700; letter-spacing: .02em; text-transform: uppercase; }

        /* Next steps */
        .next-steps { background: #f8fafc; border-radius: 10px; padding: 16px; margin: 20px 0; }
        .next-steps h3 { color: #374151; margin: 0 0 8px 0; }
        .next-steps ol { margin: 0; padding-left: 18px; color: #64748b; }
        .next-steps li { margin: 8px 0; }

        /* Contact */
        .contact-info { background: #f8fafc; border-radius: 10px; padding: 18px; margin: 20px 0; }
        .contact-row { margin: 8px 0; }
        .note { background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; color: #374151; }

        /* Footer */
        .footer { background: #f9fafb; padding: 18px; text-align: center; color: #6b7280; font-size: 14px; }
        .footer a { color: #2563eb; text-decoration: none; }
        .footer a:hover { text-decoration: underline; }

        /* Custom request banner */
        .custom-request { background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%); color: #fff; padding: 14px; border-radius: 10px; margin: 18px 0; text-align: center; }

        /* Mobile tweaks */
        @media (max-width: 600px) {
            body { padding: 12px; }
            .content { padding: 20px 16px; }
            .details-table th, .details-table td { padding: 8px; font-size: 14px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ isset($message) ? $message->embed(public_path('image/logo6.png')) : asset('image/logo6.png') }}" alt="Jussttrip" style="height:48px; display:block; margin:0 auto;">
            <h1>Konfirmasi Booking</h1>
            <p>Terima kasih telah mempercayai Jussttrip untuk perjalanan Anda</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $guestBooking->nama_lengkap }}</strong>,</p>

            <p>
                @if($guestBooking->is_custom_request)
                    Permintaan khusus Anda untuk destinasi <strong>{{ $guestBooking->destinasi_dicari }}</strong> telah kami terima dan akan segera diproses oleh tim ahli kami.
                @else
                    Booking Anda untuk paket <strong>{{ $guestBooking->layanan->nama_layanan ?? $guestBooking->destinasi_dicari }}</strong> telah berhasil kami terima.
                @endif
            </p>

            <!-- Booking Number -->
            <div class="booking-number">
                <p style="margin: 0; color: #64748b;">Nomor Booking Anda:</p>
                <strong>{{ $guestBooking->booking_number }}</strong>
                <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b;">Simpan nomor ini untuk referensi komunikasi</p>
            </div>

            @if($guestBooking->is_custom_request)
                <div class="note" style="margin: 18px 0;">
                    Permintaan khusus untuk destinasi <strong>{{ $guestBooking->destinasi_dicari }}</strong> telah kami terima dan akan diproses oleh tim kami.
                </div>
            @endif

            <!-- Booking Details -->
            <h3>Detail Booking</h3>
            <table class="details-table">
                <tr>
                    <th>Destinasi</th>
                    <td>{{ $guestBooking->destinasi_dicari }}</td>
                </tr>
                @if(!$guestBooking->is_custom_request && $guestBooking->layanan)
                <tr>
                    <th>Paket Dipilih</th>
                    <td>{{ $guestBooking->layanan->nama_layanan }}</td>
                </tr>
                @endif
                <tr>
                    <th>Jumlah Peserta</th>
                    <td>{{ $guestBooking->jumlah_peserta }} orang</td>
                </tr>
                <tr>
                    <th>Tanggal Diinginkan</th>
                    <td>{{ \Carbon\Carbon::parse($guestBooking->tanggal_keberangkatan_diinginkan)->format('d F Y') }}</td>
                </tr>
                @if($guestBooking->budget_estimasi)
                <tr>
                    <th>Budget Estimasi</th>
                    <td>Rp {{ number_format($guestBooking->budget_estimasi, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr>
                    <th>Status</th>
                    <td><span class="status-badge">Menunggu Konfirmasi</span></td>
                </tr>
                <tr>
                    <th>Tanggal Booking</th>
                    <td>{{ $guestBooking->created_at->format('d F Y, H:i') }} WIB</td>
                </tr>
            </table>

            @if($guestBooking->catatan_khusus)
            <h3>Catatan Khusus</h3>
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #3b82f6;">
                {{ $guestBooking->catatan_khusus }}
            </div>
            @endif

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>Langkah Selanjutnya</h3>
                <ol>
                    <li>Tim kami akan menghubungi dalam 1x24 jam ke nomor {{ $guestBooking->nomor_telepon }}.</li>
                    <li>
                        @if($guestBooking->is_custom_request)
                            Diskusi detail itinerary khusus, harga, dan kebutuhan Anda.
                        @else
                            Konfirmasi detail booking dan membahas pembayaran.
                        @endif
                    </li>
                    <li>Finalisasi dan pembayaran setelah semua detail disepakati.</li>
                    <li>Nikmati perjalanan Anda.</li>
                </ol>
            </div>

            <!-- Contact Info -->
            <div class="contact-info">
                <h3 style="margin-top: 0; color: #374151;">Butuh Bantuan?</h3>
                <p style="color: #6b7280; margin-bottom: 15px;">Tim customer service kami siap membantu Anda 24/7</p>

                <div class="contact-row">
                    <strong>WhatsApp:</strong>
                    <a href="https://wa.me/6282266478147" target="_blank" rel="noopener" style="color:#2563eb; text-decoration:none;">+62 822-6647-8147</a>
                    <br><small style="color:#6b7280;">Respon cepat & mudah</small>
                </div>

                <div class="contact-row">
                    <strong>Email:</strong>
                    <a href="mailto:{{ config('mail.from.address', 'info@justtrip.com') }}" style="color:#2563eb; text-decoration:none;">{{ config('mail.from.address', 'info@justtrip.com') }}</a>
                    <br><small style="color:#6b7280;">Untuk pertanyaan detail</small>
                </div>
            </div>

            <p style="color: #6b7280; font-size: 14px; margin-top: 30px;">
                <strong>Catatan Penting:</strong> Simpan email ini sebagai bukti booking Anda.
                Jika ada pertanyaan, selalu sertakan nomor booking <strong>{{ $guestBooking->booking_number }}</strong>
                dalam komunikasi dengan tim kami.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Jussttrip</strong> - Your Trusted Travel Partner</p>
            <p>
                <a href="https://justtrip.com" target="_blank" rel="noopener">Website</a> |
                <a href="https://instagram.com/justtrip" target="_blank" rel="noopener">Instagram</a> |
                <a href="https://facebook.com/justtrip" target="_blank" rel="noopener">Facebook</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                Email ini dikirim otomatis, mohon tidak membalas email ini.
                Untuk pertanyaan, silakan hubungi customer service kami.
            </p>
        </div>
    </div>
</body>
</html>
