<x-user-dashboard>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold md:mt-0">Reservasi</h1>
        <div class="flex items-center gap-4">
          <x-notification-button :count="3" />
          <x-profile-dropdown username="Akun Saya" />
        </div>
      </div>
    <!-- Search and New Reservation -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="relative w-full md:w-64">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 text-gray-500"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" placeholder="Cari reservasi..." class="w-full pl-8 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-babypink-500 focus:border-transparent">
    </div>
    <form class="flex flex-col md:flex-row gap-4 w-full md:w-auto" method="GET" id="reservation-form">
        <div class="w-full md:w-64">
            <label for="service" class="block text-sm font-medium text-gray-700">Pilih Layanan</label>
            <select id="service" name="service" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="">Pilih Layanan</option>
                <optgroup label="Layanan">
                    @foreach($layanans as $layanan)
                        <option value="layanan:{{ $layanan->slug }}">{{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</option>
                    @endforeach
                </optgroup>
                <optgroup label="Paket Layanan">
                    @foreach($paketLayanans as $paket)
                        <option value="paket:{{ $paket->slug }}">{{ $paket->nama_paket }} - Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full md:w-auto px-4 py-2 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md" disabled>Pilih & Reservasi</button>
        </div>
    </form>
    </div>

    <!-- Tabs -->
    <div class="mb-4 border-b">
    <div class="flex">
        <button id="tab-upcoming" class="px-4 py-2 border-b-2 border-babypink-500 text-babypink-500">Akan Datang</button>
        <button id="tab-past" class="px-4 py-2 border-b-2 border-transparent text-gray-500">Riwayat</button>
    </div>
    </div>

    <!-- Reservations - Upcoming Tab -->
    <div id="upcoming-tab-content" class="block">
    <!-- Reservation Card 1 -->
    <div class="bg-white rounded-xl shadow-sm mb-4">
        <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div>
            <h3 class="text-lg font-semibold">Pijat Bayi</h3>
            <p class="text-sm text-gray-500">Untuk Aditya</p>
            </div>
            <span class="mt-2 md:mt-0 px-3 py-1 bg-babypink-100 text-babypink-600 text-sm rounded-full">
            Dikonfirmasi
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span>28 April 2025</span>
            </div>
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span>10:00 - 11:00</span>
            </div>
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Cabang Utama</span>
            </div>
            </div>
            
            <div class="space-y-2">
            <div class="text-sm">
                <span class="text-gray-500">Terapis:</span> Dr. Siti
            </div>
            <div class="text-sm">
                <span class="text-gray-500">Catatan:</span> Sediakan handuk ekstra
            </div>
            </div>
        </div>
        
        <div class="flex justify-end mt-4 space-x-2">
            <button class="px-3 py-1.5 text-sm border border-gray-300 rounded-md">
            Ubah Jadwal
            </button>
            <button class="px-3 py-1.5 text-sm bg-red-500 text-white rounded-md">
            Batalkan
            </button>
        </div>
        </div>
    </div>

    <!-- Reservation Card 2 -->
    <div class="bg-white rounded-xl shadow-sm mb-4">
        <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div>
            <h3 class="text-lg font-semibold">Hidroterapi</h3>
            <p class="text-sm text-gray-500">Untuk Aditya</p>
            </div>
            <span class="mt-2 md:mt-0 px-3 py-1 bg-orange-100 text-orange-600 text-sm rounded-full">
            Menunggu
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span>30 April 2025</span>
            </div>
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span>13:30 - 14:30</span>
            </div>
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Cabang Utama</span>
            </div>
            </div>
            
            <div class="space-y-2">
            <div class="text-sm">
                <span class="text-gray-500">Terapis:</span> Belum ditugaskan
            </div>
            </div>
        </div>
        
        <div class="flex justify-end mt-4 space-x-2">
            <button class="px-3 py-1.5 text-sm border border-gray-300 rounded-md">
            Ubah Jadwal
            </button>
            <button class="px-3 py-1.5 text-sm bg-red-500 text-white rounded-md">
            Batalkan
            </button>
        </div>
        </div>
    </div>
    </div>

    <!-- Reservations - Past Tab -->
    <div id="past-tab-content" class="hidden">
    <!-- Past Reservations -->
    <!-- Past Reservation Card 1 -->
    <div class="bg-white rounded-xl shadow-sm mb-4">
        <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <div>
            <h3 class="text-lg font-semibold">Pijat Bayi</h3>
            <p class="text-sm text-gray-500">Untuk Aditya</p>
            </div>
            <span class="mt-2 md:mt-0 px-3 py-1 bg-green-100 text-green-600 text-sm rounded-full">
            Selesai
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span>20 April 2025</span>
            </div>
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span>10:00 - 11:00</span>
            </div>
            <div class="flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Cabang Utama</span>
            </div>
            </div>
            
            <div class="space-y-2">
            <div class="text-sm">
                <span class="text-gray-500">Terapis:</span> Dr. Siti
            </div>
            </div>
        </div>
        
        <div class="flex justify-end mt-4">
            <button class="px-3 py-1.5 text-sm border border-gray-300 rounded-md">
            Buat Ulasan
            </button>
        </div>
        </div>
    </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            
            const tabs = {
                upcoming: {
                    button: document.getElementById('tab-upcoming'),
                    content: document.getElementById('upcoming-tab-content')
                },
                past: {
                    button: document.getElementById('tab-past'),
                    content: document.getElementById('past-tab-content')
                }
            };
    
            // Function to switch tabs
            function switchTab(activeTab) {
                console.log('Switching to tab:', activeTab);
                
                // Hide all content
                Object.values(tabs).forEach(tab => {
                    tab.content.classList.add('hidden');
                    tab.content.classList.remove('block');
                    tab.button.classList.remove('border-babypink-500', 'text-babypink-500');
                    tab.button.classList.add('border-transparent', 'text-gray-500');
                });
    
                // Show active content
                tabs[activeTab].content.classList.remove('hidden');
                tabs[activeTab].content.classList.add('block');
                tabs[activeTab].button.classList.remove('border-transparent', 'text-gray-500');
                tabs[activeTab].button.classList.add('border-babypink-500', 'text-babypink-500');
            }
    
            // Add click event listeners
            tabs.upcoming.button.addEventListener('click', () => {
                console.log('Upcoming tab clicked');
                switchTab('upcoming');
            });
    
            tabs.past.button.addEventListener('click', () => {
                console.log('Past tab clicked');
                switchTab('past');
            });
    
            // Initialize with upcoming tab
            switchTab('upcoming');

            const form = document.getElementById('reservation-form');
            const select = form.querySelector('select[name="service"]');
            const button = form.querySelector('button[type="submit"]');

            select.addEventListener('change', function() {
                button.disabled = !this.value;
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (select.value) {
                    const [type, slug] = select.value.split(':');
                    const url = `/reservasi/create/${type}/${slug}`;
                    window.location.href = url;
                }
            });
        });
    </script>
    @endpush
</x-user-dashboard>
