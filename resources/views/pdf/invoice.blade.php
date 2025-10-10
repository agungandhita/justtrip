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
            font-size: 10px;
            line-height: 1.2;
            color: #333;
            background: #fff;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
            border-bottom: 2px solid #22c55e;
            padding-bottom: 10px;
        }
        
        .company-info {
            flex: 1;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .company-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        
        .company-details-wrapper {
            flex: 1;
        }
        
        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #22c55e;
            margin-bottom: 2px;
        }
        
        .company-details {
            font-size: 9px;
            color: #6b7280;
            line-height: 1.3;
        }
        
        .invoice-info {
            text-align: right;
            flex: 1;
        }
        
        .invoice-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .invoice-number {
            font-size: 12px;
            color: #22c55e;
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .invoice-date {
            font-size: 9px;
            color: #6b7280;
        }
        
        .main-content {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .left-section {
            flex: 2;
        }
        
        .right-section {
            flex: 1;
        }
        
        .billing-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .billing-info {
            flex: 1;
            margin-right: 10px;
        }
        
        .billing-title {
            font-size: 10px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
            padding: 3px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .billing-details {
            font-size: 9px;
            line-height: 1.3;
        }
        
        .compact-section {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 8px;
            font-size: 9px;
        }
        
        .section-title {
            font-size: 10px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 8px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
            padding: 3px 0;
        }
        
        .info-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 8px;
        }
        
        .info-value {
            color: #1f2937;
            font-weight: 500;
            font-size: 9px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            background: #fff;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        
        .items-table th {
            background: #22c55e;
            color: white;
            padding: 6px 8px;
            text-align: left;
            font-weight: 600;
            font-size: 9px;
        }
        
        .items-table td {
            padding: 6px 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9px;
        }
        
        .items-table tr:last-child td {
            border-bottom: none;
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
            margin-bottom: 10px;
        }
        
        .summary-table {
            width: 200px;
            border-collapse: collapse;
            font-size: 9px;
        }
        
        .summary-table td {
            padding: 4px 8px;
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
            font-size: 10px;
        }
        
        .summary-total td {
            border-bottom: none;
        }
        
        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            text-align: center;
            font-size: 8px;
            color: #6b7280;
        }
        
        .footer-note {
            margin-bottom: 5px;
            font-style: italic;
        }
        
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8px;
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
                padding: 5px;
                max-width: 100%;
            }
            
            body {
                font-size: 9px;
                line-height: 1.1;
            }
            
            .header {
                margin-bottom: 10px;
                padding-bottom: 8px;
            }
            
            .main-content {
                margin-bottom: 8px;
            }
            
            .compact-section {
                margin-bottom: 5px;
                padding: 5px;
            }
            
            .items-table {
                margin-bottom: 8px;
            }
            
            .summary-section {
                margin-bottom: 5px;
            }
            
            .footer {
                padding-top: 5px;
                font-size: 7px;
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

        <!-- Customer & Order Info -->
        <div class="main-content">
            <div class="left-section">
                <div class="compact-section">
                    <div class="section-title">Informasi Pelanggan</div>
                    <div><strong>{{ $customer['name'] }}</strong></div>
                    <div>{{ $customer['email'] }} | {{ $customer['phone'] }}</div>
                    <div><strong>Alamat:</strong> {{ $customer['address'] ?? 'Alamat tidak tersedia' }}</div>
                    @if($booking->catatan_khusus)
                    <div><strong>Catatan:</strong> {{ $booking->catatan_khusus }}</div>
                    @endif
                </div>
                
                <div class="compact-section">
                    <div class="section-title">Detail Perjalanan</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Destinasi</span>
                            <span class="info-value">{{ $layanan->nama_layanan }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Peserta</span>
                            <span class="info-value">{{ $booking->jumlah_peserta }} orang</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Keberangkatan</span>
                            <span class="info-value">{{ $booking->tanggal_keberangkatan->format('d M Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Durasi</span>
                            <span class="info-value">{{ $layanan->durasi ?? 'Sesuai Paket' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="right-section">
                <div class="compact-section">
                    <div class="section-title">Status Pembayaran</div>
                    <div style="margin-bottom: 5px;">
                        <span class="status-badge status-{{ $invoice->status }}">{{ strtoupper($invoice->status == 'paid' ? 'SUDAH DIBAYAR' : 'BELUM DIBAYAR') }}</span>
                    </div>
                    <div><strong>Metode:</strong> BRI</div>
                    <div><strong>Jatuh Tempo:</strong> {{ $invoice->due_date->format('d M Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Layanan</th>
                    <th style="width: 15%;" class="text-center">Qty</th>
                    <th style="width: 20%;" class="text-right">Harga</th>
                    <th style="width: 15%;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $layanan->nama_layanan }}</strong>
                        @if($layanan->deskripsi_singkat)
                        <br><small style="color: #6b7280;">{{ $layanan->deskripsi_singkat }}</small>
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
            <div class="footer-note">Terima kasih atas kepercayaan Anda! | {{ $company['email'] }} | Generated: {{ $generated_at ?? now()->format('d M Y H:i') }}</div>
        </div>
    </div>
</body>
</html>