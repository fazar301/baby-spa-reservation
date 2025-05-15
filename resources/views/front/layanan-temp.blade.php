<x-main-layout>
    <div class="bg-pink-50 py-10">
        <div class="container mx-auto px-4">
            <!-- Hero Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Layanan Baby Spa</h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Temukan berbagai layanan perawatan terbaik untuk si kecil dengan terapis profesional dan fasilitas modern yang nyaman.
                </p>
            </div>
    
            <!-- Search and Filter Section -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <form action="" method="GET" class="flex">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" name="search" id="search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-pink-500 focus:border-pink-500" placeholder="Cari layanan..." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="p-3 ml-2 text-sm font-medium text-white bg-pink-500 rounded-lg border border-pink-500 hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Cari</span>
                            </button>
                        </form>
                    </div>
    
                    <!-- Filter Toggle Button (Mobile) -->
                    <div class="md:hidden">
                        <button id="filter-toggle" class="w-full flex items-center justify-center p-3 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
    
                <!-- Filter Section -->
                <div id="filter-section" class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4 md:mt-0">
                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                        <select id="category" name="category" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5">
                            <option value="">Semua Kategori</option>
                            <option value="massage" {{ request('category') == 'massage' ? 'selected' : '' }}>Pijat Bayi</option>
                            <option value="hydrotherapy" {{ request('category') == 'hydrotherapy' ? 'selected' : '' }}>Hidroterapi</option>
                            <option value="floating" {{ request('category') == 'floating' ? 'selected' : '' }}>Sesi Mengambang</option>
                            <option value="gym" {{ request('category') == 'gym' ? 'selected' : '' }}>Baby Gym</option>
                            <option value="package" {{ request('category') == 'package' ? 'selected' : '' }}>Paket Hemat</option>
                        </select>
                    </div>
    
                    <!-- Price Range Filter -->
                    <div>
                        <label for="price-range" class="block mb-2 text-sm font-medium text-gray-700">Rentang Harga</label>
                        <select id="price-range" name="price_range" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5">
                            <option value="">Semua Harga</option>
                            <option value="0-150000" {{ request('price_range') == '0-150000' ? 'selected' : '' }}>Dibawah Rp 150.000</option>
                            <option value="150000-250000" {{ request('price_range') == '150000-250000' ? 'selected' : '' }}>Rp 150.000 - Rp 250.000</option>
                            <option value="250000-500000" {{ request('price_range') == '250000-500000' ? 'selected' : '' }}>Rp 250.000 - Rp 500.000</option>
                            <option value="500000-1000000" {{ request('price_range') == '500000-1000000' ? 'selected' : '' }}>Rp 500.000 - Rp 1.000.000</option>
                            <option value="1000000-0" {{ request('price_range') == '1000000-0' ? 'selected' : '' }}>Diatas Rp 1.000.000</option>
                        </select>
                    </div>
    
                    <!-- Age Range Filter -->
                    <div>
                        <label for="age-range" class="block mb-2 text-sm font-medium text-gray-700">Usia Bayi</label>
                        <select id="age-range" name="age_range" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5">
                            <option value="">Semua Usia</option>
                            <option value="0-3" {{ request('age_range') == '0-3' ? 'selected' : '' }}>0-3 bulan</option>
                            <option value="3-6" {{ request('age_range') == '3-6' ? 'selected' : '' }}>3-6 bulan</option>
                            <option value="6-12" {{ request('age_range') == '6-12' ? 'selected' : '' }}>6-12 bulan</option>
                            <option value="12-24" {{ request('age_range') == '12-24' ? 'selected' : '' }}>12-24 bulan</option>
                        </select>
                    </div>
                </div>
    
                <!-- Filter Actions -->
                <div class="flex justify-end mt-6">
                    <button id="reset-filter" class="px-4 py-2 mr-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                        Reset Filter
                    </button>
                    <button id="apply-filter" class="px-4 py-2 text-sm font-medium text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                        Terapkan Filter
                    </button>
                </div>
            </div>
    
            <!-- Results Count and Sort -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                <p class="text-gray-700 mb-4 sm:mb-0">Menampilkan <span class="font-semibold">24</span> dari <span class="font-semibold">48</span> layanan</p>
                
                <div class="flex items-center">
                    <label for="sort" class="mr-2 text-sm font-medium text-gray-700">Urutkan:</label>
                    <select id="sort" name="sort" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 p-2">
                        <option value="popular">Paling Populer</option>
                        <option value="price-low">Harga: Rendah ke Tinggi</option>
                        <option value="price-high">Harga: Tinggi ke Rendah</option>
                        <option value="newest">Terbaru</option>
                    </select>
                </div>
            </div>
    
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- Service Card 1 -->
                <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/baby-massage.jpg') }}" alt="Pijat Bayi" />
                        <span class="absolute top-3 right-3 bg-pink-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Populer</span>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">Pijat Bayi</h5>
                            <span class="text-pink-600 font-bold">Rp 250.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Usia: 0-12 bulan</p>
                        <p class="mb-4 text-gray-700">
                            Teknik pijat lembut untuk meningkatkan ikatan dan relaksasi. Membantu bayi tidur lebih nyenyak dan mengurangi rasa tidak nyaman.
                        </p>
                        <div class="mb-4">
                            <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                            <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                <li>Meningkatkan kualitas tidur</li>
                                <li>Memperkuat ikatan orang tua-anak</li>
                                <li>Membantu perkembangan saraf</li>
                            </ul>
                        </div>
                        <a href="/appointment" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Reservasi
                        </a>
                    </div>
                </div>
    
                <!-- Service Card 2 -->
                <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/hydrotherapy.jpg') }}" alt="Hidroterapi" />
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">Hidroterapi</h5>
                            <span class="text-pink-600 font-bold">Rp 200.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Usia: 1-24 bulan</p>
                        <p class="mb-4 text-gray-700">
                            Sesi air hangat untuk meningkatkan kualitas tidur dan mengurangi stres. Membantu perkembangan motorik bayi.
                        </p>
                        <div class="mb-4">
                            <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                            <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                <li>Meningkatkan koordinasi tubuh</li>
                                <li>Memperkuat otot dan jantung</li>
                                <li>Merangsang perkembangan otak</li>
                            </ul>
                        </div>
                        <a href="/appointment" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Reservasi
                        </a>
                    </div>
                </div>
    
                <!-- Service Card 3 -->
                <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/floating.jpg') }}" alt="Sesi Mengambang" />
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">Sesi Mengambang</h5>
                            <span class="text-pink-600 font-bold">Rp 180.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Usia: 2-18 bulan</p>
                        <p class="mb-4 text-gray-700">
                            Pengalaman mengambang yang aman untuk meningkatkan perkembangan sensorik dan keseimbangan bayi.
                        </p>
                        <div class="mb-4">
                            <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                            <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                <li>Meningkatkan kesadaran tubuh</li>
                                <li>Memperkuat otot leher dan punggung</li>
                                <li>Meningkatkan koordinasi mata-tangan</li>
                            </ul>
                        </div>
                        <a href="/appointment" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Reservasi
                        </a>
                    </div>
                </div>
    
                <!-- Service Card 4 -->
                <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/baby-gym.jpg') }}" alt="Baby Gym" />
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">Baby Gym</h5>
                            <span class="text-pink-600 font-bold">Rp 150.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Usia: 3-24 bulan</p>
                        <p class="mb-4 text-gray-700">
                            Aktivitas senam dan gerakan yang dirancang khusus untuk merangsang perkembangan motorik kasar dan halus bayi.
                        </p>
                        <div class="mb-4">
                            <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                            <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                <li>Meningkatkan keseimbangan</li>
                                <li>Melatih motorik kasar & halus</li>
                                <li>Meningkatkan kekuatan otot</li>
                            </ul>
                        </div>
                        <a href="/appointment" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Reservasi
                        </a>
                    </div>
                </div>
    
                <!-- Service Card 5 -->
                <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/baby-swim.jpg') }}" alt="Baby Swim" />
                        <span class="absolute top-3 right-3 bg-pink-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Populer</span>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">Baby Swim</h5>
                            <span class="text-pink-600 font-bold">Rp 180.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Usia: 2-24 bulan</p>
                        <p class="mb-4 text-gray-700">
                            Aktivitas berenang dengan pelampung khusus bayi di dalam kolam dengan suhu yang terkontrol.
                        </p>
                        <div class="mb-4">
                            <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                            <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                <li>Meningkatkan koordinasi tubuh</li>
                                <li>Memperkuat otot dan jantung</li>
                                <li>Meningkatkan rasa percaya diri</li>
                            </ul>
                        </div>
                        <a href="/appointment" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Reservasi
                        </a>
                    </div>
                </div>
    
                <!-- Service Card 6 -->
                <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('images/baby-spa.jpg') }}" alt="Baby Spa" />
                        <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Baru</span>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="text-xl font-bold tracking-tight text-gray-900">Baby Spa</h5>
                            <span class="text-pink-600 font-bold">Rp 250.000</span>
                        </div>
                        <p class="text-sm text-gray-500 mb-2">Usia: 1-24 bulan</p>
                        <p class="mb-4 text-gray-700">
                            Perawatan lengkap yang terdiri dari berenang dengan pelampung khusus bayi dan pijat bayi.
                        </p>
                        <div class="mb-4">
                            <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                            <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                                <li>Meningkatkan kualitas tidur</li>
                                <li>Merangsang perkembangan motorik</li>
                                <li>Memperkuat otot dan tulang</li>
                            </ul>
                        </div>
                        <a href="/appointment" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Reservasi
                        </a>
                    </div>
                </div>
            </div>
    
            <!-- Pagination -->
            <div class="flex justify-center">
                <nav aria-label="Page navigation">
                    <ul class="inline-flex -space-x-px text-sm">
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-white border border-gray-300 bg-pink-500 hover:bg-pink-600">1</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">3</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="bg-pink-100 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Dapatkan Info Terbaru</h2>
                <p class="text-gray-600 mb-6">Berlangganan newsletter kami untuk mendapatkan informasi terbaru tentang layanan dan promo spesial.</p>
                <form class="flex flex-col sm:flex-row gap-2 max-w-md mx-auto">
                    <input type="email" placeholder="Alamat Email Anda" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <button type="submit" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Berlangganan</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile filter toggle
            const filterToggle = document.getElementById('filter-toggle');
            const filterSection = document.getElementById('filter-section');
            
            if (filterToggle && filterSection) {
                filterToggle.addEventListener('click', function() {
                    filterSection.classList.toggle('hidden');
                });
            }
            
            // Filter functionality
            const categorySelect = document.getElementById('category');
            const priceRangeSelect = document.getElementById('price-range');
            const ageRangeSelect = document.getElementById('age-range');
            const applyFilterBtn = document.getElementById('apply-filter');
            const resetFilterBtn = document.getElementById('reset-filter');
            
            if (applyFilterBtn) {
                applyFilterBtn.addEventListener('click', function() {
                    // In a real application, this would submit the form or update the URL
                    // For demo purposes, we'll just reload the page
                    const params = new URLSearchParams();
                    
                    if (categorySelect && categorySelect.value) {
                        params.append('category', categorySelect.value);
                    }
                    
                    if (priceRangeSelect && priceRangeSelect.value) {
                        params.append('price_range', priceRangeSelect.value);
                    }
                    
                    if (ageRangeSelect && ageRangeSelect.value) {
                        params.append('age_range', ageRangeSelect.value);
                    }
                    
                    const searchInput = document.getElementById('search');
                    if (searchInput && searchInput.value) {
                        params.append('search', searchInput.value);
                    }
                    
                    // Redirect with filters
                    window.location.href = window.location.pathname + '?' + params.toString();
                });
            }
            
            if (resetFilterBtn) {
                resetFilterBtn.addEventListener('click', function() {
                    // Reset all filters
                    if (categorySelect) categorySelect.value = '';
                    if (priceRangeSelect) priceRangeSelect.value = '';
                    if (ageRangeSelect) ageRangeSelect.value = '';
                    
                    const searchInput = document.getElementById('search');
                    if (searchInput) searchInput.value = '';
                    
                    // Redirect to page without filters
                    window.location.href = window.location.pathname;
                });
            }
            
            // Sort functionality
            const sortSelect = document.getElementById('sort');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    // In a real application, this would update the URL or trigger a fetch
                    // For demo purposes, we'll just reload the page
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('sort', this.value);
                    window.location.href = currentUrl.toString();
                });
            }
        });
    </script>
    
</x-main-layout>