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
                        @if($service->kategori)
                            <p class="text-sm text-gray-500 mt-1">
                                @if($service->kategori->nama_kategori == 'Baby')
                                    Usia yang dibutuhkan: 0-12 bulan
                                @elseif($service->kategori->nama_kategori == 'Kids')
                                    Usia yang dibutuhkan: 1-3 tahun
                                @elseif($service->kategori->nama_kategori == 'Children')
                                    Usia yang dibutuhkan: 3+ tahun
                                @endif
                            </p>
                        @endif
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
            <form action="/reservasi" method="POST" id="reservation-form">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                
                <!-- Add error messages display -->
                @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="text-sm text-red-600">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
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
                        <span class="text-sm font-medium mt-2 text-gray-500 absolute top-10" id="step-2-text">Jadwal</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-2">
                        <div class="h-full bg-pink-500 w-0" id="progress-bar-2"></div>
                    </div>
                    <div class="flex flex-col items-center relative">
                        <div class="w-10 h-10 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold text-lg" id="step-3">3</div>
                        <span class="text-sm font-medium mt-2 text-gray-500 absolute top-10" id="step-3-text">Konfirmasi</span>
                    </div>
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
                                <input type="tel" id="phone" name="noHP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus @error('noHP') border-red-500 @enderror" value="{{ auth()->user()->noHP }}" required>
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}" id="email">
                                <p class="text-xs text-gray-500 mt-1">Contoh: 08123456789</p>
                                @error('noHP')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Data Bayi <span class="text-red-500">*</span></label>
                                <div class="flex flex-col space-y-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="baby_data_option" value="new" class="form-radio h-4 w-4 text-pink-500" checked>
                                        <span class="ml-2">Input Data Bayi Baru</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="baby_data_option" value="existing" class="form-radio h-4 w-4 text-pink-500">
                                        <span class="ml-2">Gunakan Data Bayi yang Sudah Ada</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div id="existing-baby-section" class="mb-4 hidden">
                                <label for="existing_baby" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bayi <span class="text-red-500">*</span></label>
                                <select id="existing_baby" name="existing_baby" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus">
                                    <option value="">Pilih Data Bayi</option>
                                    <!-- This would be populated from the database -->
                                    {{-- <option value="1" data-name="Andi Pratama" data-birthdate="2023-05-15" data-gender="laki-laki" data-birth-weight="3.2" data-current-weight="8.5">Andi Pratama (1 tahun 0 bulan)</option>
                                    <option value="2" data-name="Budi Santoso" data-birthdate="2023-08-20" data-gender="laki-laki" data-birth-weight="2.9" data-current-weight="7.1">Budi Santoso (9 bulan)</option>
                                    <option value="3" data-name="Citra Dewi" data-birthdate="2023-02-10" data-gender="perempuan" data-birth-weight="3.0" data-current-weight="9.2">Citra Dewi (1 tahun 3 bulan)</option> --}}
                                    @foreach($bayis as $bayi)
                                    <option
                                        value="{{ $bayi->id }}"
                                        data-name="{{ $bayi->nama }}"
                                        data-birthdate="{{ \Carbon\Carbon::parse($bayi->tanggal_lahir)->format('Y-m-d') }}"
                                        data-gender="{{ $bayi->jenis_kelamin }}"
                                        data-birth-weight="{{ $bayi->berat_lahir }}"
                                        data-current-weight="{{ $bayi->berat_sekarang }}"
                                    >
                                    @php
                                        $diff = \Carbon\Carbon::parse($bayi->tanggal_lahir)->diff(\Carbon\Carbon::now());
                                        $umur = '';

                                        if ($diff->y) {
                                            $umur .= $diff->y . ' tahun';
                                        }

                                        if ($diff->m) {
                                            $umur .= ($umur ? ' ' : '') . $diff->m . ' bulan';
                                        }

                                        if (!$umur) {
                                            $umur = 'Kurang dari 1 bulan';
                                        }
                                    @endphp

                                    {{ $bayi->nama }} ({{ $umur }})

                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div id="new-baby-section">
                                <div class="mb-4">
                                    <label for="nama_bayi" class="block text-sm font-medium text-gray-700 mb-1">Nama Bayi <span class="text-red-500">*</span></label>
                                    <input type="text" id="nama_bayi" name="nama_bayi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir Bayi <span class="text-red-500">*</span></label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required max="{{ date('Y-m-d') }}">
                                    <p class="text-xs text-gray-500 mt-1">Usia bayi akan dihitung otomatis</p>
                                    <div class="mt-2 text-sm text-gray-700">
                                        <span>Usia: </span><span id="calculated-age">-</span>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="berat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Berat Lahir (kg) <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input 
                                                type="number" 
                                                id="berat_lahir" 
                                                name="berat_lahir" 
                                                step="0.01" 
                                                min="0.5" 
                                                max="6" 
                                                placeholder="2.5" 
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" 
                                                required
                                            >
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                                kg
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="berat_sekarang" class="block text-sm font-medium text-gray-700 mb-1">Berat Sekarang (kg) <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input 
                                                type="number" 
                                                id="berat_sekarang" 
                                                name="berat_sekarang" 
                                                step="0.01" 
                                                min="0.5" 
                                                max="20" 
                                                placeholder="5.2" 
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" 
                                                required
                                            >
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                                kg
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                    <div class="flex gap-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="jenis_kelamin" value="laki-laki" class="form-radio h-4 w-4 text-pink-500" required>
                                            <span class="ml-2">Laki-laki</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="jenis_kelamin" value="perempuan" class="form-radio h-4 w-4 text-pink-500">
                                            <span class="ml-2">Perempuan</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="save_baby_data" id="save_baby_data" class="form-checkbox h-4 w-4 text-pink-500" value="1">
                                        <span class="ml-2 text-sm text-gray-700">Simpan data bayi untuk reservasi berikutnya</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="button" id="next-to-step-2" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Lanjutkan</button>
                    </div>
                </div>

                <!-- Step 2: Schedule Selection -->
                <div id="step-2-content" class="mb-8 hidden">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pilih Jadwal</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="tanggal_reservasi" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Reservasi <span class="text-red-500">*</span></label>
                            <select id="tanggal_reservasi" name="tanggal_reservasi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required>
                                <option value="">Pilih Tanggal</option>
                                @php
                                    $today = \Carbon\Carbon::now();
                                    for ($i = 0; $i < 7; $i++) {
                                        $date = $today->copy()->addDays($i);
                                        $formattedDate = $date->format('Y-m-d');
                                        $displayDate = $date->locale('id')->isoFormat('dddd, D MMMM YYYY');
                                        echo "<option value=\"$formattedDate\">$displayDate</option>";
                                    }
                                @endphp
                            </select>
                        </div>
                        
                        <div>
                            <label for="sesi_id" class="block text-sm font-medium text-gray-700 mb-1">Waktu Reservasi <span class="text-red-500">*</span></label>
                            <select id="sesi_id" name="sesi_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus" required>
                                <option value="">Pilih Waktu</option>
                                @foreach($sesis as $sesi)
                                    <option value="{{ $sesi->id }}" data-time="{{ \Carbon\Carbon::parse($sesi->jam)->format('H:i') }}">
                                        {{ \Carbon\Carbon::parse($sesi->jam)->format('H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Waktu yang tersedia akan berubah sesuai dengan tanggal yang dipilih</p>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                        <textarea id="catatan" name="catatan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 pink-focus"></textarea>
                    </div>
                    
                    <div class="flex justify-between">
                        <button type="button" id="back-to-step-1" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">Kembali</button>
                        <button type="button" id="next-to-step-3" class="px-6 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Lanjutkan</button>
                    </div>
                </div>

                <!-- Step 3: Confirmation -->
                <div id="step-3-content" class="mb-8 hidden">
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
                                    <li><span class="font-medium">Layanan:</span> {{ $type === 'layanan' ? $service->nama_layanan : $service->nama_paket }}</li>
                                    <li><span class="font-medium">Harga:</span> <span class="text-pink-600 font-bold">Rp {{ number_format($type === 'layanan' ? $service->harga_layanan : $service->harga_paket, 0, ',', '.') }}</span></li>
                                </ul>
                            </div>
                            
                            <div>
                                <h4 class="font-medium text-gray-700">Jadwal</h4>
                                <ul class="mt-2 space-y-1 text-sm">
                                    <li><span class="font-medium">Tanggal:</span> <span id="summary-date"></span></li>
                                    <li><span class="font-medium">Waktu:</span> <span id="summary-time"></span></li>
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
                            <input type="checkbox" name="terms" class="form-checkbox h-5 w-5 text-pink-500" required>
                            <span class="ml-2 text-sm text-gray-700">Saya setuju dengan syarat dan ketentuan reservasi</span>
                        </label>
                    </div>
                    
                    <div class="flex justify-between">
                        <button type="button" id="back-to-step-2" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">Kembali</button>
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
    // Declare all variables only once at the top
    const form = document.getElementById('reservation-form');
    const step1Content = document.getElementById('step-1-content');
    const step2Content = document.getElementById('step-2-content');
    const step3Content = document.getElementById('step-3-content');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');
    const step2Text = document.getElementById('step-2-text');
    const step3Text = document.getElementById('step-3-text');
    const progressBar1 = document.getElementById('progress-bar-1');
    const progressBar2 = document.getElementById('progress-bar-2');

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all required fields
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        let firstInvalidField = null;
        
        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('border-red-500');
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        // Validate terms checkbox
        const termsCheckbox = form.querySelector('input[name="terms"]');
        if (!termsCheckbox.checked) {
            isValid = false;
            termsCheckbox.classList.add('border-red-500');
            if (!firstInvalidField) {
                firstInvalidField = termsCheckbox;
            }
        } else {
            termsCheckbox.classList.remove('border-red-500');
        }
        
        if (!isValid) {
            // Show error message in the error display div
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mb-4 p-4 bg-red-50 border border-red-200 rounded-lg';
            errorDiv.innerHTML = '<ul class="text-sm text-red-600"><li>Mohon lengkapi semua field yang wajib diisi dan setujui syarat dan ketentuan.</li></ul>';
            
            // Remove any existing error messages
            const existingError = form.querySelector('.bg-red-50');
            if (existingError) {
                existingError.remove();
            }
            
            // Insert the error message at the top of the form
            form.insertBefore(errorDiv, form.firstChild);
            
            if (firstInvalidField) {
                firstInvalidField.focus();
            }
            return;
        }
        
        // If all validations pass, submit the form using fetch
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Terjadi kesalahan saat memproses reservasi.');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Redirect to success page or show success message
                window.location.href = data.redirect || '/reservasi/success';
            } else {
                // Show error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'mb-4 p-4 bg-red-50 border border-red-200 rounded-lg';
                errorDiv.innerHTML = `<ul class="text-sm text-red-600"><li>${data.message || 'Terjadi kesalahan saat memproses reservasi.'}</li></ul>`;
                
                // Remove any existing error messages
                const existingError = form.querySelector('.bg-red-50');
                if (existingError) {
                    existingError.remove();
                }
                
                // Insert the error message at the top of the form
                form.insertBefore(errorDiv, form.firstChild);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Show error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mb-4 p-4 bg-red-50 border border-red-200 rounded-lg';
            errorDiv.innerHTML = `<ul class="text-sm text-red-600"><li>${error.message || 'Terjadi kesalahan saat memproses reservasi. Silakan coba lagi.'}</li></ul>`;
            
            // Remove any existing error messages
            const existingError = form.querySelector('.bg-red-50');
            if (existingError) {
                existingError.remove();
            }
            
            // Insert the error message at the top of the form
            form.insertBefore(errorDiv, form.firstChild);
        });
    });

    // Next buttons
    document.getElementById('next-to-step-2').addEventListener('click', function() {
        // Validate step 1
        const parentName = document.getElementById('parent_name').value;
        const phone = document.getElementById('phone').value;
        const babyName = document.getElementById('nama_bayi').value;
        const babyBirthdate = document.getElementById('tanggal_lahir').value;
        const babyGender = document.querySelector('input[name="jenis_kelamin"]:checked');
        
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
    
    document.getElementById('next-to-step-3').addEventListener('click', function() {
        // Validate step 2
        const appointmentDate = document.getElementById('tanggal_reservasi').value;
        const sessionSelect = document.getElementById('sesi_id');
        const selectedSession = sessionSelect.options[sessionSelect.selectedIndex];
        
        if (!appointmentDate || !sessionSelect.value) {
            alert('Mohon pilih jadwal untuk reservasi.');
            return;
        }
        
        // Update summary
        document.getElementById('summary-parent-name').textContent = document.getElementById('parent_name').value;
        document.getElementById('summary-phone').textContent = document.getElementById('phone').value;
        document.getElementById('summary-email').textContent = document.getElementById('email')?.value || '-';
        
        document.getElementById('summary-baby-name').textContent = document.getElementById('nama_bayi').value;
        document.getElementById('summary-baby-age').textContent = document.getElementById('calculated-age').textContent;
        document.getElementById('summary-baby-gender').textContent = document.querySelector('input[name="jenis_kelamin"]:checked').value;
        
        const appointmentDateObj = new Date(appointmentDate);
        const formattedDate = appointmentDateObj.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('summary-date').textContent = formattedDate;
        
        document.getElementById('summary-time').textContent = selectedSession.text;
        
        document.getElementById('summary-notes').textContent = document.getElementById('catatan').value || '-';
        
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
    
    // Back buttons
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

    // Calculate baby age from birthdate
    const babyBirthdateInput = document.getElementById('tanggal_lahir');
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

    // Handle baby data option selection
    const babyDataOptions = document.querySelectorAll('input[name="baby_data_option"]');
    const existingBabySection = document.getElementById('existing-baby-section');
    const newBabySection = document.getElementById('new-baby-section');
    const existingBabySelect = document.getElementById('existing_baby');

    babyDataOptions.forEach(option => {
        option.addEventListener('change', function() {
            if (this.value === 'existing') {
                existingBabySection.classList.remove('hidden');
                newBabySection.classList.add('hidden');
                
                // Make existing baby fields required and new baby fields not required
                existingBabySelect.required = true;
                
                // Make new baby fields not required
                document.getElementById('nama_bayi').required = false;
                document.getElementById('tanggal_lahir').required = false;
                document.getElementById('berat_lahir').required = false;
                document.getElementById('berat_sekarang').required = false;
                document.querySelectorAll('input[name="jenis_kelamin"]').forEach(radio => {
                    radio.required = false;
                });
            } else {
                existingBabySection.classList.add('hidden');
                newBabySection.classList.remove('hidden');
                
                // Make existing baby fields not required and new baby fields required
                existingBabySelect.required = false;
                
                // Make new baby fields required
                document.getElementById('nama_bayi').required = true;
                document.getElementById('tanggal_lahir').required = true;
                document.getElementById('berat_lahir').required = true;
                document.getElementById('berat_sekarang').required = true;
                document.querySelectorAll('input[name="jenis_kelamin"]')[0].required = true;
            }
        });
    });

    // Handle existing baby selection
    existingBabySelect.addEventListener('change', function() {
        if (this.value) {
            const selectedOption = this.options[this.selectedIndex];
            
            // Auto-fill form with selected baby's data
            document.getElementById('nama_bayi').value = selectedOption.dataset.name;
            document.getElementById('tanggal_lahir').value = selectedOption.dataset.birthdate;
            document.getElementById('berat_lahir').value = selectedOption.dataset.birthWeight;
            document.getElementById('berat_sekarang').value = selectedOption.dataset.currentWeight;
            
            // Set gender radio button
            const genderRadios = document.querySelectorAll('input[name="jenis_kelamin"]');
            genderRadios.forEach(radio => {
                if (radio.value === selectedOption.dataset.gender) {
                    radio.checked = true;
                }
            });
            
            // Trigger the birthdate change event to calculate age
            const event = new Event('change');
            document.getElementById('tanggal_lahir').dispatchEvent(event);
            
            // Show the new baby section with pre-filled data
            newBabySection.classList.remove('hidden');
        } else {
            // Clear form if no baby is selected
            document.getElementById('nama_bayi').value = '';
            document.getElementById('tanggal_lahir').value = '';
            document.getElementById('berat_lahir').value = '';
            document.getElementById('berat_sekarang').value = '';
            document.querySelectorAll('input[name="jenis_kelamin"]').forEach(radio => {
                radio.checked = false;
            });
            document.getElementById('calculated-age').textContent = '-';
        }
    });

    // Weight validation
    const birthWeightInput = document.getElementById('berat_lahir');
    const currentWeightInput = document.getElementById('berat_sekarang');

    // Validate birth weight
    birthWeightInput.addEventListener('change', function() {
        const birthWeight = parseFloat(this.value);
        if (isNaN(birthWeight) || birthWeight <= 0) {
            alert('Berat lahir harus lebih dari 0 kg.');
            this.value = '';
            return;
        }

        if (birthWeight > 6) {
            alert('Berat lahir tidak boleh lebih dari 6 kg.');
            this.value = '';
            return;
        }

        // Check if current weight is already entered
        const currentWeight = parseFloat(currentWeightInput.value);
        if (currentWeight && birthWeight > currentWeight) {
            alert('Berat lahir tidak boleh lebih besar dari berat sekarang.');
            this.value = '';
        }
    });

    // Validate current weight
    currentWeightInput.addEventListener('change', function() {
        const currentWeight = parseFloat(this.value);
        if (isNaN(currentWeight) || currentWeight <= 0) {
            alert('Berat sekarang harus lebih dari 0 kg.');
            this.value = '';
            return;
        }

        if (currentWeight > 20) {
            alert('Berat sekarang tidak boleh lebih dari 20 kg.');
            this.value = '';
            return;
        }

        // Check if birth weight is already entered
        const birthWeight = parseFloat(birthWeightInput.value);
        if (birthWeight && birthWeight > currentWeight) {
            alert('Berat sekarang harus lebih besar dari berat lahir.');
            this.value = '';
        }
    });

    // Add event listener for date change
    const tanggalReservasiSelect = document.getElementById('tanggal_reservasi');
    const sesiSelect = document.getElementById('sesi_id');
    const allSesiOptions = Array.from(sesiSelect.options);

    tanggalReservasiSelect.addEventListener('change', function() {
        const selectedDate = this.value;
        
        // Clear current options except the first one
        while (sesiSelect.options.length > 1) {
            sesiSelect.remove(1);
        }

        // Add back all options
        allSesiOptions.forEach(option => {
            if (option.value) { // Skip the first "Pilih Waktu" option
                sesiSelect.add(option.cloneNode(true));
            }
        });

        // Fetch available sessions for the selected date
        fetch(`/api/available-sessions?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                // Remove unavailable sessions
                Array.from(sesiSelect.options).forEach((option,i) => {
                    if(i > 0){
                        if(new Date().getDate() == document.querySelector('#tanggal_reservasi').value.substr(8)){
                            if(option.getAttribute('data-time').toString().substr(0,2) < new Date().getHours()){
                                option.remove()
                                return
                            }
                        }
                    }
                    if (option.value && !data.available_sessions.includes(parseInt(option.value))) {
                        option.remove();
                    }
                });

                // If no sessions are available, show a message
                if (sesiSelect.options.length <= 1) {
                    const noSessionsOption = document.createElement('option');
                    noSessionsOption.disabled = true;
                    noSessionsOption.textContent = 'Tidak ada sesi yang tersedia untuk tanggal ini';
                    sesiSelect.add(noSessionsOption);
                }
            })
            .catch(error => {
                console.error('Error fetching available sessions:', error);
            });
    });
});
</script>
</x-main-layout>