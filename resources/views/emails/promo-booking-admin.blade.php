<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Promo Baru - JustTrip Admin</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); padding: 30px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 800;">
                    🔔 Booking Promo Baru
                </h1>
                <p style="color: #94a3b8; margin: 10px 0 0; font-size: 14px;">
                    {{ now()->format('d F Y, H:i') }} WIB
                </p>
            </td>
        </tr>

        <!-- Alert Badge -->
        <tr>
            <td style="padding: 20px 30px 0;">
                <div style="background: linear-gradient(135deg, #dc2626 0%, #ec4899 100%); border-radius: 12px; padding: 15px 20px; text-align: center;">
                    <span style="color: white; font-size: 13px; font-weight: 700;">
                        ⚡ PAKET PROMO: {{ strtoupper($specialOffer->title) }}
                    </span>
                </div>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 30px;">
                <!-- Customer Info -->
                <div style="background-color: #f8fafc; border-radius: 12px; padding: 20px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
                    <h3 style="color: #1e293b; margin: 0 0 15px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                        👤 Data Customer
                    </h3>
                    <table width="100%" cellspacing="0" cellpadding="0" style="font-size: 14px;">
                        <tr>
                            <td style="padding: 6px 0; color: #64748b; width: 120px;">Nama:</td>
                            <td style="padding: 6px 0; color: #1e293b; font-weight: 600;">{{ $booking->customer_info['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: #64748b;">Email:</td>
                            <td style="padding: 6px 0; color: #1e293b;">
                                <a href="mailto:{{ $booking->customer_info['email'] }}" style="color: #3b82f6; text-decoration: none;">{{ $booking->customer_info['email'] }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: #64748b;">WhatsApp:</td>
                            <td style="padding: 6px 0; color: #1e293b;">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->customer_info['phone']) }}" style="color: #22c55e; text-decoration: none; font-weight: 600;">{{ $booking->customer_info['phone'] }}</a>
                            </td>
                        </tr>
                        @if(!empty($booking->customer_info['address']))
                        <tr>
                            <td style="padding: 6px 0; color: #64748b;">Alamat:</td>
                            <td style="padding: 6px 0; color: #1e293b;">{{ $booking->customer_info['address'] }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                <!-- Booking Details -->
                <div style="background-color: #f0fdf4; border-radius: 12px; padding: 20px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
                    <h3 style="color: #166534; margin: 0 0 15px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                        📋 Detail Booking
                    </h3>
                    <table width="100%" cellspacing="0" cellpadding="0" style="font-size: 14px;">
                        <tr>
                            <td style="padding: 6px 0; color: #166534; width: 140px;">No. Booking:</td>
                            <td style="padding: 6px 0; color: #1e293b; font-weight: 700;">{{ $booking->booking_number }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: #166534;">Tanggal Berangkat:</td>
                            <td style="padding: 6px 0; color: #1e293b; font-weight: 600;">{{ \Carbon\Carbon::parse($booking->tanggal_keberangkatan)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: #166534;">Jumlah Peserta:</td>
                            <td style="padding: 6px 0; color: #1e293b; font-weight: 600;">{{ $booking->jumlah_peserta }} Orang</td>
                        </tr>
                        <tr>
                            <td style="padding: 6px 0; color: #166534;">Status:</td>
                            <td style="padding: 6px 0;">
                                <span style="background-color: #fef3c7; color: #92400e; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">PENDING</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Catatan Khusus -->
                @if($booking->catatan_khusus)
                <div style="background-color: #fefce8; border-radius: 12px; padding: 20px; margin-bottom: 20px; border: 1px solid #fef08a;">
                    <h3 style="color: #854d0e; margin: 0 0 10px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                        📝 Catatan Khusus
                    </h3>
                    <p style="color: #1e293b; margin: 0; font-size: 14px; line-height: 1.6;">{{ $booking->catatan_khusus }}</p>
                </div>
                @endif

                <!-- Price Summary -->
                <div style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 12px; padding: 20px; margin-bottom: 20px; color: white;">
                    <h3 style="margin: 0 0 15px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8;">
                        💰 Rincian Pembayaran
                    </h3>
                    <table width="100%" cellspacing="0" cellpadding="0" style="font-size: 14px;">
                        <tr>
                            <td style="padding: 5px 0; color: #94a3b8;">Subtotal:</td>
                            <td style="padding: 5px 0; color: #ffffff; text-align: right;">Rp {{ number_format($booking->original_amount - $booking->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        @if($booking->discount_amount > 0)
                        <tr>
                            <td style="padding: 5px 0; color: #94a3b8;">Diskon:</td>
                            <td style="padding: 5px 0; color: #4ade80; text-align: right;">- Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="padding: 5px 0; color: #94a3b8;">PPN (11%):</td>
                            <td style="padding: 5px 0; color: #ffffff; text-align: right;">Rp {{ number_format($booking->tax_amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: 1px solid #475569; padding-top: 12px; margin-top: 8px;"></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0; color: #ffffff; font-size: 15px; font-weight: 700;">TOTAL:</td>
                            <td style="padding: 5px 0; color: #f87171; font-size: 18px; font-weight: 800; text-align: right;">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Action Button -->
                <div style="text-align: center; padding: 20px 0;">
                    <a href="{{ url('/admin/bookings/' . $booking->booking_id) }}" style="display: inline-block; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; text-decoration: none; padding: 15px 40px; border-radius: 10px; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                        📋 Lihat di Dashboard
                    </a>
                </div>

                <!-- Quick Actions -->
                <div style="display: flex; justify-content: center; gap: 10px; text-align: center;">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->customer_info['phone']) }}" style="display: inline-block; background-color: #22c55e; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-size: 12px; font-weight: 600; margin: 5px;">
                        📱 Hubungi via WA
                    </a>
                    <a href="mailto:{{ $booking->customer_info['email'] }}" style="display: inline-block; background-color: #3b82f6; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-size: 12px; font-weight: 600; margin: 5px;">
                        ✉️ Kirim Email
                    </a>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f1f5f9; padding: 20px; text-align: center; border-top: 1px solid #e2e8f0;">
                <p style="color: #64748b; font-size: 11px; margin: 0;">
                    Email ini dikirim otomatis dari sistem JustTrip.<br>
                    Segera proses booking ini untuk memberikan pelayanan terbaik.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
