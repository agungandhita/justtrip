<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking - JustTrip</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px 20px;
        }
        .booking-number {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }
        .booking-number strong {
            color: #0ea5e9;
            font-size: 20px;
            font-weight: bold;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .details-table th,
        .details-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .details-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
            width: 40%;
        }
        .details-table td {
            color: #1f2937;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            background-color: #fef3c7;
            color: #92400e;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .next-steps {
            background: #f0f9ff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .next-steps h3 {
            color: #1e40af;
            margin-top: 0;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin: 15px 0;
        }
        .step-number {
            background: #3b82f6;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .step-content {
            flex: 1;
        }
        .step-title {
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 4px;
        }
        .step-desc {
            color: #64748b;
            font-size: 14px;
        }
        .contact-info {
            background: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .contact-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .contact-icon {
            width: 40px;
            height: 40px;
            background: #10b981;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .footer a {
            color: #3b82f6;
            text-decoration: none;
        }
        .custom-request {
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .content {
                padding: 20px 15px;
            }
            .details-table th,
            .details-table td {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>
                @if($guestBooking->is_custom_request)
                    🌟 Permintaan Khusus Diterima!
                @else
                    ✈️ Booking Berhasil!
                @endif
            </h1>
            <p>Terima kasih telah mempercayai JustTrip untuk perjalanan Anda</p>
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
                <div class="custom-request">
                    <h3 style="margin: 0 0 10px 0;">🎨 Permintaan Khusus</h3>
                    <p style="margin: 0;">Kami akan membuatkan paket wisata yang disesuaikan khusus untuk Anda!</p>
                </div>
            @endif

            <!-- Booking Details -->
            <h3>📋 Detail Booking</h3>
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
                    <td>{{ $guestBooking->budget_estimasi }}</td>
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
            <h3>📝 Catatan Khusus Anda</h3>
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #3b82f6;">
                {{ $guestBooking->catatan_khusus }}
            </div>
            @endif

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>🚀 Langkah Selanjutnya</h3>
                
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <div class="step-title">Tim Kami Akan Menghubungi</div>
                        <div class="step-desc">Dalam 1x24 jam, tim kami akan menghubungi Anda melalui WhatsApp atau telepon di nomor {{ $guestBooking->nomor_telepon }}</div>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <div class="step-title">Diskusi Detail</div>
                        <div class="step-desc">
                            @if($guestBooking->is_custom_request)
                                Kami akan membahas detail itinerary, harga, dan kebutuhan khusus Anda
                            @else
                                Kami akan mengkonfirmasi detail booking dan membahas pembayaran
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <div class="step-title">Finalisasi & Pembayaran</div>
                        <div class="step-desc">Setelah semua detail disepakati, Anda dapat melakukan pembayaran</div>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <div class="step-title">Nikmati Perjalanan!</div>
                        <div class="step-desc">Bersiaplah untuk pengalaman perjalanan yang tak terlupakan</div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="contact-info">
                <h3 style="margin-top: 0; color: #374151;">💬 Butuh Bantuan?</h3>
                <p style="color: #6b7280; margin-bottom: 15px;">Tim customer service kami siap membantu Anda 24/7</p>
                
                <div class="contact-item">
                    <div class="contact-icon">📱</div>
                    <div>
                        <strong>WhatsApp:</strong> +62 812-3456-7890<br>
                        <small style="color: #6b7280;">Respon cepat & mudah</small>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div>
                        <strong>Email:</strong> info@justtrip.com<br>
                        <small style="color: #6b7280;">Untuk pertanyaan detail</small>
                    </div>
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
            <p><strong>JustTrip</strong> - Your Trusted Travel Partner</p>
            <p>
                <a href="https://justtrip.com">Website</a> | 
                <a href="https://instagram.com/justtrip">Instagram</a> | 
                <a href="https://facebook.com/justtrip">Facebook</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                Email ini dikirim otomatis, mohon tidak membalas email ini. 
                Untuk pertanyaan, silakan hubungi customer service kami.
            </p>
        </div>
    </div>
</body>
</html>