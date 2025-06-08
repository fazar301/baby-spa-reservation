<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice - BabySpa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            babypink: {
              50: '#fdf2f8',
              100: '#fce7f3',
              200: '#fbcfe8',
              300: '#f9a8d4',
              400: '#f472b6',
              500: '#ec4899',
              600: '#db2777',
              700: '#be185d',
              800: '#9d174d',
              900: '#831843'
            }
          }
        }
      }
    }
  </script>
  <style>
    @media print {
      body { margin: 0; }
      .no-print { display: none; }
    }
  </style>
</head>
<body class="bg-white">
  <div class="max-w-2xl mx-auto p-8">
    <!-- Print Button -->
    <div class="no-print mb-4 text-center">
      <button onclick="window.print()" class="bg-babypink-500 hover:bg-babypink-600 text-white px-6 py-2 rounded-md mr-2">
        Download PDF
      </button>
      <button onclick="window.close()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md">
        Tutup
      </button>
    </div>

    <!-- Invoice Content -->
    <div class="bg-white" id="invoice-content">
      <!-- Header -->
      <div class="flex justify-between items-start mb-8">
        <div>
          <div class="flex items-center gap-3 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-babypink-500">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            <h1 class="text-2xl font-bold text-gray-900">BabySpa</h1>
          </div>
          <div class="text-sm text-gray-600">
            <p>Jl. Contoh No. 123</p>
            <p>Jakarta Selatan, 12345</p>
            <p>Indonesia</p>
            <p>Telp: +62 21 1234 5678</p>
            <p>Email: info@babyspa.com</p>
          </div>
        </div>
        <div class="text-right">
          <h2 class="text-2xl font-bold text-gray-900 mb-2">INVOICE</h2>
          <div class="text-sm text-gray-600">
            <p><span class="font-medium">No. Invoice:</span> <span id="invoice-number">RSV-1234</span></p>
            <p><span class="font-medium">Tanggal:</span> <span id="invoice-date">28 April 2025</span></p>
          </div>
        </div>
      </div>

      <!-- Customer Info -->
      <div class="mb-8">
        <h3 class="text-lg font-semibold mb-3">Tagihan Kepada:</h3>
        <div class="bg-gray-50 p-4 rounded-lg">
          <p class="font-medium text-gray-900" id="customer-name">John Doe</p>
          <p class="text-gray-600" id="customer-email">john.doe@email.com</p>
        </div>
      </div>

      <!-- Reservation Details -->
      <div class="mb-8">
        <h3 class="text-lg font-semibold mb-3">Detail Reservasi:</h3>
        <div class="bg-gray-50 p-4 rounded-lg space-y-2">
          <div class="flex justify-between">
            <span class="text-gray-600">ID Reservasi:</span>
            <span class="font-medium" id="reservation-id">12345</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Layanan:</span>
            <span class="font-medium" id="service-name">Pijat Bayi</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Untuk Anak:</span>
            <span class="font-medium" id="child-name">Aditya</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Tanggal & Waktu:</span>
            <span class="font-medium"><span id="appointment-date">28 April 2025</span>, <span id="appointment-time">10:00 - 11:00</span></span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Terapis:</span>
            <span class="font-medium" id="therapist">Dr. Siti</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Lokasi:</span>
            <span class="font-medium" id="location">Cabang Utama</span>
          </div>
        </div>
      </div>

      <!-- Payment Details -->
      <div class="mb-8">
        <h3 class="text-lg font-semibold mb-3">Rincian Pembayaran:</h3>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-900">Deskripsi</th>
                <th class="px-4 py-3 text-right text-sm font-medium text-gray-900">Jumlah</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-4 py-3 text-sm text-gray-900" id="service-description">Pijat Bayi</td>
                <td class="px-4 py-3 text-sm text-gray-900 text-right" id="service-amount">Rp 250.000</td>
              </tr>
              <tr>
                <td class="px-4 py-3 text-sm text-gray-900">Pajak (11%)</td>
                <td class="px-4 py-3 text-sm text-gray-900 text-right" id="tax-amount">Rp 27.500</td>
              </tr>
              <tr class="bg-gray-50">
                <td class="px-4 py-3 text-sm font-semibold text-gray-900">Total</td>
                <td class="px-4 py-3 text-sm font-semibold text-gray-900 text-right" id="total-amount">Rp 277.500</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Payment Info -->
      <div class="mb-8">
        <h3 class="text-lg font-semibold mb-3">Informasi Pembayaran:</h3>
        <div class="bg-green-50 p-4 rounded-lg">
          <div class="flex justify-between mb-2">
            <span class="text-gray-600">Status Pembayaran:</span>
            <span class="font-medium text-green-600">Lunas</span>
          </div>
          <div class="flex justify-between mb-2">
            <span class="text-gray-600">Metode Pembayaran:</span>
            <span class="font-medium" id="payment-method">Transfer Bank</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Tanggal Pembayaran:</span>
            <span class="font-medium" id="payment-date">28 April 2025</span>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="border-t pt-6">
        <div class="text-center text-sm text-gray-600">
          <p class="mb-2">Terima kasih telah menggunakan layanan BabySpa!</p>
          <p>Jika ada pertanyaan mengenai invoice ini, silakan hubungi kami di info@babyspa.com</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Function to populate invoice data
    function populateInvoice(data) {
      document.getElementById('invoice-number').textContent = `RSV-${data.reservationId}`;
      document.getElementById('invoice-date').textContent = data.paymentDate || new Date().toLocaleDateString('id-ID');
      document.getElementById('customer-name').textContent = data.customerName;
      document.getElementById('customer-email').textContent = data.customerEmail;
      document.getElementById('reservation-id').textContent = data.reservationId;
      document.getElementById('service-name').textContent = data.serviceName;
      document.getElementById('service-description').textContent = data.serviceName;
      document.getElementById('child-name').textContent = data.childName;
      document.getElementById('appointment-date').textContent = data.appointmentDate;
      document.getElementById('appointment-time').textContent = data.appointmentTime;
      document.getElementById('therapist').textContent = data.therapist;
      document.getElementById('location').textContent = data.location;
      document.getElementById('service-amount').textContent = `Rp ${data.serviceAmount.toLocaleString('id-ID')}`;
      document.getElementById('tax-amount').textContent = `Rp ${data.tax.toLocaleString('id-ID')}`;
      document.getElementById('total-amount').textContent = `Rp ${data.totalAmount.toLocaleString('id-ID')}`;
      document.getElementById('payment-method').textContent = data.paymentMethod;
      document.getElementById('payment-date').textContent = data.paymentDate;
    }

    // Example usage (can be called from parent window)
    // populateInvoice({
    //   reservationId: "12345",
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