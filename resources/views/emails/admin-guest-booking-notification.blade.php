<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Baru - Jussttrip Admin</title>
    <style>
        body {
            margin: 0 auto;
            padding: 20px;
            max-width: 680px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background: #f8fafc;
        }
        .container { background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; overflow: hidden; }
        .header { background: #111827; color: #fff; text-align: center; padding: 20px; }
        .title { margin: 0; font-size: 20px; font-weight: 700; }
        .subtitle { margin: 6px 0 0 0; font-size: 13px; opacity: .85; }

        .content { padding: 20px; }
        .section { margin: 16px 0; }
        .section h3 { margin: 0 0 8px 0; font-size: 16px; color: #374151; }
        .meta { color: #6b7280; font-size: 13px; }

        .booking-number { background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 6px; padding: 10px; text-align: center; font-weight: 700; color: #111827; }

        .simple-table { width: 100%; border-collapse: collapse; }
        .simple-table th, .simple-table td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .simple-table th { width: 35%; color: #374151; background: #f9fafb; font-weight: 600; }
        .simple-table td { color: #1f2937; }

        .note { background: #fff7ed; border: 1px solid #f59e0b; border-radius: 6px; padding: 10px; color: #92400e; }
        .links a { color: #2563eb; text-decoration: none; }
        .links a:hover { text-decoration: underline; }

        .footer { background: #f9fafb; padding: 16px; text-align: center; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    @php
        // Access guestBooking from Mailable public property
        $guestBooking = $guestBooking ?? null;
    @endphp
    <div class="container">
        <div class="header">
            <p class="title">Booking Baru Masuk</p>
            <p class="subtitle">Segera lakukan follow up agar respons cepat</p>
        </div>

        <div class="content">
            <div class="section">
                <div class="booking-number">Booking #{{ $guestBooking->booking_number }}</div>
                <p class="meta">Diterima: {{ $guestBooking->created_at->format('d F Y, H:i') }} WIB · Status: Menunggu Konfirmasi</p>
            </div>

            <div class="section">
                <h3>Ringkasan Booking</h3>
                <table class="simple-table">
                    <tr>
                        <th>Destinasi</th>
                        <td>{{ $guestBooking->destinasi_dicari }}</td>
                    </tr>
                    @if(!$guestBooking->is_custom_request && ($guestBooking->layanan ?? null))
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
                </table>
            </div>

            <div class="section">
                <h3>Data Customer</h3>
                <table class="simple-table">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $guestBooking->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>{{ $guestBooking->nomor_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $guestBooking->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $guestBooking->alamat }}</td>
                    </tr>
                </table>
            </div>

            @if($guestBooking->catatan_khusus)
            <div class="section">
                <h3>Catatan Khusus</h3>
                <div class="note">{{ $guestBooking->catatan_khusus }}</div>
            </div>
            @endif

            <div class="section links">
                <h3>Aksi Cepat</h3>
                @php($wa = preg_replace('/[^0-9]/', '', $guestBooking->nomor_telepon ?? ''))
                <p>
                    <a href="https://wa.me/{{ $wa }}?text=Halo%20{{ urlencode($guestBooking->nama_lengkap) }},%20terima%20kasih%20sudah%20booking%20di%20Jussttrip.%20Booking%20number%20Anda:%20{{ $guestBooking->booking_number }}" target="_blank" rel="noopener">WhatsApp Customer</a>
                    ·
                    <a href="mailto:{{ $guestBooking->email }}?subject=Konfirmasi%20Booking%20{{ $guestBooking->booking_number }}" target="_blank" rel="noopener">Email Customer</a>
                </p>
            </div>
        </div>

        <div class="footer">
            Jussttrip Admin Panel — Email otomatis sistem booking
        </div>
    </div>
</body>
</html>
