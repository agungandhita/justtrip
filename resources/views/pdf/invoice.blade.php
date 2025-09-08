<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
        }
        
        .company-info {
            flex: 1;
        }
        
        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 5px;
        }
        
        .company-tagline {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }
        
        .company-details {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.5;
        }
        
        .invoice-info {
            text-align: right;
            flex: 1;
        }
        
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }
        
        .invoice-number {
            font-size: 16px;
            color: #2563eb;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .invoice-date {
            font-size: 12px;
            color: #6b7280;
        }
        
        .billing-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .billing-info {
            flex: 1;
            margin-right: 20px;
        }
        
        .billing-title {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .billing-details {
            font-size: 12px;
            line-height: 1.6;
        }
        
        .booking-details {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .booking-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .booking-title::before {
            content: "🏖️";
            margin-right: 8px;
        }
        
        .booking-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .booking-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .booking-label {
            font-weight: 600;
            color: #4b5563;
        }
        
        .booking-value {
            color: #1f2937;
            font-weight: 500;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .items-table th {
            background: #2563eb;
            color: white;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
        }
        
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 12px;
        }
        
        .items-table tr:last-child td {
            border-bottom: none;
        }
        
        .items-table tr:nth-child(even) {
            background: #f8fafc;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .summary-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }
        
        .summary-table {
            width: 300px;
            border-collapse: collapse;
        }
        
        .summary-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .summary-label {
            font-weight: 600;
            color: #4b5563;
        }
        
        .summary-value {
            text-align: right;
            color: #1f2937;
        }
        
        .summary-total {
            background: #2563eb;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        
        .summary-total td {
            border-bottom: none;
        }
        
        .payment-info {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .payment-title {
            font-size: 14px;
            font-weight: bold;
            color: #92400e;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .payment-title::before {
            content: "💳";
            margin-right: 8px;
        }
        
        .payment-details {
            font-size: 12px;
            color: #92400e;
            line-height: 1.6;
        }
        
        .footer {
            border-top: 2px solid #e5e7eb;
            padding-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }
        
        .footer-note {
            margin-bottom: 10px;
            font-style: italic;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-draft {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-sent {
            background: #dbeafe;
            color: #1d4ed8;
        }
        
        .status-paid {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        
        @media print {
            .container {
                padding: 0;
            }
            
            body {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <div class="company-name">{{ $company['name'] }}</div>
                <div class="company-tagline">Your Trusted Travel Partner</div>
                <div class="company-details">
                    {{ $company['address'] }}<br>
                    Telepon: {{ $company['phone'] }}<br>
                    Email: {{ $company['email'] }}<br>
                    Website: {{ $company['website'] }}
                </div>
            </div>
            <div class="invoice-info">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">#{{ $invoice->invoice_number }}</div>
                <div class="invoice-date">
                    Tanggal: {{ $invoice->invoice_date->format('d F Y') }}<br>
                    Jatuh Tempo: {{ $invoice->due_date->format('d F Y') }}
                </div>
                <div style="margin-top: 10px;">
                    <span class="status-badge status-{{ $invoice->status }}">{{ ucfirst($invoice->status) }}</span>
                </div>
            </div>
        </div>

        <!-- Billing Information -->
        <div class="billing-section">
            <div class="billing-info">
                <div class="billing-title">Tagihan Kepada:</div>
                <div class="billing-details">
                    <strong>{{ $customer['name'] }}</strong><br>
                    {{ $customer['email'] }}<br>
                    {{ $customer['phone'] }}<br>
                    {{ $customer['address'] }}
                </div>
            </div>
            <div class="billing-info">
                <div class="billing-title">Detail Booking:</div>
                <div class="billing-details">
                    <strong>Booking ID:</strong> {{ $booking->booking_number }}<br>
                    <strong>Tanggal Booking:</strong> {{ $booking->booking_date->format('d F Y') }}<br>
                    <strong>Status:</strong> {{ ucfirst($booking->status) }}
                </div>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="booking-details">
            <div class="booking-title">Detail Perjalanan</div>
            <div class="booking-grid">
                <div class="booking-item">
                    <span class="booking-label">Destinasi:</span>
                    <span class="booking-value">{{ $layanan->nama_layanan }}</span>
                </div>
                <div class="booking-item">
                    <span class="booking-label">Jumlah Peserta:</span>
                    <span class="booking-value">{{ $booking->jumlah_peserta }} orang</span>
                </div>
                <div class="booking-item">
                    <span class="booking-label">Tanggal Keberangkatan:</span>
                    <span class="booking-value">{{ $booking->tanggal_keberangkatan->format('d F Y') }}</span>
                </div>
                <div class="booking-item">
                    <span class="booking-label">Durasi:</span>
                    <span class="booking-value">{{ $layanan->durasi ?? 'Sesuai Paket' }}</span>
                </div>
                @if($booking->catatan_khusus)
                <div class="booking-item" style="grid-column: 1 / -1;">
                    <span class="booking-label">Catatan Khusus:</span>
                    <span class="booking-value">{{ $booking->catatan_khusus }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Deskripsi</th>
                    <th style="width: 15%;" class="text-center">Qty</th>
                    <th style="width: 20%;" class="text-right">Harga Satuan</th>
                    <th style="width: 15%;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $layanan->nama_layanan }}</strong><br>
                        <small style="color: #6b7280;">{{ $layanan->deskripsi_singkat ?? 'Paket wisata lengkap' }}</small>
                        @if($booking->specialOffer)
                            <br><small style="color: #059669; font-weight: 600;">🎉 Special Offer: {{ $booking->specialOffer->title }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $booking->jumlah_peserta }}</td>
                    <td class="text-right">Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($booking->original_amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary-section">
            <table class="summary-table">
                <tr>
                    <td class="summary-label">Subtotal:</td>
                    <td class="summary-value">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                </tr>
                @if($invoice->discount_amount > 0)
                <tr>
                    <td class="summary-label">Diskon:</td>
                    <td class="summary-value">- Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr>
                    <td class="summary-label">Pajak (PPN 11%):</td>
                    <td class="summary-value">Rp {{ number_format($invoice->tax_amount, 0, ',', '.') }}</td>
                </tr>
                <tr class="summary-total">
                    <td>TOTAL PEMBAYARAN:</td>
                    <td>Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <!-- Payment Information -->
        <div class="payment-info">
            <div class="payment-title">Informasi Pembayaran</div>
            <div class="payment-details">
                <strong>Metode Pembayaran:</strong> Transfer Bank<br>
                <strong>Bank:</strong> BCA<br>
                <strong>No. Rekening:</strong> 1234567890<br>
                <strong>Atas Nama:</strong> PT JustTrip Indonesia<br><br>
                <strong>Batas Waktu Pembayaran:</strong> {{ $invoice->due_date->format('d F Y') }}<br>
                Mohon sertakan nomor invoice <strong>{{ $invoice->invoice_number }}</strong> sebagai keterangan transfer.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-note">
                Terima kasih telah memilih {{ $company['name'] }} sebagai partner perjalanan Anda!
            </div>
            <div>
                Invoice ini dibuat secara otomatis pada {{ $generated_at }}<br>
                Untuk pertanyaan, hubungi kami di {{ $company['email'] }} atau {{ $company['phone'] }}
            </div>
        </div>
    </div>
</body>
</html>