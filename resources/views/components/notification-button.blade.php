@props(['count' => 0])

<div 
    x-data="notificationDropdown()" 
    class="relative"
    @click.away="isOpen = false"
>
    <button 
        @click="isOpen = !isOpen"
        {{ $attributes->merge(['class' => 'bg-white inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 h-10 w-10 relative']) }}
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
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
        class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-md shadow-lg z-50 flex flex-col"
        style="display: none; max-height: 400px;"
    >
        <!-- Header - Fixed -->
        <div class="flex items-center justify-between p-3 border-b border-gray-200 bg-white">
            <h3 class="text-base font-semibold">Notifikasi</h3>
            <button 
                x-show="unreadCount > 0"
                @click="markAllAsRead()"
                class="text-xs text-babypink-600 hover:text-babypink-700 font-medium"
            >
                Tandai semua dibaca
            </button>
        </div>

        <!-- Notifications List - Scrollable -->
        <div class="overflow-y-auto flex-1">
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
        </div>

        <!-- Footer - Fixed -->
        <div x-show="notifications.length > 0" class="border-t border-gray-200 bg-white">
            <button class="w-full p-3 text-center text-sm text-babypink-600 hover:text-babypink-700 hover:bg-gray-50">
                Lihat semua notifikasi
            </button>
        </div>
    </div>
</div>

@push('scripts')
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
                },
                {
                    id: '4',
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
@endpush 