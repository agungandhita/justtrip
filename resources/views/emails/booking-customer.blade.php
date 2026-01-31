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
        .next-steps ul { margin: 0; padding-left: 18px; color: #64748b; }
        .next-steps li { margin: 8px 0; }

        /* Contact */
        .contact-info { background: #f8fafc; border-radius: 10px; padding: 18px; margin: 20px 0; }
        .contact-row { margin: 8px 0; }
        .note { background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; color: #374151; }

        /* Footer */
        .footer { background: #f9fafb; padding: 18px; text-align: center; color: #6b7280; font-size: 14px; }
        .footer a { color: #2563eb; text-decoration: none; }
        .footer a:hover { text-decoration: underline; }

        /* Price section */
        .price-card { background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 12px; padding: 20px; margin: 20px 0; color: white; }
        .price-row { display: table; width: 100%; margin: 8px 0; }
        .price-label { display: table-cell; color: #94a3b8; font-size: 14px; }
        .price-value { display: table-cell; text-align: right; color: #ffffff; font-weight: 500; }
        .price-total-label { display: table-cell; color: #ffffff; font-size: 16px; font-weight: 700; padding-top: 12px; border-top: 1px solid #475569; }
        .price-total-value { display: table-cell; text-align: right; color: #f87171; font-size: 20px; font-weight: 800; padding-top: 12px; border-top: 1px solid #475569; }

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
            <p>Halo <strong>{{ $customerName }}</strong>,</p>

            <p>
                Booking Anda untuk paket <strong>{{ $booking->layanan->nama_layanan ?? 'Paket Wisata' }}</strong> telah berhasil kami terima. Tim kami akan segera memproses dan menghubungi Anda untuk konfirmasi lebih lanjut.
            </p>

            <!-- Booking Number -->
            <div class="booking-number">
                <p style="margin: 0; color: #64748b;">Nomor Booking Anda:</p>
                <strong>{{ $booking->booking_number }}</strong>
                <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b;">Simpan nomor ini untuk referensi komunikasi</p>
            </div>

            <!-- Booking Details -->
            <h3>Detail Booking</h3>
            <table class="details-table">
                <tr>
                    <th>Paket Wisata</th>
                    <td>{{ $booking->layanan->nama_layanan ?? 'Paket Wisata' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Peserta</th>
                    <td>{{ $booking->jumlah_peserta }} orang</td>
                </tr>
                <tr>
                    <th>Tanggal Keberangkatan</th>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_keberangkatan)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><span class="status-badge">Menunggu Konfirmasi</span></td>
                </tr>
                <tr>
                    <th>Tanggal Booking</th>
                    <td>{{ $booking->created_at->format('d F Y, H:i') }} WIB</td>
                </tr>
            </table>

            <!-- Price Summary -->
            <div class="price-card">
                <h3 style="margin-top: 0; color: #94a3b8; font-size: 14px; text-transform: uppercase;">Rincian Biaya</h3>
                <div class="price-row">
                    <span class="price-label">Harga Paket x {{ $booking->jumlah_peserta }} Orang</span>
                    <span class="price-value">Rp {{ number_format($booking->original_amount, 0, ',', '.') }}</span>
                </div>
                @if($booking->discount_amount > 0)
                <div class="price-row">
                    <span class="price-label">Diskon</span>
                    <span class="price-value" style="color: #4ade80;">- Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="price-row" style="margin-top: 15px;">
                    <span class="price-total-label">Total Pembayaran</span>
                    <span class="price-total-value">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>Langkah Selanjutnya</h3>
                <ul>
                    <li>Tim kami akan memverifikasi pemesanan Anda dalam 1x24 jam.</li>
                    <li>Anda akan dihubungi melalui WhatsApp atau Email untuk konfirmasi detail.</li>
                    <li>Lakukan pembayaran sesuai instruksi yang diberikan setelah konfirmasi.</li>
                    <li>Tiket dan itinerary final akan dikirimkan setelah pembayaran lunas.</li>
                </ul>
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
                    <a href="mailto:justtrip20@gmail.com" style="color:#2563eb; text-decoration:none;">justtrip20@gmail.com</a>
                    <br><small style="color:#6b7280;">Untuk pertanyaan detail</small>
                </div>
            </div>
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
                Email ini dikirim otomatis, mohon tidak membalas email ini.<br>
                © {{ date('Y') }} Jussttrip. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
