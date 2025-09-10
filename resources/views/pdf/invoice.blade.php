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
            border-bottom: 3px solid #22c55e;
            padding-bottom: 20px;
        }
        
        .company-info {
            flex: 1;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }
        
        .company-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
        
        .company-details-wrapper {
            flex: 1;
        }
        
        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #22c55e;
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
            color: #22c55e;
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
            background: #22c55e;
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
            background: #22c55e;
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
            background: #dcfce7;
            color: #166534;
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
                <img src="{{ asset('image/logo6.png') }}" alt="{{ $company['name'] }} Logo" class="company-logo">
                <div class="company-details-wrapper">
                    <div class="company-name">{{ $company['name'] }}</div>
                    <div class="company-details">
                        {{ $company['address'] }}<br>
                        {{ $company['phone'] }}<br>
                        Email: {{ $company['email'] }}
                    </div>
                </div>
            </div>
            <div class="invoice-info">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">No: {{ $invoice->invoice_number }}</div>
                <div class="invoice-date">
                    Tanggal: {{ $invoice->invoice_date->format('d M Y') }}<br>
                    Dibayar: {{ $invoice->due_date->format('d M Y') }}
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
                    {{ $customer['phone'] }}
                </div>
            </div>
            <div class="billing-info">
                <div class="billing-title">Status Pesanan:</div>
                <div class="billing-details">
                    <span class="status-badge status-{{ $invoice->status }}">{{ strtoupper($invoice->status == 'paid' ? 'SUDAH DIBAYAR' : 'BELUM DIBAYAR') }}</span><br><br>
                    <strong>Metode Pembayaran:</strong> BRI
                </div>
            </div>
        </div>

        <!-- Alamat Pengiriman -->
        <div style="margin-bottom: 20px;">
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <span style="color: #ef4444; margin-right: 8px;">📍</span>
                <strong style="color: #1f2937;">Alamat Pengiriman</strong>
            </div>
            <div style="font-size: 12px; color: #6b7280; margin-left: 20px;">
                {{ $customer['address'] ?? 'Dolor eligendi in ex' }}<br>
                <strong>Catatan:</strong> {{ $booking->catatan_khusus ?? 'Neque modi explicabo' }}
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
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 8%;" class="text-center">No</th>
                    <th style="width: 35%;">Produk</th>
                    <th style="width: 20%;">Kategori</th>
                    <th style="width: 10%;" class="text-center">Qty</th>
                    <th style="width: 15%;" class="text-right">Harga</th>
                    <th style="width: 12%;" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>
                        <strong>{{ $layanan->nama_layanan }}</strong><br>
                        <small style="color: #6b7280;">{{ $layanan->deskripsi_singkat ?? 'Occaecat culpa sint' }}</small>
                    </td>
                    <td>Travel</td>
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
                <tr>
                    <td class="summary-label">Ongkos Kirim:</td>
                    <td class="summary-value">Rp 0</td>
                </tr>
                <tr class="summary-total">
                    <td>TOTAL:</td>
                    <td>Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-note">
                Terima kasih atas kepercayaan Anda berbelanja di {{ $company['name'] }}!
            </div>
            <div>
                Invoice ini digenerate secara otomatis pada {{ $generated_at ?? now()->format('d M Y H:i') }}<br>
                Untuk pertanyaan, hubungi customer service kami di {{ $company['email'] }}
            </div>
        </div>
    </div>
</body>
</html>