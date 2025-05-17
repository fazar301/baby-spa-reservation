<x-main-layout>

<div class="bg-pink-50 py-10">
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Reservasi Layanan</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Jadwalkan perawatan terbaik untuk si kecil dengan terapis profesional kami. Isi formulir di bawah ini untuk membuat reservasi.
            </p>
        </div>

        <!-- Selected Service Summary (if coming from services page) -->
        @if(request()->has('service'))
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 max-w-4xl mx-auto">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-pink-100 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Layanan yang Dipilih</h3>
                        <p class="text-gray-600">{{ request('name') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-pink-600 font-bold">{{ 'Rp ' . number_format(request('price', 0), 0, ',', '.') }}</p>
                    <a href="{{ route('services.list') }}" class="text-sm text-pink-500 hover:underline">Ubah Layanan</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Reservation Form -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-12 max-w-4xl mx-auto">
            <form action="" method="POST">
                @csrf
                
                <!-- Hidden field for pre-selected service -->
                @if(request()->has('service'))
                <input type="hidden" name="selected_service" value="{{ request('service') }}">
                <input type="hidden" name="selected_service_name" value="{{ request('name') }}">
                <input type="hidden" name="selected_service_price" value="{{ request('price') }}">
                @endif
                
                <!-- Progress Steps -->
                <div class="flex items-center justify-between mb-20">
                    <div class="flex flex-col items-center relative">
                        <div class="w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center font-bold text-lg">1</div>
                        <span class="text-sm font-medium mt-2 text-pink-500 absolute top-10">Informasi</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-2">
                        <div class="h-full bg-pink-500 w-0" id="progress-bar-1"></div>
                    </div>
                    <div class="flex flex-col items-center relative">
                        <div class="w-10 h-10 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold text-lg" id="step-2">2</div>
                        <span class="text-sm font-medium mt-2 text-gray-500 absolute top-10" id="step-2-text">
                            @if(request()->has('service'))
                            Jadwal
                            @else
                            Layanan
                            @endif
                        </span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-2">
                        <div class="h-full bg-pink-500 w-0" id="progress-bar-2"></div>
                    </div>
                    <div class="flex flex-col items-center relative">
                        <div class="w-10 h-10 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold text-lg" id="step-3">3</div>
                        <span class="text-sm font-medium mt-2 text-gray-500 absolute top-10" id="step-3-text">
                            @if(request()->has('service'))
                            Konfirmasi
                            @else
                            Jadwal
                            @endif
                        </span>
                    </div>
                    @if(!request()->has('service'))
                    <div class="flex-1 h-1 bg-gray-200 mx-2">
                        <div class="h-full bg-pink-500 w-0" id="progress-bar-3"></div>
                    </div>
                    <div class="flex flex-col items-center relative">
                        <div class="w-10 h-10 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold text-lg" id="step-4">4</div>
                        <span class="text-sm font-medium mt-2 text-gray-500 absolute top-10" id="step-4-text">Konfirmasi</span>
                    </div>
                    @endif
                </div>

                <!-- Step 1: Personal Information -->
                <div id="step-1-content" class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informasi Pribadi</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Parent Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-4">Informasi Orang Tua</h3>
                            
                            <div class="mb-4">
                                <label for="parent_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua <span class="text-red-500">*</span></label>
                                <input type="text" id="parent_name" name="parent_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" value="{{ auth()->user()->name }}" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                                <input type="tel" id="phone" name="noHP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" value="{{ auth()->user()->noHP }}" required>
                                <p class="text-xs text-gray-500 mt-1">Contoh: 08123456789</p>
                            </div>
                            
                            <div class="mb-4">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus"></textarea>
                            </div>
                        </div>
                        
                        <!-- Baby Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-4">Informasi Bayi</h3>
                            
                            <div class="mb-4">
                                <label for="baby_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Bayi <span class="text-red-500">*</span></label>
                                <input type="text" id="baby_name" name="baby_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="baby_birthdate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir Bayi <span class="text-red-500">*</span></label>
                                <input type="date" id="baby_birthdate" name="baby_birthdate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required max="{{ date('Y-m-d') }}">
                                <p class="text-xs text-gray-500 mt-1">Usia bayi akan dihitung otomatis</p>
                                <div class="mt-2 text-sm text-gray-700">
                                    <span>Usia: </span><span id="calculated-age">-</span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="birth_weight" class="block text-sm font-medium text-gray-700 mb-1">Berat Lahir (kg) <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input 
                                            type="number" 
                                            id="birth_weight" 
                                            name="birth_weight" 
                                            step="0.01" 
                                            min="0.5" 
                                            max="6" 
                                            placeholder="2.5" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" 
                                        >
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                            kg
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="current_weight" class="block text-sm font-medium text-gray-700 mb-1">Berat Sekarang (kg) <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input 
                                            type="number" 
                                            id="current_weight" 
                                            name="current_weight" 
                                            step="0.01" 
                                            min="0.5" 
                                            max="20" 
                                            placeholder="5.2" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" 
                                        >
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                            kg
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="baby_gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <div class="flex gap-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="baby_gender" value="laki-laki" class="form-radio h-4 w-4 text-pink-500" required>
                                        <span class="ml-2">Laki-laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="baby_gender" value="perempuan" class="form-radio h-4 w-4 text-pink-500">
                                        <span class="ml-2">Perempuan</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="button" id="next-to-step-2" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Lanjutkan</button>
                    </div>
                </div>

                <!-- Step 2: Service Selection (only if not pre-selected) -->
                @if(!request()->has('service'))
                <div id="step-2-content" class="mb-8 hidden">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pilih Layanan</h2>
                    
                    <div class="mb-6">
                        <label for="service_category" class="block text-sm font-medium text-gray-700 mb-2">Kategori Layanan <span class="text-red-500">*</span></label>
                        <select id="service_category" name="service_category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required>
                            <option value="">Pilih Kategori</option>
                            <option value="baby_services">Layanan Bayi</option>
                            <option value="baby_packages">Paket Bayi</option>
                            <option value="kids_health">Paket Kids Health</option>
                            <option value="mom_services">Layanan Ibu Hamil</option>
                            <option value="mom_packages">Paket Ibu Hamil</option>
                            <option value="education_packages">Paket Edukasi</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="service_type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan <span class="text-red-500">*</span></label>
                        <select id="service_type" name="service_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required disabled>
                            <option value="">Pilih Jenis Layanan</option>
                        </select>
                    </div>
                    
                    <!-- Dynamic Service Options -->
                    <div id="baby_services_options" class="hidden service-options">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-pink-50 transition">
                                <input type="radio" name="service" value="baby_massage" class="hidden service-radio">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Baby Massage</h4>
                                        <p class="text-sm text-gray-600">Pijat lembut untuk bayi</p>
                                    </div>
                                    <span class="text-pink-600 font-bold">Rp 70K</span>
                                </div>
                                <div class="mt-2 w-full h-1 bg-pink-500 opacity-0 transition-opacity service-indicator"></div>
                            </label>
                            
                            <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-pink-50 transition">
                                <input type="radio" name="service" value="baby_spa" class="hidden service-radio">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Baby SPA (berenang)</h4>
                                        <p class="text-sm text-gray-600">Terapi air untuk bayi</p>
                                    </div>
                                    <span class="text-pink-600 font-bold">Rp 70K</span>
                                </div>
                                <div class="mt-2 w-full h-1 bg-pink-500 opacity-0 transition-opacity service-indicator"></div>
                            </label>
                            
                            <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-pink-50 transition">
                                <input type="radio" name="service" value="baby_gym" class="hidden service-radio">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Gym</h4>
                                        <p class="text-sm text-gray-600">Latihan motorik untuk bayi</p>
                                    </div>
                                    <span class="text-pink-600 font-bold">Rp 30K</span>
                                </div>
                                <div class="mt-2 w-full h-1 bg-pink-500 opacity-0 transition-opacity service-indicator"></div>
                            </label>
                            
                            <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-pink-50 transition">
                                <input type="radio" name="service" value="baby_therapy" class="hidden service-radio">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Baby Terapi</h4>
                                        <p class="text-sm text-gray-600">Terapi khusus untuk bayi</p>
                                    </div>
                                    <span class="text-pink-600 font-bold">Rp 85K</span>
                                </div>
                                <div class="mt-2 w-full h-1 bg-pink-500 opacity-0 transition-opacity service-indicator"></div>
                            </label>
                        </div>
                    </div>
                    
                    <div id="baby_packages_options" class="hidden service-options">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-pink-50 transition">
                                <input type="radio" name="service" value="baby_massage_spa_gym" class="hidden service-radio">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Baby Massage, Spa, Gym</h4>
                                    <ul class="text-sm text-gray-600 mt-2 space-y-1">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Baby Massage
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Baby Spa
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Gym
                                        </li>
                                    </ul>
                                    <div class="mt-3 text-right">
                                        <span class="text-pink-600 font-bold">Rp 140K</span>
                                    </div>
                                </div>
                                <div class="mt-2 w-full h-1 bg-pink-500 opacity-0 transition-opacity service-indicator"></div>
                            </label>
                            
                            <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:bg-pink-50 transition">
                                <input type="radio" name="service" value="baby_spa_susu" class="hidden service-radio">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Baby Spa Susu</h4>
                                    <ul class="text-sm text-gray-600 mt-2 space-y-1">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Spa dengan susu
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Perawatan kulit bayi
                                        </li>
                                    </ul>
                                    <div class="mt-3 text-right">
                                        <span class="text-pink-600 font-bold">Rp 90K</span>
                                    </div>
                                </div>
                                <div class="mt-2 w-full h-1 bg-pink-500 opacity-0 transition-opacity service-indicator"></div>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Other service options would be added similarly -->
                    
                    <div class="flex justify-between">
                        <button type="button" id="back-to-step-1" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">Kembali</button>
                        <button type="button" id="next-to-step-3" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Lanjutkan</button>
                    </div>
                </div>
                @endif

                <!-- Step 2 or 3: Schedule Selection (depending on whether service is pre-selected) -->
                <div id="step-{{ request()->has('service') ? '2' : '3' }}-content" class="mb-8 hidden">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pilih Jadwal</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Reservasi <span class="text-red-500">*</span></label>
                            <input type="date" id="appointment_date" name="appointment_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required min="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div>
                            <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Reservasi <span class="text-red-500">*</span></label>
                            <select id="appointment_time" name="appointment_time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required>
                                <option value="">Pilih Waktu</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="branch" class="block text-sm font-medium text-gray-700 mb-1">Cabang <span class="text-red-500">*</span></label>
                        <select id="branch" name="branch" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required>
                            <option value="">Pilih Cabang</option>
                            <option value="jakarta_selatan">Jakarta Selatan</option>
                            <option value="jakarta_barat">Jakarta Barat</option>
                            <option value="jakarta_utara">Jakarta Utara</option>
                            <option value="jakarta_timur">Jakarta Timur</option>
                            <option value="jakarta_pusat">Jakarta Pusat</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                        <textarea id="notes" name="notes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" placeholder="Informasi tambahan atau permintaan khusus..."></textarea>
                    </div>
                    
                    <div class="flex justify-between">
                        <button type="button" id="back-to-step-{{ request()->has('service') ? '1' : '2' }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">Kembali</button>
                        <button type="button" id="next-to-step-{{ request()->has('service') ? '3' : '4' }}" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Lanjutkan</button>
                    </div>
                </div>

                <!-- Step 3 or 4: Confirmation (depending on whether service is pre-selected) -->
                <div id="step-{{ request()->has('service') ? '3' : '4' }}-content" class="mb-8 hidden">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Konfirmasi Reservasi</h2>
                    
                    <div class="bg-pink-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Ringkasan Reservasi</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-medium text-gray-700">Informasi Pribadi</h4>
                                <ul class="mt-2 space-y-1 text-sm">
                                    <li><span class="font-medium">Nama Orang Tua:</span> <span id="summary-parent-name"></span></li>
                                    <li><span class="font-medium">Nomor Telepon:</span> <span id="summary-phone"></span></li>
                                    <li><span class="font-medium">Email:</span> <span id="summary-email"></span></li>
                                </ul>
                            </div>
                            
                            <div>
                                <h4 class="font-medium text-gray-700">Informasi Bayi</h4>
                                <ul class="mt-2 space-y-1 text-sm">
                                    <li><span class="font-medium">Nama Bayi:</span> <span id="summary-baby-name"></span></li>
                                    <li><span class="font-medium">Usia:</span> <span id="summary-baby-age"></span></li>
                                    <li><span class="font-medium">Jenis Kelamin:</span> <span id="summary-baby-gender"></span></li>
                                </ul>
                            </div>
                            
                            <div>
                                <h4 class="font-medium text-gray-700">Layanan</h4>
                                <ul class="mt-2 space-y-1 text-sm">
                                    @if(request()->has('service'))
                                    <li><span class="font-medium">Layanan:</span> {{ request('name') }}</li>
                                    <li><span class="font-medium">Harga:</span> <span class="text-pink-600 font-bold">{{ 'Rp ' . number_format(request('price', 0), 0, ',', '.') }}</span></li>
                                    @else
                                    <li><span class="font-medium">Kategori:</span> <span id="summary-service-category"></span></li>
                                    <li><span class="font-medium">Layanan:</span> <span id="summary-service"></span></li>
                                    <li><span class="font-medium">Harga:</span> <span id="summary-price" class="text-pink-600 font-bold"></span></li>
                                    @endif
                                </ul>
                            </div>
                            
                            <div>
                                <h4 class="font-medium text-gray-700">Jadwal</h4>
                                <ul class="mt-2 space-y-1 text-sm">
                                    <li><span class="font-medium">Tanggal:</span> <span id="summary-date"></span></li>
                                    <li><span class="font-medium">Waktu:</span> <span id="summary-time"></span></li>
                                    <li><span class="font-medium">Cabang:</span> <span id="summary-branch"></span></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h4 class="font-medium text-gray-700">Catatan</h4>
                            <p class="mt-2 text-sm" id="summary-notes">-</p>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="terms_agreement" class="form-checkbox h-5 w-5 text-pink-500" required>
                            <span class="ml-2 text-sm text-gray-700">Saya menyetujui <a href="#" class="text-pink-500 hover:underline">syarat dan ketentuan</a> yang berlaku</span>
                        </label>
                    </div>
                    
                    <div class="flex justify-between">
                        <button type="button" id="back-to-step-{{ request()->has('service') ? '2' : '3' }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">Kembali</button>
                        <button type="submit" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Konfirmasi Reservasi</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Information Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-pink-100 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Jam Operasional</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex justify-between">
                        <span>Senin - Jumat</span>
                        <span>09:00 - 18:00</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Sabtu</span>
                        <span>09:00 - 17:00</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Minggu</span>
                        <span>10:00 - 16:00</span>
                    </li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-pink-100 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Kontak</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +62 812-3456-7890
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        info@babyspa-blade.com
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="https://wa.me/6281234567890" class="text-pink-500 hover:underline">WhatsApp</a>
                    </li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-pink-100 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Informasi</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Harap datang 10 menit sebelum jadwal reservasi</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Pembayaran dapat dilakukan di tempat atau transfer</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Konfirmasi reservasi akan dikirim melalui WhatsApp</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Step navigation
        const step1Content = document.getElementById('step-1-content');
        @if(request()->has('service'))
        const step2Content = document.getElementById('step-2-content');
        const step3Content = document.getElementById('step-3-content');
        
        const step2 = document.getElementById('step-2');
        const step3 = document.getElementById('step-3');
        
        const step2Text = document.getElementById('step-2-text');
        const step3Text = document.getElementById('step-3-text');
        
        const progressBar1 = document.getElementById('progress-bar-1');
        const progressBar2 = document.getElementById('progress-bar-2');
        @else
        const step2Content = document.getElementById('step-2-content');
        const step3Content = document.getElementById('step-3-content');
        const step4Content = document.getElementById('step-4-content');
        
        const step2 = document.getElementById('step-2');
        const step3 = document.getElementById('step-3');
        const step4 = document.getElementById('step-4');
        
        const step2Text = document.getElementById('step-2-text');
        const step3Text = document.getElementById('step-3-text');
        const step4Text = document.getElementById('step-4-text');
        
        const progressBar1 = document.getElementById('progress-bar-1');
        const progressBar2 = document.getElementById('progress-bar-2');
        const progressBar3 = document.getElementById('progress-bar-3');
        @endif
        
        // Next buttons
        document.getElementById('next-to-step-2').addEventListener('click', function() {
            // Validate step 1
            const parentName = document.getElementById('parent_name').value;
            const phone = document.getElementById('phone').value;
            const babyName = document.getElementById('baby_name').value;
            const babyBirthdate = document.getElementById('baby_birthdate').value;
            const babyGender = document.querySelector('input[name="baby_gender"]:checked');
            
            if (!parentName || !phone || !babyName || !babyBirthdate || !babyGender) {
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return;
            }
            
            // Move to step 2
            step1Content.classList.add('hidden');
            step2Content.classList.remove('hidden');
            
            // Update progress
            step2.classList.remove('bg-gray-200', 'text-gray-500');
            step2.classList.add('bg-pink-500', 'text-white');
            step2Text.classList.remove('text-gray-500');
            step2Text.classList.add('text-pink-500');
            progressBar1.classList.add('w-full');
        });
        
        @if(!request()->has('service'))
        document.getElementById('next-to-step-3').addEventListener('click', function() {
            // Validate step 2
            const serviceCategory = document.getElementById('service_category').value;
            const serviceType = document.getElementById('service_type').value;
            const serviceSelected = document.querySelector('input[name="service"]:checked');
            
            if (!serviceCategory || !serviceType || !serviceSelected) {
                alert('Mohon pilih layanan yang diinginkan.');
                return;
            }
            
            // Move to step 3
            step2Content.classList.add('hidden');
            step3Content.classList.remove('hidden');
            
            // Update progress
            step3.classList.remove('bg-gray-200', 'text-gray-500');
            step3.classList.add('bg-pink-500', 'text-white');
            step3Text.classList.remove('text-gray-500');
            step3Text.classList.add('text-pink-500');
            progressBar2.classList.add('w-full');
        });
        @endif
        
        document.getElementById('next-to-step-{{ request()->has('service') ? '3' : '4' }}').addEventListener('click', function() {
            // Validate step 3
            const appointmentDate = document.getElementById('appointment_date').value;
            const appointmentTime = document.getElementById('appointment_time').value;
            const branch = document.getElementById('branch').value;
            
            if (!appointmentDate || !appointmentTime || !branch) {
                alert('Mohon pilih jadwal dan cabang untuk reservasi.');
                return;
            }
            
            // Update summary
            document.getElementById('summary-parent-name').textContent = document.getElementById('parent_name').value;
            document.getElementById('summary-phone').textContent = document.getElementById('phone').value;
            document.getElementById('summary-email').textContent = document.getElementById('email').value || '-';
            
            document.getElementById('summary-baby-name').textContent = document.getElementById('baby_name').value;
            document.getElementById('summary-baby-age').textContent = document.getElementById('calculated-age').textContent;
            document.getElementById('summary-baby-gender').textContent = document.querySelector('input[name="baby_gender"]:checked').value;
            
            @if(!request()->has('service'))
            const serviceCategorySelect = document.getElementById('service_category');
            document.getElementById('summary-service-category').textContent = serviceCategorySelect.options[serviceCategorySelect.selectedIndex].text;
            
            const serviceSelected = document.querySelector('input[name="service"]:checked');
            const serviceLabel = serviceSelected.closest('label').querySelector('h4').textContent;
            document.getElementById('summary-service').textContent = serviceLabel;
            
            const priceElement = serviceSelected.closest('label').querySelector('.text-pink-600');
            document.getElementById('summary-price').textContent = priceElement.textContent;
            @endif
            
            const appointmentDateObj = new Date(appointmentDate);
            const formattedDate = appointmentDateObj.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            document.getElementById('summary-date').textContent = formattedDate;
            
            document.getElementById('summary-time').textContent = appointmentTime;
            
            const branchSelect = document.getElementById('branch');
            document.getElementById('summary-branch').textContent = branchSelect.options[branchSelect.selectedIndex].text;
            
            document.getElementById('summary-notes').textContent = document.getElementById('notes').value || '-';
            
            // Move to step 4
            step{{ request()->has('service') ? '2' : '3' }}Content.classList.add('hidden');
            step{{ request()->has('service') ? '3' : '4' }}Content.classList.remove('hidden');
            
            // Update progress
            @if(request()->has('service'))
            step3.classList.remove('bg-gray-200', 'text-gray-500');
            step3.classList.add('bg-pink-500', 'text-white');
            step3Text.classList.remove('text-gray-500');
            step3Text.classList.add('text-pink-500');
            progressBar2.classList.add('w-full');
            @else
            step4.classList.remove('bg-gray-200', 'text-gray-500');
            step4.classList.add('bg-pink-500', 'text-white');
            step4Text.classList.remove('text-gray-500');
            step4Text.classList.add('text-pink-500');
            progressBar3.classList.add('w-full');
            @endif
        });
        
        // Back buttons
        @if(!request()->has('service'))
        document.getElementById('back-to-step-1').addEventListener('click', function() {
            step2Content.classList.add('hidden');
            step1Content.classList.remove('hidden');
            
            // Update progress
            step2.classList.remove('bg-pink-500', 'text-white');
            step2.classList.add('bg-gray-200', 'text-gray-500');
            step2Text.classList.remove('text-pink-500');
            step2Text.classList.add('text-gray-500');
            progressBar1.classList.remove('w-full');
        });
        
        document.getElementById('back-to-step-2').addEventListener('click', function() {
            step3Content.classList.add('hidden');
            step2Content.classList.remove('hidden');
            
            // Update progress
            step3.classList.remove('bg-pink-500', 'text-white');
            step3.classList.add('bg-gray-200', 'text-gray-500');
            step3Text.classList.remove('text-pink-500');
            step3Text.classList.add('text-gray-500');
            progressBar2.classList.remove('w-full');
        });
        
        document.getElementById('back-to-step-3').addEventListener('click', function() {
            step4Content.classList.add('hidden');
            step3Content.classList.remove('hidden');
            
            // Update progress
            step4.classList.remove('bg-pink-500', 'text-white');
            step4.classList.add('bg-gray-200', 'text-gray-500');
            step4Text.classList.remove('text-pink-500');
            step4Text.classList.add('text-gray-500');
            progressBar3.classList.remove('w-full');
        });
        @else
        document.getElementById('back-to-step-1').addEventListener('click', function() {
            step2Content.classList.add('hidden');
            step1Content.classList.remove('hidden');
            
            // Update progress
            step2.classList.remove('bg-pink-500', 'text-white');
            step2.classList.add('bg-gray-200', 'text-gray-500');
            step2Text.classList.remove('text-pink-500');
            step2Text.classList.add('text-gray-500');
            progressBar1.classList.remove('w-full');
        });
        
        document.getElementById('back-to-step-2').addEventListener('click', function() {
            step3Content.classList.add('hidden');
            step2Content.classList.remove('hidden');
            
            // Update progress
            step3.classList.remove('bg-pink-500', 'text-white');
            step3.classList.add('bg-gray-200', 'text-gray-500');
            step3Text.classList.remove('text-pink-500');
            step3Text.classList.add('text-gray-500');
            progressBar2.classList.remove('w-full');
        });
        @endif
        
        @if(!request()->has('service'))
        // Service category selection
        const serviceCategorySelect = document.getElementById('service_category');
        const serviceTypeSelect = document.getElementById('service_type');
        const serviceOptions = document.querySelectorAll('.service-options');
        
        serviceCategorySelect.addEventListener('change', function() {
            // Reset service type
            serviceTypeSelect.innerHTML = '<option value="">Pilih Jenis Layanan</option>';
            serviceTypeSelect.disabled = false;
            
            // Hide all service options
            serviceOptions.forEach(option => {
                option.classList.add('hidden');
            });
            
            // Show options based on category
            const category = this.value;
            
            if (category === 'baby_services') {
                // Add options for baby services
                const options = [
                    { value: 'massage', text: 'Baby Massage' },
                    { value: 'spa', text: 'Baby Spa' },
                    { value: 'gym', text: 'Baby Gym' },
                    { value: 'therapy', text: 'Baby Terapi' }
                ];
                
                options.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.textContent = option.text;
                    serviceTypeSelect.appendChild(optionElement);
                });
                
                // Show baby services options
                document.getElementById('baby_services_options').classList.remove('hidden');
            } else if (category === 'baby_packages') {
                // Add options for baby packages
                const options = [
                    { value: 'massage_spa_gym', text: 'Baby Massage, Spa, Gym' },
                    { value: 'spa_susu', text: 'Baby Spa Susu' },
                    { value: 'spa_secang', text: 'Baby Spa Secang' }
                ];
                
                options.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.textContent = option.text;
                    serviceTypeSelect.appendChild(optionElement);
                });
                
                // Show baby packages options
                document.getElementById('baby_packages_options').classList.remove('hidden');
            }
            // Add other categories similarly
        });
        
        // Service type selection
        serviceTypeSelect.addEventListener('change', function() {
            // Reset service selection
            const serviceRadios = document.querySelectorAll('.service-radio');
            serviceRadios.forEach(radio => {
                radio.checked = false;
            });
            
            const serviceIndicators = document.querySelectorAll('.service-indicator');
            serviceIndicators.forEach(indicator => {
                indicator.classList.add('opacity-0');
            });
            
            // Highlight corresponding service option
            const serviceType = this.value;
            
            if (serviceType) {
                const serviceRadio = document.querySelector(`input[value="baby_${serviceType}"]`);
                if (serviceRadio) {
                    serviceRadio.checked = true;
                    serviceRadio.closest('label').querySelector('.service-indicator').classList.remove('opacity-0');
                }
            }
        });
        
        // Service selection
        const serviceLabels = document.querySelectorAll('.service-radio');
        serviceLabels.forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset all indicators
                const serviceIndicators = document.querySelectorAll('.service-indicator');
                serviceIndicators.forEach(indicator => {
                    indicator.classList.add('opacity-0');
                });
                
                // Show indicator for selected service
                if (this.checked) {
                    this.closest('label').querySelector('.service-indicator').classList.remove('opacity-0');
                }
            });
        });
        @endif

        // Calculate baby age from birthdate
        const babyBirthdateInput = document.getElementById('baby_birthdate');
        const calculatedAgeSpan = document.getElementById('calculated-age');

        babyBirthdateInput.addEventListener('change', function() {
            const birthdate = new Date(this.value);
            const today = new Date();
            
            if (isNaN(birthdate.getTime())) {
                calculatedAgeSpan.textContent = '-';
                return;
            }
            
            let years = today.getFullYear() - birthdate.getFullYear();
            let months = today.getMonth() - birthdate.getMonth();
            
            if (months < 0) {
                years--;
                months += 12;
            }
            
            // Check if birthday hasn't occurred yet this month
            if (today.getDate() < birthdate.getDate()) {
                months--;
                if (months < 0) {
                    years--;
                    months += 12;
                }
            }
            
            let ageString = '';
            if (years > 0) {
                ageString = years + ' tahun';
                if (months > 0) {
                    ageString += ' ' + months + ' bulan';
                }
            } else {
                ageString = months + ' bulan';
            }
            
            calculatedAgeSpan.textContent = ageString;
            
            // Add hidden fields for the calculated age
            const ageYearsInput = document.getElementById('age_years') || document.createElement('input');
            ageYearsInput.type = 'hidden';
            ageYearsInput.id = 'age_years';
            ageYearsInput.name = 'age_years';
            ageYearsInput.value = years;
            
            const ageMonthsInput = document.getElementById('age_months') || document.createElement('input');
            ageMonthsInput.type = 'hidden';
            ageMonthsInput.id = 'age_months';
            ageMonthsInput.name = 'age_months';
            ageMonthsInput.value = months;
            
            if (!document.getElementById('age_years')) {
                babyBirthdateInput.parentNode.appendChild(ageYearsInput);
                babyBirthdateInput.parentNode.appendChild(ageMonthsInput);
            }
        });
    });
</script>
</x-main-layout>