<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        @page {
            margin: 0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            background: #fff;
            position: relative;
        }
        
        /* Background watermark */
        .background-watermark {
            position: fixed;
            bottom: -50px;
            left: -100px;
            width: 500px;
            height: auto;
            opacity: 0.2;
            z-index: -1;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 25px 35px;
            position: relative;
            z-index: 1;
        }
        
        /* Header Section */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #0891b2;
        }
        
        .company-info {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }
        
        .company-logo-wrapper {
            margin-bottom: 8px;
        }
        
        .company-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
            vertical-align: middle;
        }
        
        .company-name {
            display: inline-block;
            font-size: 20px;
            font-weight: bold;
            color: #0891b2;
            vertical-align: middle;
            margin-left: 10px;
        }
        
        .company-details {
            font-size: 10px;
            color: #4b5563;
            line-height: 1.5;
            margin-top: 5px;
        }
        
        .service-areas {
            font-size: 9px;
            color: #6b7280;
            margin-top: 8px;
            font-style: italic;
        }
        
        .invoice-info {
            display: table-cell;
            width: 40%;
            text-align: right;
            vertical-align: top;
        }
        
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #0891b2;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }
        
        .invoice-number {
            font-size: 12px;
            color: #1f2937;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .invoice-date {
            font-size: 10px;
            color: #6b7280;
            line-height: 1.5;
        }
        
        /* Info Sections */
        .info-sections {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 15px;
        }
        
        .info-column:last-child {
            padding-right: 0;
            padding-left: 15px;
        }
        
        .section-header {
            background: #f3f4f6;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 11px;
            color: #1f2937;
            border-bottom: 2px solid #0891b2;
            margin-bottom: 10px;
        }
        
        .info-content {
            padding: 5px 0;
        }
        
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }
        
        .info-label {
            display: table-cell;
            width: 35%;
            font-weight: 600;
            color: #4b5563;
            font-size: 10px;
        }
        
        .info-value {
            display: table-cell;
            width: 65%;
            color: #1f2937;
            font-size: 10px;
        }
        
        /* Payment Status Section */
        .payment-status-section {
            margin-top: 15px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-paid, .status-payment_confirmed {
            background: #dcfce7;
            color: #166534;
        }
        
        .status-draft, .status-sent, .status-awaiting_payment {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-payment_uploaded {
            background: #e0f2fe;
            color: #0369a1;
        }
        
        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .payment-info {
            margin-top: 10px;
            font-size: 10px;
            color: #4b5563;
        }
        
        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        
        .items-table th {
            background: #f3f4f6;
            color: #1f2937;
            padding: 10px 12px;
            text-align: left;
            font-weight: 700;
            font-size: 10px;
            border-bottom: 2px solid #d1d5db;
            text-transform: uppercase;
        }
        
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 10px;
            vertical-align: top;
        }
        
        .items-table tr:last-child td {
            border-bottom: 2px solid #d1d5db;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        /* Summary Section */
        .summary-section {
            width: 100%;
            margin-bottom: 25px;
        }
        
        .summary-table-wrapper {
            width: 250px;
            margin-left: auto;
        }
        
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .summary-table td {
            padding: 8px 12px;
            font-size: 10px;
        }
        
        .summary-label {
            font-weight: 600;
            color: #4b5563;
        }
        
        .summary-value {
            text-align: right;
            color: #1f2937;
        }
        
        .summary-total-row {
            background: #0891b2;
        }
        
        .summary-total-row td {
            color: #fff;
            font-weight: bold;
            font-size: 12px;
            padding: 10px 12px;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }
        
        .footer-note {
            font-size: 9px;
            color: #6b7280;
            font-style: italic;
            margin-bottom: 5px;
        }
        
        .footer-contact {
            font-size: 8px;
            color: #9ca3af;
        }
        
        /* Bank Info */
        .bank-info {
            margin-top: 20px;
            padding: 12px;
            background: #f0fdfa;
            border: 1px solid #99f6e4;
            border-radius: 6px;
        }
        
        .bank-title {
            font-weight: bold;
            color: #0891b2;
            margin-bottom: 8px;
            font-size: 11px;
        }
        
        .bank-details {
            font-size: 10px;
            color: #1f2937;
            line-height: 1.6;
        }
        
        @media print {
            .container {
                padding: 20px 30px;
            }
            
            body {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('image/logo6.png');
        $logoData = "";
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
        }
        
        $bgPath = public_path('image/IMG_2327.PNG');
        $bgData = "";
        if (file_exists($bgPath)) {
            $bgData = base64_encode(file_get_contents($bgPath));
        }
    @endphp

    <!-- Background Watermark -->
    @if(isset($bgData) && $bgData)
        <img src="data:image/png;base64,{{ $bgData }}" class="background-watermark" alt="">
    @else
        <img src="{{ public_path('image/IMG_2327.PNG') }}" class="background-watermark" alt="">
    @endif
    
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <div class="company-logo-wrapper">
                    @if($logoData)
                        <img src="data:image/png;base64,{{ $logoData }}" alt="Logo" class="company-logo">
                    @else
                        <img src="{{ public_path('image/LOGO TOSCA.png') }}" alt="Logo" class="company-logo">
                    @endif
                </div>
                <div class="company-details">
                    {{ $company['phone'] ?? '+62 822-6647-8147' }} | {{ $company['email'] ?? 'justtrip.tour@gmail.com' }}<br>
                    {{ $company['address'] ?? 'Jl. Raya Pariwisata No. 123' }}
                </div>
                <div class="service-areas">
                    Based On:  Malang – Sleman – Bali
                </div>
            </div>
            <div class="invoice-info">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">No: {{ $invoice->invoice_number }}</div>
                <div class="invoice-date">
                    Tanggal: {{ $invoice->invoice_date->format('d M Y') }}<br>
                    Jatuh Tempo: {{ $invoice->due_date->format('d M Y') }}
                </div>
            </div>
        </div>

        <!-- Customer & Trip Info -->
        <div class="info-sections">
            <div class="info-column">
                <div class="section-header">Informasi Pelanggan</div>
                <div class="info-content">
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value">: {{ $customer['name'] ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat</span>
                        <span class="info-value">: {{ $customer['address'] ?? 'Alamat tidak tersedia' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Telepon</span>
                        <span class="info-value">: {{ $customer['phone'] ?? '-' }}</span>
                    </div>
                    @if(isset($customer['email']))
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">: {{ $customer['email'] }}</span>
                    </div>
                    @endif
                </div>
                
                <div class="payment-status-section">
                    <span class="status-badge status-{{ $invoice->status }}">
                        @if($invoice->status == 'paid' || $invoice->status == 'payment_confirmed')
                            SUDAH LUNAS
                        @elseif($invoice->status == 'payment_uploaded')
                            PROSES VALIDASI
                        @elseif($invoice->status == 'cancelled')
                            DIBATALKAN
                        @else
                            BELUM DIBAYAR
                        @endif
                    </span>
                    <div class="payment-info">
                        @php
                            $payment = $invoice->booking->paymentConfirmations
                                ->where('status', 'approved')
                                ->sortByDesc('created_at')
                                ->first() 
                                ?? $invoice->booking->paymentConfirmations->sortByDesc('created_at')->first();
                                
                            $bankMapping = [
                                'mandiri' => 'Bank Mandiri',
                                'bca' => 'Bank BCA',
                            ];

                            $paymentDate = '-';
                            if ($payment && $payment->payment_date) {
                                $paymentDate = \Carbon\Carbon::parse($payment->payment_date)->format('d M Y');
                            } elseif ($invoice->paid_at) {
                                $paymentDate = $invoice->paid_at->format('d M Y');
                            }
                        @endphp
                        <strong>Metode Pembayaran:</strong> {{ $payment ? ($payment->sender_bank_name ?: 'Transfer Bank') : 'Transfer Bank' }}<br>
                        <strong>Penerima:</strong> {{ $payment ? ($bankMapping[strtolower($payment->destination_bank)] ?? ucwords($payment->destination_bank)) : 'Bank Mandiri' }}<br>
                        <strong>Tanggal Bayar:</strong> {{ $paymentDate }}
                    </div>
                </div>
            </div>
            <div class="info-column">
                <div class="section-header">Detail Paket Perjalanan</div>
                <div class="info-content">
                    <div class="info-row">
                        <span class="info-label">Destinasi</span>
                        <span class="info-value">: {{ $layanan->nama_layanan ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Peserta</span>
                        <span class="info-value">: {{ $booking->jumlah_peserta ?? '-' }} orang</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Keberangkatan</span>
                        <span class="info-value">: {{ $booking->tanggal_keberangkatan ? $booking->tanggal_keberangkatan->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Durasi</span>
                        <span class="info-value">: {{ $layanan->durasi ?? 'Sesuai Paket' }}</span>
                    </div>
                    @if($booking->catatan_khusus)
                    <div class="info-row" style="margin-top: 10px;">
                        <span class="info-label">Catatan</span>
                        <span class="info-value">: {{ $booking->catatan_khusus }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Tour Package</th>
                    <th style="width: 10%;" class="text-center">Qty</th>
                    <th style="width: 20%;" class="text-right">Harga/Pax</th>
                    <th style="width: 20%;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $layanan->nama_layanan ?? '-' }}</strong>
                        @if($layanan->deskripsi_singkat ?? false)
                        <br><small style="color: #6b7280;">{{ $layanan->deskripsi_singkat }}</small>
                        @endif
                        @if($booking->specialOffer)
                        <br><small style="color: #059669; font-weight: bold;">Promo: {{ $booking->specialOffer->title }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $booking->jumlah_peserta ?? 1 }}</td>
                    @php
                        $pricePerPax = ($booking->jumlah_peserta > 0 && $booking->original_amount > 0) 
                            ? ($booking->original_amount / $booking->jumlah_peserta) 
                            : ($layanan->harga_mulai ?? 0);
                    @endphp
                    <td class="text-right">Rp {{ number_format($pricePerPax, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($booking->original_amount ?? $invoice->subtotal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-table-wrapper">
                <table class="summary-table">
                    @if(isset($invoice->discount_amount) && $invoice->discount_amount > 0)
                    <tr>
                        <td class="summary-label">Diskon</td>
                        <td class="summary-value">- Rp {{ number_format($invoice->discount_amount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr class="summary-total-row">
                        <td>GRAND TOTAL</td>
                        <td class="text-right">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Bank Info -->
        <div class="bank-info">
            <div class="bank-title">Informasi Pembayaran</div>
            <div class="bank-details" style="display: flex; gap: 40px;">
                <div style="flex: 1;">
                    <strong>Bank Mandiri</strong><br>
                    No. Rekening: 1780006783464<br>
                    Atas Nama: PT TRISULA PANDU NUSANTARA
                </div>
                <div style="flex: 1;">
                    <strong>Bank BCA</strong><br>
                    No. Rekening: 3305279999<br>
                    Atas Nama: PT TRISULA PANDU NUSANTARA
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-note">
                Terima kasih atas kepercayaan Anda menggunakan layanan Justtrip Tour Organizer!
            </div>
            <div class="footer-contact">
                {{ $company['email'] ?? 'justtrip.tour@gmail.com' }} | {{ $company['phone'] ?? '0821-3217-9440' }} | Generated: {{ $generated_at ?? now()->format('d M Y H:i') }}
            </div>
        </div>
    </div>
</body>
</html>