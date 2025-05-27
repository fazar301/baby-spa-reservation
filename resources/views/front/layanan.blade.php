<x-main-layout>
    <div class="bg-pink-50 py-10">
        <div class="container mx-auto px-4">
            <!-- Hero Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Layanan & Paket</h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Temukan berbagai layanan dan paket perawatan terbaik untuk si kecil dengan terapis profesional dan fasilitas modern yang nyaman.
                </p>
            </div>

            <!-- Search and Filter Section -->
            <form action="{{ route('layanan.index') }}" method="GET" class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" name="search" id="search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-pink-500 focus:border-pink-500" placeholder="Cari layanan atau paket..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Filter Toggle Button (Mobile) -->
                    <div class="md:hidden">
                        <button type="button" id="filter-toggle" class="w-full flex items-center justify-center p-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Filter Section -->
                <div id="filter-section" class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4 md:mt-0">
                    <!-- Type Filter -->
                    <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-700">Tipe</label>
                        <select name="type" id="type" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5">
                            <option value="">Semua Tipe</option>
                            <option value="layanan" {{ request('type') === 'layanan' ? 'selected' : '' }}>Layanan</option>
                            <option value="paket" {{ request('type') === 'paket' ? 'selected' : '' }}>Paket</option>
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori" id="kategori" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Filter -->
                    <div>
                        <label for="sort" class="block mb-2 text-sm font-medium text-gray-700">Urutkan</label>
                        <select name="sort" id="sort" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5">
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Paling Populer</option>
                            <option value="price-low" {{ request('sort') === 'price-low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price-high" {{ request('sort') === 'price-high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>
                </div>

                <!-- Filter Actions -->
                <div class="flex justify-end mt-6">
                    <a href="{{ route('layanan.index') }}" class="px-4 py-2 mr-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                        Reset Filter
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                        Terapkan Filter
                    </button>
                </div>
            </form>

            <!-- Results Count and Sort -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                <p class="text-gray-700 mb-4 sm:mb-0">Menampilkan <span class="font-semibold">{{ $layanans->count() }}</span> dari <span class="font-semibold">{{ $layanans->total() }}</span> layanan</p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @forelse ($layanans as $item)
                <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden flex flex-col h-full">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->type === 'paket' ? $item->nama_paket : $item->nama_layanan }}" />
                        @if($loop->first)
                        <span class="absolute top-3 right-3 bg-pink-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Populer</span>
                        @endif
                        <span class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $item->type === 'paket' ? 'Paket' : 'Layanan' }}
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">
                                {{ $item->type === 'paket' ? $item->nama_paket : $item->nama_layanan }}
                            </h5>
                            <span class="text-pink-600 font-bold">
                                Rp {{ number_format($item->type === 'paket' ? $item->harga_paket : $item->harga_layanan, 0, ',', '.') }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">
                            @if($item->kategori)
                                @if($item->kategori->nama_kategori == 'Baby')
                                    Usia: 0-12 bulan
                                @elseif($item->kategori->nama_kategori == 'Kids')
                                    Usia: 1-3 tahun
                                @elseif($item->kategori->nama_kategori == 'Children')
                                    Usia: 3+ tahun
                                @endif
                            @endif
                        </p>
                        <div class="flex-grow">
                            <p class="mb-4 text-gray-700">
                                {{ Str::limit($item->deskripsi, 100) }}
                            </p>
                            @if($item->type === 'paket' && $item->layanans->isNotEmpty())
                            <div class="mb-4">
                                <p class="font-medium text-gray-800 mb-2">Layanan dalam paket:</p>
                                <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                    @foreach($item->layanans as $layanan)
                                    <li>{{ $layanan->nama_layanan }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @elseif($item->type === 'layanan' && isset($item->manfaat))
                            <div class="mb-4">
                                <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                                <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                    @foreach($item->manfaat as $manfaat)
                                    <li>{{ $manfaat['value'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="mt-auto pt-4">
                            @if($item->slug)
                                <a href="{{ route('reservasi.redirect', ['type' => $item->type === 'paket' ? 'paket' : 'layanan', 'slug' => $item->slug]) }}" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Reservasi
                                </a>
                            @else
                                <button disabled class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-400 rounded-lg cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Reservasi Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500">Tidak ada {{ request('type') === 'paket' ? 'paket' : 'layanan' }} yang ditemukan.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $layanans->links() }}
            </div>
        </div>
    </div>

    <!-- JavaScript for mobile filter toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterToggle = document.getElementById('filter-toggle');
            const filterSection = document.getElementById('filter-section');
            
            if (filterToggle && filterSection) {
                filterToggle.addEventListener('click', function() {
                    filterSection.classList.toggle('hidden');
                });
            }
        });
    </script>
</x-main-layout>