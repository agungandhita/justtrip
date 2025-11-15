<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Baru - Admin JustTrip</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 700px;
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
            background: linear-gradient(135deg, #dc2626 0%, #ea580c 100%);
            color: white;
            padding: 25px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .content {
            padding: 25px 20px;
        }
        .alert-box {
            background: #fef2f2;
            border: 2px solid #dc2626;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
        .alert-box .priority {
            color: #dc2626;
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .alert-box .time {
            color: #7f1d1d;
            font-size: 14px;
            margin: 5px 0 0 0;
        }
        .booking-summary {
            background: #f0f9ff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .booking-number {
            background: #1e40af;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 16px;
        }
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }
        .detail-item {
            background: #f9fafb;
            padding: 12px;
            border-radius: 6px;
            border-left: 4px solid #3b82f6;
        }
        .detail-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .detail-value {
            color: #1f2937;
            font-weight: 500;
        }
        .customer-info {
            background: #f0fdf4;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .customer-info h3 {
            color: #166534;
            margin-top: 0;
            margin-bottom: 15px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
            padding: 8px;
            background: white;
            border-radius: 6px;
        }
        .contact-icon {
            width: 32px;
            height: 32px;
            background: #10b981;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 14px;
        }
        .custom-request-alert {
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 25px 0;
        }
        .btn {
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
        }
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        .btn-success {
            background: #10b981;
            color: white;
        }
        .notes-section {
            background: #fffbeb;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .notes-section h4 {
            color: #92400e;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .priority-high {
            background: #fef2f2;
            border-color: #dc2626;
        }
        .priority-high .priority {
            color: #dc2626;
        }
        @media (max-width: 600px) {
            .details-grid {
                grid-template-columns: 1fr;
            }
            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @php
        // `GuestBookingFeedback` passes an array in the public property `$datas`.
        // Normalize to `$guestBooking` so the rest of the view can remain unchanged.
        $guestBooking = $datas['guestBooking'] ?? (object)[];
    @endphp
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🚨 BOOKING BARU MASUK!</h1>
            <p>Segera follow up untuk memberikan pelayanan terbaik</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Priority Alert -->
            <div class="alert-box priority-high">
                <p class="priority">
                    @if($guestBooking->is_custom_request)
                        ⭐ PERMINTAAN KHUSUS
                    @else
                        📋 BOOKING PAKET
                    @endif
                </p>
                <p class="time">Diterima: {{ $guestBooking->created_at->format('d F Y, H:i') }} WIB</p>
            </div>

            @if($guestBooking->is_custom_request)
                <div class="custom-request-alert">
                    <h3 style="margin: 0 0 8px 0;">🎨 Custom Request</h3>
                    <p style="margin: 0;">Customer meminta paket khusus untuk destinasi: <strong>{{ $guestBooking->destinasi_dicari }}</strong></p>
                </div>
            @endif

            <!-- Booking Summary -->
            <div class="booking-summary">
                <div class="booking-number">
                    Booking #{{ $guestBooking->booking_number }}
                </div>
                
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">Destinasi</div>
                        <div class="detail-value">{{ $guestBooking->destinasi_dicari }}</div>
                    </div>
                    
                    @if(!$guestBooking->is_custom_request && $guestBooking->layanan)
                    <div class="detail-item">
                        <div class="detail-label">Paket Dipilih</div>
                        <div class="detail-value">{{ $guestBooking->layanan->nama_layanan }}</div>
                    </div>
                    @endif
                    
                    <div class="detail-item">
                        <div class="detail-label">Jumlah Peserta</div>
                        <div class="detail-value">{{ $guestBooking->jumlah_peserta }} orang</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Tanggal Diinginkan</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($guestBooking->tanggal_keberangkatan_diinginkan)->format('d F Y') }}</div>
                    </div>
                    
                    @if($guestBooking->budget_estimasi)
                    <div class="detail-item">
                        <div class="detail-label">Budget Estimasi</div>
                        <div class="detail-value">{{ $guestBooking->budget_estimasi }}</div>
                    </div>
                    @endif
                    
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                                MENUNGGU KONFIRMASI
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="customer-info">
                <h3>👤 Informasi Customer</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value" style="font-size: 16px; font-weight: 600;">{{ $guestBooking->nama_lengkap }}</div>
                    </div>
                    
                    @if($guestBooking->usia)
                    <div>
                        <div class="detail-label">Usia</div>
                        <div class="detail-value">{{ $guestBooking->usia }} tahun</div>
                    </div>
                    @endif
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">📱</div>
                    <div>
                        <strong>{{ $guestBooking->nomor_telepon }}</strong><br>
                        <small style="color: #6b7280;">Klik untuk WhatsApp langsung</small>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div>
                        <strong>{{ $guestBooking->email }}</strong><br>
                        <small style="color: #6b7280;">Email konfirmasi sudah dikirim</small>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div>
                        <strong>Alamat:</strong><br>
                        {{ $guestBooking->alamat }}
                    </div>
                </div>
            </div>

            @if($guestBooking->catatan_khusus)
            <!-- Customer Notes -->
            <div class="notes-section">
                <h4>📝 Catatan Khusus dari Customer</h4>
                <p style="margin: 0; color: #92400e; font-style: italic;">
                    "{{ $guestBooking->catatan_khusus }}"
                </p>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $guestBooking->nomor_telepon) }}?text=Halo%20{{ urlencode($guestBooking->nama_lengkap) }},%20terima%20kasih%20sudah%20booking%20di%20JustTrip.%20Booking%20number%20Anda:%20{{ $guestBooking->booking_number }}" 
                   class="btn btn-success" target="_blank">
                    📱 WhatsApp Customer
                </a>
                
                <a href="mailto:{{ $guestBooking->email }}?subject=Konfirmasi%20Booking%20{{ $guestBooking->booking_number }}&body=Halo%20{{ urlencode($guestBooking->nama_lengkap) }},%0A%0ATerima%20kasih%20sudah%20booking%20di%20JustTrip." 
                   class="btn btn-primary" target="_blank">
                    📧 Email Customer
                </a>
            </div>

            <!-- Admin Instructions -->
            <div style="background: #f0f9ff; border-radius: 8px; padding: 20px; margin: 25px 0;">
                <h3 style="color: #1e40af; margin-top: 0;">📋 Langkah Follow Up</h3>
                
                <ol style="color: #1e40af; margin: 0; padding-left: 20px;">
                    <li style="margin-bottom: 8px;">
                        <strong>Hubungi customer dalam 1x24 jam</strong> via WhatsApp atau telepon
                    </li>
                    <li style="margin-bottom: 8px;">
                        @if($guestBooking->is_custom_request)
                            <strong>Diskusikan detail itinerary khusus</strong> sesuai keinginan customer
                        @else
                            <strong>Konfirmasi detail paket</strong> dan ketersediaan tanggal
                        @endif
                    </li>
                    <li style="margin-bottom: 8px;">
                        <strong>Berikan penawaran harga final</strong> dan metode pembayaran
                    </li>
                    <li style="margin-bottom: 8px;">
                        <strong>Update status booking</strong> di sistem admin
                    </li>
                    <li>
                        <strong>Follow up pembayaran</strong> dan kirim invoice jika deal
                    </li>
                </ol>
            </div>

            <!-- Booking Stats -->
            <div style="background: #f9fafb; border-radius: 8px; padding: 15px; margin: 20px 0; text-align: center;">
                <p style="margin: 0; color: #6b7280; font-size: 14px;">
                    <strong>Booking ID:</strong> {{ $guestBooking->id }} | 
                    <strong>Waktu Response Target:</strong> {{ $guestBooking->created_at->addDay()->format('d F Y, H:i') }} WIB
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>JustTrip Admin Panel</strong></p>
            <p style="margin: 5px 0; font-size: 12px;">
                Email otomatis dari sistem booking. Segera follow up untuk memberikan pelayanan terbaik!
            </p>
        </div>
    </div>
</body>
</html>
