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
    @foreach($reservations as $reservation)
        @php
            $sesiDateTime = \Carbon\Carbon::parse($reservation->tanggal_reservasi->format('Y-m-d') . ' ' . $reservation->sesi->jam);
            $isPast = now()->gt($sesiDateTime->addHour()); // dianggap selesai 1 jam setelah sesi dimulai
        @endphp
        @if(!$isPast)
        <div class="bg-white rounded-xl shadow-sm mb-4">
            <div class="p-6">
                <div class="flex flex-row items-center justify-between mb-4">
                    <div>
                        <div class="flex items-center">
                            <h3 class="text-lg font-semibold me-3">{{ $reservation->type === 'layanan' ? $reservation->layanan->nama_layanan : $reservation->paketLayanan->nama_paket }}</h3>
                            <div style="height: min-content" class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground text-xs">{{ $reservation->kode }}</div>
                        </div>
                        <p class="text-sm text-gray-500">Untuk {{ $reservation->bayi->nama }}</p>
                    </div>
                    <span style="width: min-content" class="self-start mt-0 px-3 py-1 {{ $reservation->status === 'confirmed' ? 'bg-babypink-100 text-babypink-600' : 'bg-orange-100 text-orange-600' }} text-sm rounded-full">
                        {{ $reservation->status === 'confirmed' ? 'Dikonfirmasi' : 'Menunggu' }}
                    </span>
                </div>
                
                <div class="grid grid-cols-1 grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <span>{{ $reservation->tanggal_reservasi->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span>{{ Str::substr($reservation->sesi->jam,0,5) }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                    @if($reservation->catatan)
                    <div class="text-sm">
                        <span class="text-gray-500">Catatan:</span> {{ $reservation->catatan }}
                    </div>
                    @endif
                    </div>
                </div>
                <div class="flex justify-end mt-4 space-x-2">
                    @if($reservation->status === 'confirmed')
                    <button class="px-3 py-1.5 text-sm border border-gray-300 rounded-md">
                        Ubah Jadwal
                    </button>
                    {{-- <button class="px-3 py-1.5 text-sm bg-red-500 text-white rounded-md">
                        Batalkan
                    </button> --}}
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
    </div>

    <!-- Reservations - Past Tab -->
    <div id="past-tab-content" class="hidden">
    @foreach($reservations as $reservation)
        @php
            $sesiDateTime = \Carbon\Carbon::parse($reservation->tanggal_reservasi->format('Y-m-d') . ' ' . $reservation->sesi->jam);
            $isPast = now()->gt($sesiDateTime->addHour()); // dianggap selesai 1 jam setelah sesi dimulai
        @endphp

        @if($isPast)
        <div class="bg-white rounded-xl shadow-sm mb-4">
            <div class="p-6">
                <div class="flex flex-row items-center justify-between mb-4">
                    <div>
                        <div class="flex items-center">
                            <h3 class="text-lg font-semibold me-3">{{ $reservation->type === 'layanan' ? $reservation->layanan->nama_layanan : $reservation->paketLayanan->nama_paket }}</h3>
                            <div style="height: min-content" class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground text-xs">{{ $reservation->kode }}</div>
                        </div>
                        <p class="text-sm text-gray-500">Untuk {{ $reservation->bayi->nama }}</p>
                    </div>
                    <span style="width: min-content" class="self-start mt-0 px-3 py-1 bg-green-100 text-green-600 text-sm rounded-full">
                    Selesai
                    </span>
                </div>
            
                <div class="grid grid-cols-1 grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <span>{{ $reservation->tanggal_reservasi->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span>{{ Str::substr($reservation->sesi->jam,0,5) }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        @if($reservation->catatan)
                        <div class="text-sm">
                            <span class="text-gray-500">Catatan:</span> {{ $reservation->catatan }}
                        </div>
                        @endif    
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button class="px-3 py-1.5 text-sm border border-gray-300 rounded-md">
                        Buat Ulasan
                    </button>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    </div>
    <!-- Pagination Controls -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 py-3 border-t">
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-700">
                Menampilkan
                <span id="startIndex" class="font-medium">1</span>
                -
                <span id="endIndex" class="font-medium">5</span>
                dari
                <span id="totalItems" class="font-medium">0</span>
                hasil
            </span>
        </div>
        <div class="flex items-center gap-2">
            <button id="prevPage" class="px-3 py-1 rounded-md border text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Sebelumnya
            </button>
            <div id="pageNumbers" class="flex items-center gap-1">
                <!-- Page numbers will be dynamically populated -->
            </div>
            <button id="nextPage" class="px-3 py-1 rounded-md border text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Berikutnya
            </button>
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

            // Pagination state
            let currentPage = 1;
            const itemsPerPage = 5;
            let filteredReservations = [];
            
            // Function to get all reservations from the current tab
            function getCurrentTabReservations() {
                const activeTab = tabs.upcoming.content.classList.contains('hidden') ? 'past' : 'upcoming';
                const reservations = Array.from(tabs[activeTab].content.querySelectorAll('.bg-white'));
                return reservations;
            }
            
            // Function to render reservations
            function renderReservations(items) {
                const activeTab = tabs.upcoming.content.classList.contains('hidden') ? 'past' : 'upcoming';
                const container = tabs[activeTab].content;
                
                // Hide all reservations first
                container.querySelectorAll('.bg-white').forEach(reservation => {
                    reservation.style.display = 'none';
                });
                
                // Show only the reservations for current page
                items.forEach(reservation => {
                    reservation.style.display = 'block';
                });
            }
            
            // Function to render pagination
            function renderPagination() {
                const totalPages = Math.ceil(filteredReservations.length / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage + 1;
                const endIndex = Math.min(currentPage * itemsPerPage, filteredReservations.length);
                
                // Update pagination info
                document.getElementById('startIndex').textContent = startIndex;
                document.getElementById('endIndex').textContent = endIndex;
                document.getElementById('totalItems').textContent = filteredReservations.length;
                
                // Update pagination buttons
                document.getElementById('prevPage').disabled = currentPage === 1;
                document.getElementById('nextPage').disabled = currentPage === totalPages;
                
                // Render page numbers
                const pageNumbers = document.getElementById('pageNumbers');
                pageNumbers.innerHTML = '';
                
                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.className = `w-8 h-8 flex items-center justify-center rounded-md text-sm font-medium
                        ${currentPage === i ? 'bg-babypink-50 text-babypink-600 border-babypink-200' : 'text-gray-700 hover:bg-gray-50 border'}
                        border`;
                    button.textContent = i;
                    button.addEventListener('click', () => goToPage(i));
                    pageNumbers.appendChild(button);
                }
            }
            
            // Function to go to specific page
            function goToPage(page) {
                currentPage = page;
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                renderReservations(filteredReservations.slice(start, end));
                renderPagination();
            }
            
            // Initialize pagination controls
            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) goToPage(currentPage - 1);
            });
            
            document.getElementById('nextPage').addEventListener('click', () => {
                const totalPages = Math.ceil(filteredReservations.length / itemsPerPage);
                if (currentPage < totalPages) goToPage(currentPage + 1);
            });
    
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

                // Update pagination for the new tab
                filteredReservations = getCurrentTabReservations();
                goToPage(1);
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
