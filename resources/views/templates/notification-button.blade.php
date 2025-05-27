<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BabySpa - Notification Dropdown</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
<body class="bg-gray-50 p-8">
  <!-- Demo Container -->
  <div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-8">Notification Dropdown Demo</h1>
    
    <!-- Header with Notification -->
    <div class="bg-white shadow-sm p-4 rounded-lg mb-8">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-babypink-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
          <h1 class="text-xl font-semibold">BabySpa Dashboard</h1>
        </div>
        
        <!-- Notification Dropdown -->
        <div 
          x-data="notificationDropdown()" 
          class="relative"
          @click.away="isOpen = false"
        >
          <!-- Notification Button -->
          <button 
            @click="isOpen = !isOpen"
            class="relative p-2 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors"
          >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span 
              x-show="unreadCount > 0" 
              x-text="unreadCount"
              class="absolute -top-1 -right-1 bg-babypink-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"
            ></span>
          </button>

          <!-- Dropdown Content -->
          <div 
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-md shadow-lg z-50 max-h-96 overflow-y-auto"
            style="display: none;"
          >
            <!-- Header -->
            <div class="flex items-center justify-between p-3 border-b border-gray-200">
              <h3 class="text-base font-semibold">Notifikasi</h3>
              <button 
                x-show="unreadCount > 0"
                @click="markAllAsRead()"
                class="text-xs text-babypink-600 hover:text-babypink-700 font-medium"
              >
                Tandai semua dibaca
              </button>
            </div>

            <!-- Notifications List -->
            <div x-show="notifications.length === 0" class="p-4 text-center text-gray-500 text-sm">
              Tidak ada notifikasi
            </div>

            <template x-for="notification in notifications" :key="notification.id">
              <div 
                class="p-0 hover:bg-gray-50 cursor-pointer"
                :class="{ 'bg-blue-50': !notification.isRead }"
              >
                <div class="w-full p-3 relative">
                  <div class="flex items-start justify-between">
                    <div class="flex-1 pr-2">
                      <div class="flex items-center gap-2 mb-1">
                        <h4 
                          class="text-sm font-medium"
                          :class="!notification.isRead ? 'text-gray-900' : 'text-gray-700'"
                          x-text="notification.title"
                        ></h4>
                        <div 
                          x-show="!notification.isRead"
                          class="w-2 h-2 bg-babypink-500 rounded-full"
                        ></div>
                      </div>
                      <p class="text-xs text-gray-600 mb-1" x-text="notification.message"></p>
                      <p class="text-xs text-gray-400" x-text="notification.time"></p>
                    </div>
                    <div class="flex gap-1">
                      <button
                        x-show="!notification.isRead"
                        @click.stop="markAsRead(notification.id)"
                        class="h-6 w-6 p-0 hover:bg-green-100 rounded flex items-center justify-center"
                      >
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600">
                          <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                      </button>
                      <button
                        @click.stop="removeNotification(notification.id)"
                        class="h-6 w-6 p-0 hover:bg-red-100 rounded flex items-center justify-center"
                      >
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600">
                          <line x1="18" y1="6" x2="6" y2="18"></line>
                          <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </template>

            <!-- Footer -->
            <div x-show="notifications.length > 0" class="border-t border-gray-200">
              <button class="w-full p-3 text-center text-sm text-babypink-600 hover:text-babypink-700 hover:bg-gray-50">
                Lihat semua notifikasi
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Demo Info -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
      <h2 class="text-lg font-semibold mb-4">Demo Controls</h2>
      <div class="space-y-2">
        <p class="text-sm text-gray-600">Click the notification bell to open/close the dropdown</p>
        <p class="text-sm text-gray-600">Use the check mark to mark individual notifications as read</p>
        <p class="text-sm text-gray-600">Use the X button to remove notifications</p>
        <p class="text-sm text-gray-600">Use "Tandai semua dibaca" to mark all as read</p>
      </div>
    </div>
  </div>

  <script>
    function notificationDropdown() {
      return {
        isOpen: false,
        notifications: [
          {
            id: '1',
            title: 'Reservasi Dikonfirmasi',
            message: 'Reservasi baby spa untuk anak Anda telah dikonfirmasi',
            time: '5 menit yang lalu',
            isRead: false,
            type: 'success'
          },
          {
            id: '2',
            title: 'Pembayaran Berhasil',
            message: 'Pembayaran untuk layanan baby massage telah diterima',
            time: '1 jam yang lalu',
            isRead: false,
            type: 'success'
          },
          {
            id: '3',
            title: 'Reminder Jadwal',
            message: 'Jangan lupa reservasi Anda besok pukul 10:00',
            time: '2 jam yang lalu',
            isRead: true,
            type: 'info'
          }
        ],
        
        get unreadCount() {
          return this.notifications.filter(n => !n.isRead).length;
        },
        
        markAsRead(id) {
          const notification = this.notifications.find(n => n.id === id);
          if (notification) {
            notification.isRead = true;
          }
        },
        
        markAllAsRead() {
          this.notifications.forEach(notification => {
            notification.isRead = true;
          });
        },
        
        removeNotification(id) {
          this.notifications = this.notifications.filter(n => n.id !== id);
        }
      }
    }
  </script>
</body>
</html>
