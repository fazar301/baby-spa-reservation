<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Baby Spa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 100%;
            margin: 0;
            padding: 30px;
            background: white;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: white;
        }
        
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #ec4899;
        }
        
        .company-info {
            flex: 1;
        }
        
        .company-logo {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
        }
        
        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #ec4899;
            margin-bottom: 5px;
        }
        
        .company-tagline {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .company-details {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }
        
        .invoice-meta {
            text-align: right;
            flex: 1;
        }
        
        .invoice-title {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .invoice-number {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .invoice-date {
            font-size: 14px;
            color: #666;
        }
        
        .invoice-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .status-paid {
            background: #dcfce7;
            color: #166534;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .invoice-parties {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }
        
        .party-section {
            flex: 1;
            margin-right: 40px;
        }
        
        .party-section:last-child {
            margin-right: 0;
        }
        
        .party-title {
            font-size: 14px;
            font-weight: bold;
            color: #ec4899;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .party-details {
            background: #fdf2f8;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #ec4899;
        }
        
        .party-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        
        .party-info {
            font-size: 14px;
            color: #666;
            margin-bottom: 4px;
        }
        
        .invoice-items {
            margin-bottom: 40px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .items-table th {
            background: #ec4899;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
            font-size: 14px;
        }
        
        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }
        
        .items-table tr:nth-child(even) {
            background: #fdf2f8;
        }
        
        .item-description {
            font-weight: 500;
            color: #333;
        }
        
        .item-details {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .invoice-summary {
            margin-left: auto;
            width: 300px;
            background: #f9fafb;
            border-radius: 8px;
            padding: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .summary-row.total {
            border-top: 2px solid #ec4899;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #ec4899;
        }
        
        .invoice-notes {
            margin-top: 40px;
            padding: 20px;
            background: #f0f9ff;
            border-radius: 8px;
            border-left: 4px solid #0ea5e9;
        }
        
        .notes-title {
            font-size: 16px;
            font-weight: bold;
            color: #0369a1;
            margin-bottom: 10px;
        }
        
        .notes-content {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }
        
        .invoice-footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        
        .footer-thanks {
            font-size: 18px;
            font-weight: bold;
            color: #ec4899;
            margin-bottom: 10px;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .invoice-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    

    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="company-info" style="float: left">
                <img src="/images/baby-spa-logo.png" alt="Baby Spa Logo" class="company-logo">
                <div class="company-name">Baby Spa</div>
                <div class="company-tagline">Perawatan Terbaik untuk Si Kecil</div>
                <div class="company-details">
                    Jl. Kemang Raya No. 123, Jakarta Selatan 12560<br>
                    Telp: (021) 7890-1234 | WhatsApp: 0812-3456-7890<br>
                    Email: info@babyspa-blade.com | www.babyspa-blade.com
                </div>
            </div>
            <div class="invoice-meta">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">{{ $reservation->kode }}</div>
                <div class="invoice-date">{{ $payment->created_at->format('d F Y') }}</div>
                <div class="" style="clear: both"></div>
                <div style="margin-top: -40px" class="invoice-status {{ $payment->status === 'paid' ? 'status-paid' : ($payment->status === 'pending' ? 'status-pending' : 'status-cancelled') }}">
                    {{ $payment->status === 'paid' ? 'LUNAS' : ($payment->status === 'pending' ? 'MENUNGGU PEMBAYARAN' : 'DIBATALKAN') }}
                </div>
            </div>
        </div>

        <!-- Invoice Parties -->
        <div class="invoice-parties">
            <div class="party-section">
                <div class="party-title">Tagihan Kepada</div>
                <div class="party-details">
                    <div class="party-name">{{ $reservation->parent_name }}</div>
                    <div class="party-info">{{ $reservation->email }}</div>
                    <div class="party-info">{{ $reservation->phone }}</div>
                    @if($reservation->address)
                        <div class="party-info">{{ $reservation->address }}</div>
                    @endif
                </div>
            </div>
            <div class="party-section">
                <div class="party-title">Detail Bayi</div>
                <div class="party-details">
                    <div class="party-name">{{ $reservation->baby_name }}</div>
                    <div class="party-info">Usia: {{ $reservation->baby_age_formatted }}</div>
                    @if($reservation->baby_birth_weight)
                        <div class="party-info">Berat Lahir: {{ $reservation->baby_birth_weight }} kg</div>
                    @endif
                    @if($reservation->baby_current_weight)
                        <div class="party-info">Berat Sekarang: {{ $reservation->baby_current_weight }} kg</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Invoice Items -->
        <div class="invoice-items">
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 50%">Layanan</th>
                        <th style="width: 20%">Tanggal & Waktu</th>
                        <th style="width: 15%" class="text-right">Harga</th>
                        <th style="width: 15%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="item-description">{{ $reservation->service_name }}</div>
                            <div class="item-details">
                                Lokasi: Jl. Kemang Raya No. 123, Jakarta Selatan 12560<br>
                            </div>
                        </td>
                        <td>
                            {{ $reservation->formatted_appointment_date }}<br>
                            <small>{{ $reservation->appointment_time }} WIB</small>
                        </td>
                        <td class="text-right">{{ 'Rp ' . number_format($reservation->service_price, 0, ',', '.') }}</td>
                        <td class="text-right">{{ 'Rp ' . number_format($reservation->service_price, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Invoice Summary -->
            <div class="invoice-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>{{ 'Rp ' . number_format($reservation->service_price, 0, ',', '.') }}</span>
                </div>
                @if($payment->discount_amount > 0)
                    <div class="summary-row">
                        <span>Diskon :</span>
                        <span>-{{ 'Rp ' . number_format($payment->discount_amount, 0, ',', '.') }}</span>
                    </div>
                @endif
                <div class="summary-row">
                    <span>PPN (11%):</span>
                    <span>{{ 'Rp ' . number_format(($payment->jumlah - ($payment->discount_amount ?? 0)) * 0.11, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>{{ 'Rp ' . number_format($payment->jumlah, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="invoice-notes">
            <div class="notes-title">Informasi Pembayaran</div>
            <div class="notes-content">
                <strong>Metode Pembayaran:</strong> 
                {{ strtoupper($payment->payment_method) }}<br>
                
                @if($payment->payment_method === 'cash')
                    <strong>Status:</strong> Pembayaran akan dilakukan saat kedatangan di Baby Spa.<br>
                @else
                    <strong>Status:</strong> {{ $payment->status === 'paid' ? 'Pembayaran telah diterima' : 'Menunggu konfirmasi pembayaran' }}<br>
                @endif
                
                <strong>Tanggal Invoice:</strong> {{ $payment->created_at->format('d F Y, H:i') }} WIB<br>
                
                @if($payment->paid_at)
                    <strong>Tanggal Pembayaran:</strong> {{ $payment->paid_at->format('d F Y, H:i') }} WIB<br>
                @endif
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="invoice-notes" style="background: #fef7ff; border-left-color: #ec4899;">
            <div class="notes-title" style="color: #ec4899;">Syarat dan Ketentuan</div>
            <div class="notes-content">
                1. Pembayaran tunai dilakukan saat kedatangan di Baby Spa.<br>
                2. Pembatalan reservasi dapat dilakukan maksimal 24 jam sebelum jadwal.<br>
                3. Keterlambatan lebih dari 15 menit dapat mengakibatkan pembatalan otomatis.<br>
                4. Harap membawa perlengkapan bayi yang diperlukan (popok, baju ganti).<br>
                5. Untuk pertanyaan, hubungi customer service kami di (021) 7890-1234.
            </div>
        </div>

        <!-- Invoice Footer -->
        <div class="invoice-footer">
            <div class="footer-thanks">Terima kasih telah mempercayai Baby Spa!</div>
            <p>Invoice ini dibuat secara otomatis dan sah tanpa tanda tangan.</p>
            <p>Baby Spa - Perawatan Terbaik untuk Si Kecil</p>
        </div>
    </div>

    
</body>
</html>
