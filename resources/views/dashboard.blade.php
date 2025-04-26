<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BabySpa - Dashboard</title>
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
            },
            babyblue: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e'
            },
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50">
  <div class="min-h-screen flex">
    <!-- Mobile Sidebar Trigger -->
    <button id="sidebarTrigger" class="fixed top-2 left-2 z-50 rounded-xl shadow-lg border bg-white hover:bg-gray-50 md:hidden p-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
    </button>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>
    
    <!-- Sidebar -->
    <div id="sidebar" class="fixed md:static left-0 top-0 bottom-0 w-64 bg-white border-r transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 flex flex-col">
      <div class="flex items-center gap-4 px-6 py-5 border-b">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-babypink-500">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
        </svg>
        <span class="text-xl font-semibold">BabySpa</span>
        <button id="closeSidebar" class="ml-auto p-1 md:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
      </div>
      
      <div class="flex-1 px-4 py-6 space-y-2">
        <a href="index.html" class="flex items-center gap-3 rounded-lg px-4 py-3 bg-babypink-50 text-babypink-600 font-medium shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span class="font-medium">Beranda</span>
        </a>
        <a href="reservations.html" class="flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
          <span class="font-medium">Reservasi</span>
        </a>
        <a href="transactions.html" class="flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
          <span class="font-medium">Transaksi</span>
        </a>
        <a href="services.html" class="flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="M16.5 9.4 7.55 4.24"/><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
          <span class="font-medium">Layanan</span>
        </a>
        <a href="children.html" class="flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          <span class="font-medium">Anak</span>
        </a>
        <a href="settings.html" class="flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
          <span class="font-medium">Pengaturan</span>
        </a>
      </div>
      
      <div class="p-4 mt-auto border-t">
        <div class="bg-gradient-to-br from-babypink-50 via-babyblue-50 to-babypink-50 p-5 rounded-xl shadow-sm">
          <h3 class="font-semibold text-sm text-gray-800">Perlu bantuan?</h3>
          <p class="text-sm text-gray-600 my-2">Silakan hubungi dukungan kami jika Anda memiliki pertanyaan.</p>
          <button class="w-full mt-3 py-2 px-4 rounded-md text-sm text-white font-medium bg-babypink-500 hover:bg-babypink-600 transition-colors duration-200">
            Hubungi Kami
          </button>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-4 md:p-6 ml-0 pt-6">
      <h1 class="text-2xl font-bold mb-6 mt-8 md:mt-0">Dasbor Pelanggan</h1>
      
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between">
            <div>
              <p class="text-sm text-gray-500 font-medium">Total Kunjungan</p>
              <p class="text-2xl font-semibold">8</p>
            </div>
            <div class="h-10 w-10 bg-babypink-50 rounded-full flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-babypink-500">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                <line x1="16" x2="16" y1="2" y2="6"/>
                <line x1="8" x2="8" y1="2" y2="6"/>
                <line x1="3" x2="21" y1="10" y2="10"/>
              </svg>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-2">Semua sesi spa</p>
          <div class="flex items-center mt-2 text-green-600 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
            <span>3 dalam bulan ini</span>
          </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between">
            <div>
              <p class="text-sm text-gray-500 font-medium">Total Pengeluaran</p>
              <p class="text-2xl font-semibold">Rp 1.350.000</p>
            </div>
            <div class="h-10 w-10 bg-babypink-50 rounded-full flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-babypink-500">
                <rect width="20" height="14" x="2" y="5" rx="2"/>
                <line x1="2" x2="22" y1="10" y2="10"/>
              </svg>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-2">Pembayaran layanan</p>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between">
            <div>
              <p class="text-sm text-gray-500 font-medium">Anak Terdaftar</p>
              <p class="text-2xl font-semibold">2</p>
            </div>
            <div class="h-10 w-10 bg-babypink-50 rounded-full flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-babypink-500">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-2">Profil aktif</p>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between">
            <div>
              <p class="text-sm text-gray-500 font-medium">Layanan Favorit</p>
              <p class="text-2xl font-semibold">Pijat Bayi</p>
            </div>
            <div class="h-10 w-10 bg-babypink-50 rounded-full flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-babypink-500">
                <path d="M16.5 9.4 7.55 4.24"/>
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                <polyline points="3.29 7 12 12 20.71 7"/>
                <line x1="12" x2="12" y1="22" y2="12"/>
              </svg>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-2">5 dari 8 kunjungan</p>
        </div>
      </div>

      <!-- Upcoming Reservations & Recent Transactions -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Upcoming Reservations -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Reservasi Mendatang</h2>
            <a href="reservations.html" class="text-babypink-500 hover:text-babypink-600 text-sm">Lihat Semua</a>
          </div>
          
          <!-- Reservation Item -->
          <div class="mb-4 border-b pb-4">
            <div class="flex justify-between items-center">
              <div>
                <h4 class="font-medium">Pijat Bayi</h4>
                <p class="text-sm text-gray-500">28 April 2025, 10:00</p>
                
                  <p class="text-sm text-gray-500">Anak: Aditya</p>
                
              </div>
              <span class="px-2 py-1 bg-babypink-100 text-babypink-600 text-xs rounded-full h-min">Dikonfirmasi</span>
            </div>
          </div>
          
          <!-- Reservation Item -->
          <div>
            <div class="flex justify-between items-center">
              <div>
                <h4 class="font-medium">Hidroterapi</h4>
                <p class="text-sm text-gray-500">30 April 2025, 13:30</p>
                
                  <p class="text-sm text-gray-500">Anak: Aditya</p>
                
              </div>
              <span class="px-2 py-1 bg-orange-100 text-orange-600 text-xs rounded-full h-min">Menunggu</span>
            </div>
          </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Transaksi Terakhir</h2>
            <a href="transactions.html" class="text-babypink-500 hover:text-babypink-600 text-sm">Lihat Semua</a>
          </div>
          
          <!-- Transaction Item -->
          <div class="mb-4 border-b pb-4">
            <div class="flex justify-between">
              <div>
                <h4 class="font-medium">Pijat Bayi</h4>
                <p class="text-sm text-gray-500">20 April 2025</p>
              </div>
              <p class="font-medium">Rp 250.000</p>
            </div>
            <div class="mt-1 flex justify-between items-center">
              <p class="text-sm text-gray-500">Kartu Kredit</p>
              <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">Lunas</span>
            </div>
          </div>
          
          <!-- Transaction Item -->
          <div>
            <div class="flex justify-between">
              <div>
                <h4 class="font-medium">Hidroterapi</h4>
                <p class="text-sm text-gray-500">15 April 2025</p>
              </div>
              <p class="font-medium">Rp 350.000</p>
            </div>
            <div class="mt-1 flex justify-between items-center">
              <p class="text-sm text-gray-500">Transfer Bank</p>
              <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">Lunas</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Children Profiles -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-lg font-semibold">Profil Anak</h2>
          <a href="children.html" class="text-babypink-500 hover:text-babypink-600 text-sm">Kelola Profil</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Child Profile 1 -->
          <div class="border rounded-lg p-4 flex items-center">
            <div class="h-12 w-12 rounded-full bg-babypink-200 flex items-center justify-center text-babypink-600 font-medium text-lg mr-3">
              Ad
            </div>
            <div>
              <h4 class="font-medium">Aditya</h4>
              <p class="text-sm text-gray-500">8 bulan • Laki-laki</p>
            </div>
            <div class="ml-auto">
              <a href="children.html" class="p-2 text-gray-500 hover:text-babypink-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </a>
            </div>
          </div>
          
          <!-- Child Profile 2 -->
          <div class="border rounded-lg p-4 flex items-center">
            <div class="h-12 w-12 rounded-full bg-babypink-200 flex items-center justify-center text-babypink-600 font-medium text-lg mr-3">
              Bi
            </div>
            <div>
              <h4 class="font-medium">Bintang</h4>
              <p class="text-sm text-gray-500">1 tahun 2 bulan • Laki-laki</p>
            </div>
            <div class="ml-auto">
              <a href="children.html" class="p-2 text-gray-500 hover:text-babypink-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Sidebar Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarTrigger = document.getElementById('sidebarTrigger');
      const closeSidebar = document.getElementById('closeSidebar');
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');
      
      function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      }
      
      function closeSidebarFunc() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      }
      
      sidebarTrigger.addEventListener('click', openSidebar);
      closeSidebar.addEventListener('click', closeSidebarFunc);
      overlay.addEventListener('click', closeSidebarFunc);
    });
  </script>
</body>
</html>