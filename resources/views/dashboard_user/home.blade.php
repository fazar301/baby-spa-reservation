<x-user-dashboard>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold md:mt-0">Beranda</h1>
        <div class="flex items-center gap-4">
          <x-notification-button :count="3" />
          <x-profile-dropdown username="Akun Saya" />
        </div>
    </div> 
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Kunjungan</p>
                <p class="text-2xl font-semibold">{{ $totalVisits }}</p>
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
            <span>{{ $visitsThisMonth }} dalam bulan ini</span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Pengeluaran</p>
                <p class="text-2xl font-semibold">Rp {{ number_format($totalSpending, 0, ',', '.') }}</p>
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
                <p class="text-2xl font-semibold">{{ $registeredChildren }}</p>
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
                <p class="text-2xl font-semibold">{{ $favoriteServiceName }}</p>
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
            <p class="text-xs text-gray-500 mt-2">{{ $favoriteServiceVisitsCount }} dari {{ $totalVisits }} kunjungan</p>
        </div>
    </div>

    <!-- Upcoming Reservations & Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Upcoming Reservations -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <div class="">
                    <h2 class="text-lg font-semibold">Reservasi Mendatang</h2>
                    <p class="text-sm text-muted" style="color: hsl(215.4 16.3% 46.9%)">Jadwal reservasi yang akan datang</p>
                </div>
                <a href="{{ route('reservasi.index') }}" class="text-babypink-500 hover:text-babypink-600 text-sm">Lihat Semua</a>
            </div>
            
            @forelse($upcomingReservations as $reservation)
            <div class="mb-4 {{ !$loop->last ? 'border-b pb-4' : '' }}">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-medium">{{ $reservation->layanan->nama_layanan }}</h4>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->locale('id')->isoFormat('D MMMM Y') }}, {{ substr($reservation->sesi->jam, 0, 5) }}</p>
                        <p class="text-sm text-gray-500">Anak: {{ $reservation->bayi->nama }}</p>
                    </div>
                    <span class="px-2 py-1 bg-babypink-100 text-babypink-600 text-xs rounded-full h-min">Dikonfirmasi</span>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 py-4">
                Tidak ada reservasi mendatang
            </div>
            @endforelse
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
            <div class="">
                <h2 class="text-lg font-semibold">Transaksi Terakhir</h2>
                <p class="text-sm text-muted" style="color: hsl(215.4 16.3% 46.9%)">Riwayat pembayaran terbaru Anda</p>
            </div>
            <a href="{{ route('transaksi') }}" class="text-babypink-500 hover:text-babypink-600 text-sm">Lihat Semua</a>
            </div>
            
            @forelse($recentTransactions as $transaction)
            <div class="mb-4 {{ !$loop->last ? 'border-b pb-4' : '' }}">
                <div class="flex justify-between">
                    <div>
                        <h4 class="font-medium">{{ $transaction->reservasi->layanan->nama_layanan }}</h4>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($transaction->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</p>
                    </div>
                    <p class="font-medium">Rp {{ number_format($transaction->jumlah, 0, ',', '.') }}</p>
                </div>
                <div class="mt-1 flex justify-between items-center">
                    <p class="text-sm text-gray-500">{{ strtoupper($transaction->metode) }}</p>
                    <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">Lunas</span>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 py-4">
                Tidak ada transaksi terakhir
            </div>
            @endforelse
        </div>
    </div>

    <!-- Children Profiles -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="mb-4">
            <h2 class="text-lg font-semibold">Profil Anak</h2>
            <p class="text-sm text-muted" style="color: hsl(215.4 16.3% 46.9%)">Data anak-anak yang terdaftar
            </p>
        </div>
        
        <div class="grid grid-cols-1 gap-4">
            @forelse($children as $child)
            <div class="border-b pb-4">
                <div class="w-full flex">
                    <div class="h-12 w-12 rounded-full bg-babypink-200 flex items-center justify-center text-babypink-600 font-medium text-lg mr-3">
                        {{ substr($child->nama, 0, 2) }}
                    </div>
                    <div class="flex-1 self-center">
                        <div class="flex w-full justify-between">
                            <h4 class="text-sm font-medium">{{ $child->nama }}</h4>
                            @php
                                $ageInMonths = $child->tanggal_lahir->diffInMonths(now());
                                $years = floor($ageInMonths / 12);
                                $months = $ageInMonths % 12;
                            @endphp
                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-babyblue-50 text-babyblue-600 border-babyblue-200">
                                @if($years > 0)
                                    {{ $years }} tahun
                                    @if($months > 0)
                                        {{ $months }} bulan
                                    @endif
                                @else
                                    {{ $ageInMonths }} bulan
                                @endif
                            </span>      
                        </div>
                        <p class="flex items-center text-xs text-gray-500">Kunjungan terakhir: {{ \Carbon\Carbon::parse($child->last_visit_date)->locale('id')->isoFormat('D MMMM Y') }} • Total: {{ $child->total_sessions }} sesi</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 py-4 col-span-2">
                Belum ada profil anak yang terdaftar
            </div>
            @endforelse
        </div>
    </div>
</x-user-dashboard>