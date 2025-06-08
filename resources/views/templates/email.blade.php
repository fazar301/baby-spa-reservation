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
        Halo <strong id="customer-name">Ibu Sarah</strong>! 👋
      </div>

      <div class="message">
        Terima kasih telah mempercayakan perawatan si kecil kepada kami. Reservasi Anda telah berhasil dikonfirmasi dan kami sangat menantikan untuk memberikan pelayanan terbaik.
      </div>

      <!-- Reservation Details -->
      <div class="details-card">
        <div class="details-title">📋 Detail Reservasi</div>
        
        <div class="detail-row">
          <span class="detail-label">ID Reservasi</span>
          <span class="detail-value" id="reservation-id">#RSV-12345</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Status</span>
          <span class="status-badge">Dikonfirmasi</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Layanan</span>
          <span class="detail-value" id="service-name">Pijat Bayi</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Untuk Anak</span>
          <span class="detail-value" id="child-name">Aditya</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Tanggal & Waktu</span>
          <span class="detail-value"><span id="appointment-date">28 April 2025</span>, <span id="appointment-time">10:00 - 11:00</span></span>
        </div>
        
        
        
        <div class="detail-row">
          <span class="detail-label">Lokasi</span>
          <span class="detail-value" id="location">Jl. Perjuangan Baru No.2, Gn. Pangilun</span>
        </div>
      </div>

      <!-- Payment Summary -->
      <div class="details-card">
        <div class="details-title">💳 Ringkasan Pembayaran</div>
        
        <div class="detail-row">
          <span class="detail-label">Biaya Layanan</span>
          <span class="detail-value" id="service-amount">Rp 250.000</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Pajak (11%)</span>
          <span class="detail-value" id="tax-amount">Rp 27.500</span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label"><strong>Total Dibayar</strong></span>
          <span class="detail-value"><strong id="total-amount">Rp 277.500</strong></span>
        </div>
        
        <div class="detail-row">
          <span class="detail-label">Metode Pembayaran</span>
          <span class="detail-value" id="payment-method">Transfer Bank</span>
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
        <a href="#" class="cta-button">Lihat Detail di Dashboard</a>
      </div>

      <div class="message">
        Jika Anda memiliki pertanyaan atau perlu bantuan, jangan ragu untuk menghubungi tim customer service kami. Kami siap membantu Anda 24/7.
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p><strong>BabySpa - Spa & Perawatan Bayi Terpercaya</strong></p>
      
      <div class="contact-info">
        📍 Jl. Sudirman No. 123, Jakarta Selatan<br>
        📞 +62 21 1234 5678<br>
        📧 info@babyspa.com<br>
        🌐 www.babyspa.com
      </div>
      
      <p style="margin-top: 16px; font-size: 12px;">
        Email ini dikirim otomatis. Mohon tidak membalas email ini.<br>
        © 2025 BabySpa. Semua hak dilindungi.
      </p>
    </div>
  </div>

  <script>
    // Function to populate email data (for testing purposes)
    function populateEmail(data) {
      document.getElementById('customer-name').textContent = data.customerName;
      document.getElementById('reservation-id').textContent = `#${data.reservationId}`;
      document.getElementById('service-name').textContent = data.serviceName;
      document.getElementById('child-name').textContent = data.childName;
      document.getElementById('appointment-date').textContent = data.appointmentDate;
      document.getElementById('appointment-time').textContent = data.appointmentTime;
      document.getElementById('therapist').textContent = data.therapist;
      document.getElementById('location').textContent = data.location;
      document.getElementById('service-amount').textContent = `Rp ${data.serviceAmount.toLocaleString('id-ID')}`;
      document.getElementById('tax-amount').textContent = `Rp ${data.tax.toLocaleString('id-ID')}`;
      document.getElementById('total-amount').textContent = `Rp ${data.totalAmount.toLocaleString('id-ID')}`;
      document.getElementById('payment-method').textContent = data.paymentMethod;
    }

    // Example usage
    // populateEmail({
    //   customerName: "Ibu Sarah",
    //   reservationId: "RSV-12345",
    //   serviceName: "Pijat Bayi",
    //   childName: "Aditya",
    //   appointmentDate: "28 April 2025",
    //   appointmentTime: "10:00 - 11:00",
    //   location: "Cabang Utama - Jl. Sudirman No. 123",
    //   serviceAmount: 250000,
    //   tax: 27500,
    //   totalAmount: 277500,
    //   paymentMethod: "Transfer Bank"
    // });
  </script>
</body>
</html>