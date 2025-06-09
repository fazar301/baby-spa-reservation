<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice - BabySpa</title>
  <style>
    @font-face {
      font-family: 'DejaVu Sans';
      src: url('{{ storage_path('fonts/DejaVuSans.ttf') }}') format('truetype');
    }
    
    body {
      margin: 0;
      padding: 0;
      background-color: #ffffff;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
      color: #333333;
    }
    
    .container {
      max-width: 672px;
      margin: 0 auto;
      padding: 32px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .no-print {
      margin-bottom: 16px;
      text-align: center;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .btn {
      padding: 8px 24px;
      border: none;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      margin-right: 8px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .btn-primary {
      background-color: #ec4899;
    }
    
    .btn-primary:hover {
      background-color: #db2777;
    }
    
    .btn-secondary {
      background-color: #6b7280;
    }
    
    .btn-secondary:hover {
      background-color: #4b5563;
    }
    
    .invoice-content {
      background-color: white;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .header {
      margin-bottom: 32px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .header-flex {
      width: 100%;
    }
    
    .header-flex:after {
      content: "";
      display: table;
      clear: both;
    }
    
    .company-section {
      float: left;
      width: 50%;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .invoice-section {
      float: right;
      width: 50%;
      text-align: right;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .company-header {
      margin-bottom: 8px;
    }
    
    .company-icon {
      width: 32px;
      height: 32px;
      color: #ec4899;
      display: inline-block;
      vertical-align: middle;
      margin-right: 12px;
    }
    
    .company-name {
      font-size: 24px;
      font-weight: bold;
      color: #111827;
      display: inline-block;
      vertical-align: middle;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .company-details {
      font-size: 14px;
      color: #6b7280;
      line-height: 1.4;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .invoice-title {
      font-size: 24px;
      font-weight: bold;
      color: #111827;
      margin-bottom: 8px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .invoice-meta {
      font-size: 14px;
      color: #6b7280;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .section {
      margin-bottom: 32px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .section-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #111827;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .info-box {
      background-color: #f9fafb;
      padding: 16px;
      border-radius: 8px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .customer-name {
      font-weight: bold;
      color: #111827;
      margin-bottom: 4px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .customer-email {
      color: #6b7280;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .detail-box {
      background-color: #f9fafb;
      padding: 16px;
      border-radius: 8px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .detail-row {
      margin-bottom: 8px;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .detail-row:after {
      content: "";
      display: table;
      clear: both;
    }
    
    .detail-label {
      color: #6b7280;
      float: left;
      width: 40%;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .detail-value {
      font-weight: bold;
      color: #111827;
      float: right;
      width: 60%;
      text-align: right;
      font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
    }
    
    .payment-table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
    }
    
    .table-header {
      background-color: #f9fafb;
    }
    
    .table-header th {
      padding: 12px 16px;
      text-align: left;
      font-size: 14px;
      font-weight: bold;
      color: #111827;
    }
    
    .table-header .text-right {
      text-align: right;
    }
    
    .table-body td {
      padding: 12px 16px;
      font-size: 14px;
      color: #111827;
      border-top: 1px solid #e5e7eb;
    }
    
    .table-body .text-right {
      text-align: right;
    }
    
    .table-total {
      background-color: #f9fafb;
    }
    
    .table-total td {
      font-weight: 600;
    }
    
    .payment-info-box {
      background-color: #f0fdf4;
      padding: 16px;
      border-radius: 8px;
    }
    
    .payment-status {
      color: #16a34a;
      font-weight: bold;
    }
    
    .footer {
      border-top: 1px solid #e5e7eb;
      padding-top: 24px;
      text-align: center;
      font-size: 14px;
      color: #6b7280;
    }
    
    .footer p {
      margin-bottom: 8px;
    }
    
    @media print {
      body { 
        margin: 0; 
      }
      .no-print { 
        display: none; 
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Invoice Content -->
    <div class="invoice-content" id="invoice-content">
      <!-- Header -->
      <div class="header">
        <div class="header-flex">
          <div class="company-section">
            <div class="company-header">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="company-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
              </svg>
              <h1 class="company-name">BabySpa</h1>
            </div>
            <div class="company-details">
              <p>Jl. Contoh No. 123</p>
              <p>Jakarta Selatan, 12345</p>
              <p>Indonesia</p>
              <p>Telp: +62 21 1234 5678</p>
              <p>Email: info@babyspa.com</p>
            </div>
          </div>
          <div class="invoice-section">
            <h2 class="invoice-title">INVOICE</h2>
            <div class="invoice-meta">
              <p><span style="font-weight: bold;">No. Reservasi:</span> <span id="invoice-number">RSV-1234</span></p>
              <p><span style="font-weight: bold;">Tanggal:</span> <span id="invoice-date">28 April 2025</span></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Customer Info -->
      <div class="section">
        <h3 class="section-title">Tagihan Kepada:</h3>
        <div class="info-box">
          <p class="customer-name" id="customer-name">John Doe</p>
          <p class="customer-email" id="customer-email">john.doe@email.com</p>
        </div>
      </div>

      <!-- Reservation Details -->
      <div class="section">
        <h3 class="section-title">Detail Reservasi:</h3>
        <div class="detail-box">
          <div class="detail-row">
            <span class="detail-label">Kode Reservasi:</span>
            <span class="detail-value" id="reservation-kode">RSV-1234</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Layanan:</span>
            <span class="detail-value" id="service-name">Pijat Bayi</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Untuk Anak:</span>
            <span class="detail-value" id="child-name">Aditya</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Tanggal & Waktu:</span>
            <span class="detail-value"><span id="appointment-date">28 April 2025</span>, <span id="appointment-time">10:00 - 11:00</span></span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Lokasi:</span>
            <span class="detail-value" id="location">Jl. Perjuangan Baru No.2, Gn. Pangilun</span>
          </div>
        </div>
      </div>

      <!-- Payment Details -->
      <div class="section">
        <h3 class="section-title">Rincian Pembayaran:</h3>
        <table class="payment-table">
          <thead class="table-header">
            <tr>
              <th>Deskripsi</th>
              <th class="text-right">Jumlah</th>
            </tr>
          </thead>
          <tbody class="table-body">
            <tr>
              <td>{{ $serviceName }}</td>
              <td class="text-right">Rp {{ number_format($serviceAmount, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <td>PPN (11%)</td>
              <td class="text-right">Rp {{ number_format($tax, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <td>Diskon</td>
              <td class="text-right">- Rp {{ number_format($discount, 0, ',', '.') }}</td>
            </tr>
            <tr class="table-total">
              <td>Total</td>
              <td class="text-right">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Payment Info -->
      <div class="section">
        <h3 class="section-title">Informasi Pembayaran:</h3>
        <div class="payment-info-box">
          <div class="detail-row">
            <span class="detail-label">Status Pembayaran:</span>
            <span class="detail-value payment-status">Lunas</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Metode Pembayaran:</span>
            <span class="detail-value" id="payment-method">Transfer Bank</span>
          </div>
          <div class="detail-row">
            <span class="detail-label">Tanggal Pembayaran:</span>
            <span class="detail-value" id="payment-date">28 April 2025</span>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="footer">
        <p style="margin-bottom: 8px;">Terima kasih telah menggunakan layanan BabySpa!</p>
        <p>Jika ada pertanyaan mengenai invoice ini, silakan hubungi kami di info@babyspa.com</p>
      </div>
    </div>
  </div>

  <script>
    // Function to populate invoice data
    function populateInvoice(data) {
      document.getElementById('invoice-number').textContent = `RSV-${data.reservationKode}`;
      document.getElementById('invoice-date').textContent = data.paymentDate || new Date().toLocaleDateString('id-ID');
      document.getElementById('customer-name').textContent = data.customerName;
      document.getElementById('customer-email').textContent = data.customerEmail;
      document.getElementById('reservation-kode').textContent = data.reservationKode;
      document.getElementById('service-name').textContent = data.serviceName;
      document.getElementById('service-description').textContent = data.serviceName;
      document.getElementById('child-name').textContent = data.childName;
      document.getElementById('appointment-date').textContent = data.appointmentDate;
      document.getElementById('appointment-time').textContent = data.appointmentTime;
      document.getElementById('location').textContent = data.location;
      document.getElementById('service-amount').textContent = `Rp ${data.serviceAmount.toLocaleString('id-ID')}`;
      document.getElementById('tax-amount').textContent = `Rp ${data.tax.toLocaleString('id-ID')}`;
      document.getElementById('discount-amount').textContent = `Rp ${data.discount.toLocaleString('id-ID')}`;
      document.getElementById('total-amount').textContent = `Rp ${data.totalAmount.toLocaleString('id-ID')}`;
      document.getElementById('payment-method').textContent = data.paymentMethod;
      document.getElementById('payment-date').textContent = data.paymentDate;
    }

    // Example usage (can be called from parent window)
    // populateInvoice({
    //   reservationKode: "RSV-1234",
    //   customerName: "John Doe",
    //   customerEmail: "john.doe@email.com",
    //   serviceName: "Pijat Bayi",
    //   childName: "Aditya",
    //   appointmentDate: "28 April 2025",
    //   appointmentTime: "10:00 - 11:00",
    //   therapist: "Dr. Siti",
    //   location: "Cabang Utama",
    //   serviceAmount: 250000,
    //   tax: 27500,
    //   totalAmount: 277500,
    //   paymentMethod: "Transfer Bank",
    //   paymentDate: "28 April 2025"
    // });
  </script>
</body>
</html>
