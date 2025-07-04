<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Reservasi - BabySpa</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9fafb;
      color: #374151;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .header {
      background: linear-gradient(135deg, #ec4899, #f472b6);
      color: white;
      padding: 32px 24px;
      text-align: center;
    }
    .header h1 {
      margin: 0;
      font-size: 28px;
      font-weight: bold;
    }
    .header p {
      margin: 8px 0 0 0;
      opacity: 0.9;
      font-size: 16px;
    }
    .content {
      padding: 32px 24px;
    }
    .greeting {
      font-size: 18px;
      margin-bottom: 16px;
    }
    .message {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 24px;
      color: #6b7280;
    }
    .details-card {
      background-color: #f9fafb;
      border-radius: 8px;
      padding: 24px;
      margin: 24px 0;
    }
    .details-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 16px;
      color: #111827;
    }
    .detail-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      border-bottom: 1px solid #e5e7eb;
    }
    .detail-row:last-child {
      border-bottom: none;
    }
    .detail-label {
      font-weight: 500;
      color: #6b7280;
    }
    .detail-value {
      font-weight: 600;
      color: #111827;
    }
    .status-badge {
      background-color: #10b981;
      color: white;
      padding: 4px 12px;
      border-radius: 16px;
      font-size: 14px;
      font-weight: 500;
    }
    .important-info {
      background-color: #fef3c7;
      border-left: 4px solid #f59e0b;
      padding: 16px;
      margin: 24px 0;
      border-radius: 0 4px 4px 0;
    }
    .important-info h3 {
      margin: 0 0 8px 0;
      color: #92400e;
      font-size: 16px;
    }
    .important-info p {
      margin: 0;
      color: #92400e;
      font-size: 14px;
    }
    .cta-button {
      display: inline-block;
      background-color: #ec4899;
      color: white;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      margin: 16px 0;
      text-align: center;
      transition: background-color 0.3s;
    }
    .cta-button:hover {
      background-color: #db2777;
    }
    .footer {
      background-color: #f9fafb;
      padding: 24px;
      text-align: center;
      border-top: 1px solid #e5e7eb;
    }
    .footer p {
      margin: 0;
      font-size: 14px;
      color: #6b7280;
    }
    .contact-info {
      margin-top: 16px;
      font-size: 14px;
      color: #6b7280;
    }
    @media (max-width: 600px) {
      .container {
        margin: 0;
        border-radius: 0;
      }
      .header, .content, .footer {
        padding: 24px 16px;
      }
      .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <h1>🌸 BabySpa</h1>
      <p>Spa & Perawatan Terbaik untuk Si Kecil</p>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="greeting">
        Halo <strong>{{ $customerName }}</strong>! 👋
      </div>

      <div class="message">
        Terima kasih telah mempercayakan perawatan si kecil kepada kami. Reservasi Anda telah berhasil dikonfirmasi dan kami sangat menantikan untuk memberikan pelayanan terbaik.
      </div>

      <!-- Reservation Details -->
      <div class="details-card">
        <div class="details-title">📋 Detail Reservasi</div>
        
        <div class="detail-row">
          <span class="detail-label">ID Reservasi</span>
          <span class="detail-value">#{{ $reservationId }}</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Status</span>
          <span class="status-badge">Dikonfirmasi</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Layanan</span>
          <span class="detail-value">{{ $serviceName }}</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Untuk Anak</span>
          <span class="detail-value">{{ $childName }}</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Tanggal & Waktu</span>
          <span class="detail-value">{{ $appointmentDate }}, {{ $appointmentTime }}</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Lokasi</span>
          <span class="detail-value">{{ $location }}</span>
        </div>
      </div>

      <!-- Payment Summary -->
      <div class="details-card">
        <div class="details-title">💳 Ringkasan Pembayaran</div>
        
        <div class="detail-row">
          <span class="detail-label">Biaya Layanan</span>
          <span class="detail-value">Rp {{ number_format($serviceAmount, 0, ',', '.') }}</span>
        </div>
        
        {{-- <div class="detail-row">
          <span class="detail-label">PPN (11%)</span>
          <span class="detail-value">Rp {{ number_format($tax, 0, ',', '.') }}</span>
        </div> --}}
        
        @if($discount > 0)
        <div class="detail-row">
          <span class="detail-label">Diskon</span>
          <span class="detail-value">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
        </div>
        @endif
        
        <div class="detail-row">
          <span class="detail-label"><strong>Total Dibayar</strong></span>
          <span class="detail-value"><strong>Rp {{ number_format($totalAmount, 0, ',', '.') }}</strong></span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Metode Pembayaran</span>
          <span class="detail-value">{{ $paymentMethod }}</span>
        </div>
      </div>

      <!-- Important Information -->
      <div class="important-info">
        <h3>📌 Informasi Penting</h3>
        <p>
          • Harap datang 15 menit sebelum jadwal<br>
          • Hubungi kami jika ada perubahan jadwal<br>
        </p>
      </div>

      <!-- Call to Action -->
      <div style="text-align: center;">
        <a href="{{ route('dashboard') }}" class="cta-button">Lihat Detail di Dashboard</a>
      </div>

      <div class="message">
        Jika Anda memiliki pertanyaan atau perlu bantuan, jangan ragu untuk menghubungi tim customer service kami. Kami siap membantu Anda 24/7.
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p><strong>Latumi - Perawatan Bayi Terpercaya</strong></p>
      
      <div class="contact-info">
        📍 Jl. Perjuangan Baru No.2, Gn. Pangilun<br>
        📞 +62 812 1293 3442<br>
        📧 latumi@gmail.com<br>
        🌐 www.latumi.com
      </div>
      
      <p style="margin-top: 16px; font-size: 12px;">
        Email ini dikirim otomatis. Mohon tidak membalas email ini.<br>
        © {{ date('Y') }} Latumi. Semua hak dilindungi.
      </p>
    </div>
  </div>
</body>
</html>
</html>