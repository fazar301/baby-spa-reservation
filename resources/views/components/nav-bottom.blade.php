<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BabySpa - Mobile Bottom Navbar</title>
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
  <!-- Main Content Area -->
  <div class="min-h-screen pb-20">
    <!-- Header -->
    <div class="bg-white shadow-sm p-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-babypink-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
          <h1 class="text-xl font-semibold">BabySpa</h1>
        </div>
        
        <!-- Notification Button -->
        <button class="relative p-2 border border-gray-300 rounded-md hover:bg-gray-50">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
          </svg>
          <span class="absolute -top-1 -right-1 bg-babypink-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
        </button>
      </div>
    </div>

    <!-- Sample Content -->
    <div class="p-4">
      <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
      
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <div class="flex items-center justify-between">
            <h3 class="text-sm font-medium text-gray-500">Total Reservasi</h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-babypink-500">
              <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
              <line x1="16" x2="16" y1="2" y2="6"/>
              <line x1="8" x2="8" y1="2" y2="6"/>
              <line x1="3" x2="21" y1="10" y2="10"/>
            </svg>
          </div>
          <p class="text-2xl font-bold mt-2">12</p>
          <p class="text-xs text-gray-500 mt-1">Bulan ini</p>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-sm">
          <div class="flex items-center justify-between">
            <h3 class="text-sm font-medium text-gray-500">Transaksi</h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-babypink-500">
              <rect width="20" height="14" x="2" y="5" rx="2"/>
              <line x1="2" x2="22" y1="10" y2="10"/>
            </svg>
          </div>
          <p class="text-2xl font-bold mt-2">Rp 3.2M</p>
          <p class="text-xs text-gray-500 mt-1">Total bulan ini</p>
        </div>
      </div>

      <!-- Sample Content Cards -->
      <div class="space-y-4">
        <div class="bg-white p-4 rounded-xl shadow-sm">
          <h3 class="font-medium mb-2">Reservasi Mendatang</h3>
          <div class="space-y-3">
            <div class="flex justify-between items-center pb-3 border-b last:border-0">
              <div>
                <h4 class="font-medium">Pijat Bayi</h4>
                <p class="text-sm text-gray-500">28 April 2025 • 10:00</p>
              </div>
              <span class="px-2 py-1 bg-babypink-500 text-white text-xs rounded-full">Dikonfirmasi</span>
            </div>
            <div class="flex justify-between items-center pb-3 border-b last:border-0">
              <div>
                <h4 class="font-medium">Hidroterapi</h4>
                <p class="text-sm text-gray-500">30 April 2025 • 13:30</p>
              </div>
              <span class="px-2 py-1 bg-gray-500 text-white text-xs rounded-full">Menunggu</span>
            </div>
          </div>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm">
          <h3 class="font-medium mb-2">Transaksi Terbaru</h3>
          <div class="space-y-3">
            <div class="flex justify-between items-center pb-3 border-b last:border-0">
              <div>
                <h4 class="font-medium">Pijat Bayi</h4>
                <p class="text-sm text-gray-500">20 April 2025</p>
              </div>
              <div class="text-right">
                <p class="font-medium">Rp 250.000</p>
                <span class="px-2 py-1 bg-green-50 text-green-600 border border-green-200 text-xs rounded-full">Lunas</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Navigation Bar -->
  <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50">
    <div class="grid grid-cols-6 h-16">
      <!-- Home -->
      <a href="#" class="nav-item active" data-page="dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mb-1">
          <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        <span class="text-xs">Beranda</span>
      </a>

      <!-- Reservations -->
      <a href="#" class="nav-item" data-page="reservations">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mb-1">
          <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
          <line x1="16" x2="16" y1="2" y2="6"/>
          <line x1="8" x2="8" y1="2" y2="6"/>
          <line x1="3" x2="21" y1="10" y2="10"/>
        </svg>
        <span class="text-xs">Reservasi</span>
      </a>

      <!-- Transactions -->
      <a href="#" class="nav-item" data-page="transactions">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mb-1">
          <rect width="20" height="14" x="2" y="5" rx="2"/>
          <line x1="2" x2="22" y1="10" y2="10"/>
        </svg>
        <span class="text-xs">Transaksi</span>
      </a>

      <!-- Services -->
      <a href="#" class="nav-item" data-page="services">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mb-1">
          <path d="M16.5 9.4 7.55 4.24"/>
          <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
          <polyline points="3.29 7 12 12 20.71 7"/>
          <line x1="12" x2="12" y1="22" y2="12"/>
        </svg>
        <span class="text-xs">Layanan</span>
      </a>

      <!-- Children -->
      <a href="#" class="nav-item" data-page="children">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mb-1">
          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
          <circle cx="9" cy="7" r="4"/>
          <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        <span class="text-xs">Anak</span>
      </a>

      <!-- Settings -->
      <a href="#" class="nav-item" data-page="settings">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mb-1">
          <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
        <span class="text-xs">Pengaturan</span>
      </a>
    </div>
  </div>

  <style>
    .nav-item {
      @apply flex flex-col items-center justify-center py-2 px-3 text-xs font-medium transition-colors text-gray-500 hover:text-gray-700;
    }

    .nav-item.active {
      @apply text-babypink-600;
    }

    .nav-item.active svg {
      @apply text-babypink-600;
    }
  </style>

  <script>
    // Navigation functionality
    document.addEventListener('DOMContentLoaded', function() {
      const navItems = document.querySelectorAll('.nav-item');
      
      navItems.forEach(item => {
        item.addEventListener('click', function(e) {
          e.preventDefault();
          
          // Remove active class from all items
          navItems.forEach(nav => nav.classList.remove('active'));
          
          // Add active class to clicked item
          this.classList.add('active');
          
          // You can add page navigation logic here
          const page = this.getAttribute('data-page');
          console.log('Navigating to:', page);
          
          // Example: Change page title based on selection
          const pageTitle = this.querySelector('span').textContent;
          document.querySelector('h2').textContent = pageTitle;
        });
      });
    });
  </script>
</body>
</html>
