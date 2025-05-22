<!DOCTYPE html>
<html>
<head>
    <title>Invoice Reservasi - {{ $reservation->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 10pt;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #000;
        }
        .header h1 {
            font-size: 24pt;
            margin: 0;
        }
        .header .company-info {
            text-align: right;
        }
        .header .logo {
            max-width: 80px;
            margin-left: 10px;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .details .left, .details .right {
            width: 48%;
        }
        .details .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .details p {
            margin: 0 0 5px 0;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .table-row-grey {
             background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .total-summary {
            width: 50%;
            margin-left: auto;
            margin-top: 20px;
        }
        .total-summary div {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .total-summary .label {
             font-weight: normal; /* Override default bold */
        }
        .total-summary .value {
            font-weight: bold;
        }
        .total-summary .total {
            border-top: 1px solid #000;
            font-size: 12pt;
        }
         .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
         }
         .footer .left {
            width: 48%;
         }
        .footer .signature {
            text-align: center;
            width: 48%;
            margin-top: 20px;
        }
        .signature .line {
            border-bottom: 1px solid #000;
            height: 20px; /* Space for signature */
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>INVOICE</h1>
            <div class="company-info">
                <h2>SALFORD & CO.</h2> <!-- Replace with your company name -->
                <p>Fashion Terlengkap</p> <!-- Replace with your company tagline -->
                <!-- Optional: Add logo -->
                {{-- <img src="{{ public_path('images/your-logo.png') }}" alt="Logo" class="logo"> --}}
            </div>
        </div>

        <div class="details">
            <div class="left">
                <div class="label">KEPADA :</div>
                <p>{{ $reservation->user->name ?? 'N/A' }}</p>
                <p>{{ $reservation->user->email ?? 'N/A' }}</p>
            </div>
            <div class="right text-right">
                <div class="label">TANGGAL :</div>
                <p>{{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                <div class="label" style="margin-top: 10px;">NO INVOICE :</div>
                <p>{{ $reservation->id ?? 'N/A' }} / {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="section-title">KETERANGAN</div>
        <table>
            <thead>
                <tr>
                    <th>KETERANGAN</th>
                    <th class="text-right">HARGA</th>
                    <th class="text-right">JML</th>
                    <th class="text-right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                {{-- Assuming a single service or package per reservation --}}
                <tr class="table-row-grey">
                    <td>
                        @if($reservation->type === 'layanan')
                            {{ $reservation->layanan->nama_layanan ?? 'Layanan' }}
                        @else
                            {{ $reservation->paketLayanan->nama_paket ?? 'Paket Layanan' }}
                        @endif
                    </td>
                    <td class="text-right">{{ 'Rp ' . number_format($reservation->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">1</td> {{-- Assuming quantity is always 1 for a reservation --}}
                    <td class="text-right">{{ 'Rp ' . number_format($reservation->harga ?? 0, 0, ',', '.') }}</td>
                </tr>
                {{-- Add more rows here if a reservation can include multiple items --}}
            </tbody>
        </table>

        <div class="details">
             <div class="left">
                 <div class="section-title">PEMBAYARAN :</div>
                 {{-- This section might vary based on how payment is recorded --}}
                 <p>Metode: {{ $reservation->payment_method ?? 'Belum Dibayar / Tunai' }}</p>
                 @if(isset($reservation->payment_details) && $reservation->payment_method === 'midtrans')
                     <p>Nama Bank/E-wallet: {{ $reservation->payment_details->bank ?? $reservation->payment_details->payment_type ?? 'N/A' }}</p>
                     <p>Nomor Transaksi: {{ $reservation->payment_details->transaction_id ?? 'N/A' }}</p>
                 @elseif($reservation->payment_method === 'cash')
                     <p>Status: Belum dibayar (Tunai di tempat)</p>
                 @endif
                 {{-- Add bank details if payment is via transfer and recorded --}}
                 {{-- <p>Nama: Salford & Co.</p> --}}
                 {{-- <p>No Rek: +123-456-7890</p> --}}
             </div>
             <div class="right total-summary">
                 <div>
                     <span class="label">SUB TOTAL :</span>
                     <span class="value">{{ 'Rp ' . number_format($reservation->harga ?? 0, 0, ',', '.') }}</span>
                 </div>
                 @php
                     $discount = $reservation->discount_amount ?? 0;
                     $finalTotal = $reservation->final_amount ?? $reservation->harga ?? 0; // Use final_amount if available, else fallback to harga
                 @endphp
                 @if($discount > 0)
                 <div>
                     <span class="label">Diskon Voucher :</span>
                     <span class="value text-green-600">-Rp {{ number_format($discount, 0, ',', '.') }}</span>
                 </div>
                 @endif
                 {{-- Assuming no separate tax is shown in your system based on pembayaran.blade.php --}}
                 {{-- <div>
                     <span class="label">PAJAK :</span>
                     <span class="value">Rp 80,000</span>
                 </div> --}}
                 <div class="total">
                     <span class="label">TOTAL :</span>
                     <span class="value">{{ 'Rp ' . number_format($finalTotal, 0, ',', '.') }}</span>
                 </div>
             </div>
         </div>


        <div class="footer">
            <div class="left">
                 <div class="section-title">TERIMAKASIH ATAS PEMBELIAN ANDA</div>
                 {{-- Add any additional notes or QR code here --}}
            </div>
            <div class="signature">
                {{-- Assuming a fixed signatory or dynamic based on system --}}
                <div class="line"></div>
                <p>Juliana Silva</p> {{-- Replace with actual signatory name --}}
            </div>
        </div>
    </div>
</body>
</html>