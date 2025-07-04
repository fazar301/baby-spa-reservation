<x-main-layout>
     <!-- Hero Section -->
     <section id="home" class="py-16 flex items-center bg-gradient-to-br from-babypink-50 via-white to-babyblue-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Content -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center bg-babypink-100 text-babypink-800 px-4 py-2 rounded-full text-sm font-medium mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4 mr-2">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        Dipercaya 1000+ Keluarga
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Pengalaman Spa
                        <span class="text-babypink-500"> Lembut</span>
                        <br />untuk Si Kecil
                    </h1>
                    
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto lg:mx-0">
                        Berikan perawatan terbaik untuk bayi Anda dengan layanan spa profesional yang aman, 
                        lembut, dan menyenangkan. Tingkatkan kualitas tidur dan perkembangan optimal si kecil.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <button onclick="scrollToSection('layanan')" class="px-8 py-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md text-lg transition-colors">
                            Reservasi Sekarang
                        </button>
                        <button onclick="window.location.href='/layanan'"  class="px-8 py-4 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md text-lg transition-colors flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                            </svg>
                            Lihat Layanan
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t">
                        <div class="text-center lg:text-left">
                            <div class="text-2xl font-bold text-gray-900">1000+</div>
                            <div class="text-sm text-gray-600">Bayi Bahagia</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-2xl font-bold text-gray-900">5★</div>
                            <div class="text-sm text-gray-600">Rating Pelanggan</div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-2xl font-bold text-gray-900">3+</div>
                            <div class="text-sm text-gray-600">Tahun Pengalaman</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Image -->
                <div class="relative max-w-[660px] max-h-[660px]">
                    <div class="relative z-10">
                        <img 
                            src="/images/baby-bath.jpeg" 
                            alt="Baby Spa Experience" 
                            class="rounded-2xl shadow-2xl w-full"
                        />
                        
                        <!-- Floating Card -->
                        <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-lg p-6 max-w-sm">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-900">5.0</span>
                            </div>
                            <p class="text-sm text-gray-600">
                                "Bayi saya jadi lebih tenang dan tidurnya nyenyak setelah spa di BabySpa!"
                            </p>
                            <div class="flex items-center mt-3">
                                <img 
                                    src="/images/person.png" 
                                    alt="Customer" 
                                    class="w-8 h-8 rounded-full"
                                />
                                <div class="ml-2">
                                    <div class="text-sm font-medium text-gray-900">Sarah M.</div>
                                    <div class="text-xs text-gray-500">Ibu dari Alya, 8 bulan</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Background Decoration -->
                    <div class="absolute top-6 right-6 w-72 h-72 bg-babypink-100 rounded-full opacity-20 -z-10"></div>
                    <div class="absolute bottom-6 left-6 w-48 h-48 bg-babyblue-100 rounded-full opacity-20 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Layanan Spa Premium</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Berbagai layanan spa premium untuk membantu perkembangan dan kesejahteraan si kecil. 
                    Semua layanan dirancang dengan perhatian dan kelembutan khusus.
                </p>
            </div>

            
            <!-- Services Grid for Layanan -->
            <div id="services-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach ($layanans as $layanan)
                <x-card 
                    :image="'/storage/' . $layanan->image"
                    :title="$layanan->nama_layanan"
                    :kategori="$layanan->kategori ? $layanan->kategori->nama_kategori : 'Baby'"
                    :price="number_format($layanan->harga_layanan, 0, ',', '.')"
                    :description="$layanan->deskripsi"
                    :benefits="$layanan->manfaat ?? []"
                    :reservationUrl="route('reservasi.redirect', ['type' => 'layanan', 'slug' => $layanan->slug])"
                    :showBadge="false"
                    :badgeText="'Populer'"
                />
                @endforeach
            </div>
            <a href="{{ route('layanan.index') }}" class="mt-10 text-babypink-500 hover:text-babypink-600 flex justify-center">
                Lihat lebih banyak
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Services Packet Section (from old home.blade.php, adapted) -->
    <section id="services_packet" class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Paket Layanan Spa Bayi</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Nikmati kombinasi perawatan terbaik dalam satu paket hemat! Dirancang khusus untuk memberikan manfaat maksimal bagi si kecil dengan harga yang lebih terjangkau.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-20">
                @foreach ($paket_layanans as $paket_layanan)
                <x-card 
                    :image="'/storage/' . $paket_layanan->image"
                    :title="$paket_layanan->nama_paket"
                    :kategori="$paket_layanan->kategori ? $paket_layanan->kategori->nama_kategori : 'Baby'"
                    :price="number_format($paket_layanan->harga_paket, 0, ',', '.')"
                    :description="$paket_layanan->deskripsi"
                    :benefits="[]"
                    :includedLayanan="$paket_layanan->layanans"
                    :reservationUrl="route('reservasi.redirect', ['type' => 'paket', 'slug' => $paket_layanan->slug])"
                    :showBadge="false"
                    :badgeText="'Populer'"
                />
                @endforeach
            </div>
            <a href="{{ route('layanan.index', ['type' => 'paket']) }}" class="mt-10 text-babypink-500 hover:text-babypink-600 flex justify-center">
                Lihat lebih banyak
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih BabySpa?
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami adalah pusat spa bayi terpercaya yang telah melayani ribuan keluarga 
                    dengan dedikasi tinggi terhadap kesehatan dan kebahagiaan si kecil.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center mb-12 md:mb-16">
                <!-- Left - Image -->
                <div class="relative order-2 lg:order-1">
                    <img 
                        src="/images/staff-working.avif" 
                        alt="Professional Baby Care" 
                        class="rounded-2xl shadow-lg w-full"
                    />
                    <div class="absolute inset-0 bg-babypink-500/10 rounded-2xl"></div>
                </div>

                <!-- Right - Content -->
                <div class="order-1 lg:order-2">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6">
                        Dedikasi Kami untuk Si Kecil
                    </h3>
                    <div class="space-y-3 md:space-y-4 text-sm md:text-base text-gray-600">
                        <p>
                            BabySpa didirikan dengan misi memberikan pengalaman spa terbaik untuk bayi 
                            dan balita. Kami memahami betapa berharganya momen-momen awal kehidupan si kecil.
                        </p>
                        <p>
                            Dengan tim terapis yang berpengalaman dan fasilitas yang dirancang khusus 
                            untuk bayi, kami berkomitmen menciptakan lingkungan yang aman, nyaman, dan menyenangkan.
                        </p>
                        <p>
                            Setiap layanan kami dirancang tidak hanya untuk relaksasi, tetapi juga untuk 
                            mendukung perkembangan fisik, emosional, dan kognitif bayi Anda.
                        </p>
                    </div>

                    <div class="mt-6 md:mt-8 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <div class="text-center">
                            <div class="text-xl md:text-2xl font-bold text-babypink-500">1000+</div>
                            <div class="text-xs md:text-sm text-gray-600">Keluarga Puas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl md:text-2xl font-bold text-babypink-500">3+</div>
                            <div class="text-xs md:text-sm text-gray-600">Tahun Pengalaman</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl md:text-2xl font-bold text-babypink-500">100%</div>
                            <div class="text-xs md:text-sm text-gray-600">Standar Keamanan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <div class="text-center p-4 md:p-6 bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-babypink-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8 text-babypink-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <h4 class="text-base md:text-lg font-semibold text-gray-900 mb-2">
                        Aman & Higienis
                    </h4>
                    <p class="text-gray-600 text-xs md:text-sm">
                        Standar kebersihan tertinggi dengan peralatan yang selalu disterilkan untuk keamanan si kecil.
                    </p>
                </div>

                <div class="text-center p-4 md:p-6 bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-babypink-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8 text-babypink-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <h4 class="text-base md:text-lg font-semibold text-gray-900 mb-2">
                        Terapis Berpengalaman
                    </h4>
                    <p class="text-gray-600 text-xs md:text-sm">
                        Tim terapis profesional yang telah bersertifikat dan berpengalaman dengan bayi dan anak.
                    </p>
                </div>

                <div class="text-center p-4 md:p-6 bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-babypink-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award w-6 h-6 md:w-8 md:h-8 text-babypink-500" data-lov-id="src/components/landing/AboutSection.tsx:98:20" data-lov-name="IconComponent" data-component-path="src/components/landing/AboutSection.tsx" data-component-line="98" data-component-file="AboutSection.tsx" data-component-name="IconComponent" data-component-content="%7B%22className%22%3A%22w-6%20h-6%20md%3Aw-8%20md%3Ah-8%20text-babypink-500%22%7D"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>
                    </div>
                    <h4 class="text-base md:text-lg font-semibold text-gray-900 mb-2">
                        Metode Terpercaya
                    </h4>
                    <p class="text-gray-600 text-xs md:text-sm">
                        Menggunakan teknik spa yang telah terbukti aman dan bermanfaat untuk perkembangan bayi.
                    </p>
                </div>

                <div class="text-center p-4 md:p-6 bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-babypink-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 md:w-8 md:h-8 text-babypink-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </div>
                    <h4 class="text-base md:text-lg font-semibold text-gray-900 mb-2">
                        Penuh Kasih Sayang
                    </h4>
                    <p class="text-gray-600 text-xs md:text-sm">
                        Setiap sesi dilakukan dengan penuh kelembutan dan perhatian untuk kenyamanan bayi Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-16 md:py-20 bg-babypink-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Manfaat Spa untuk Bayi</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
                    Spa untuk bayi bukan hanya tentang relaksasi, tetapi juga memberikan banyak manfaat 
                    untuk perkembangan fisik, emosional, dan kognitif si kecil.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <div class="bg-white shadow-lg hover:shadow-xl transition-shadow text-center p-6 md:p-8 rounded-lg">
                    <div class="text-3xl md:text-4xl mb-4">✨</div>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-3">
                        Kualitas Tidur
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Meningkatkan kualitas tidur bayi sehingga waktu istirahatnya lebih optimal dan perkembangan otak maksimal.
                    </p>
                </div>

                <div class="bg-white shadow-lg hover:shadow-xl transition-shadow text-center p-6 md:p-8 rounded-lg">
                    <div class="text-3xl md:text-4xl mb-4">❤️</div>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-3">
                        Ikatan Orang Tua
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Memperkuat ikatan antara orang tua dan bayi melalui sentuhan lembut dan interaksi berkualitas.
                    </p>
                </div>

                <div class="bg-white shadow-lg hover:shadow-xl transition-shadow text-center p-6 md:p-8 rounded-lg">
                    <div class="text-3xl md:text-4xl mb-4">🧠</div>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-3">
                        Perkembangan
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Mendukung perkembangan saraf, otot, dan keterampilan motorik bayi secara optimal.
                    </p>
                </div>

                <div class="bg-white shadow-lg hover:shadow-xl transition-shadow text-center p-6 md:p-8 rounded-lg">
                    <div class="text-3xl md:text-4xl mb-4">🛡️</div>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 mb-3">
                        Kesehatan
                    </h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Membantu mengatasi masalah pencernaan dan meningkatkan sistem kekebalan tubuh alami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-[130px] bg-white">
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="max-w-screen-md mx-auto mb-8 text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900">Apa Kata Orang Tua</h2>
                <p class="text-gray-500 sm:text-xl">
                    Dengarkan pengalaman keluarga yang telah mencoba layanan spa bayi kami.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="mb-4 italic text-gray-700">"Bayi saya tidur jauh lebih nyenyak setelah sesi hidroterapi. Staf sangat lembut dan profesional."</p>
                    <p class="text-sm font-medium">Sarah M., Ibu dari Emma (6 bulan)</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="mb-4 italic text-gray-700">"Teknik pijat bayi yang mereka ajarkan telah mengubah segalanya untuk anak kami yang sering rewel. Sangat direkomendasikan!"</p>
                    <p class="text-sm font-medium">James P., Ayah dari Noah (3 bulan)</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="mb-4 italic text-gray-700">"Lingkungan yang sangat tenang. Anak kembar saya menyukai sesi mengambang mereka dan saya melihat peningkatan dalam koordinasi mereka."</p>
                    <p class="text-sm font-medium">Lisa T., Ibu dari anak kembar (8 bulan)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section id="artikel" class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Artikel & Tips Terbaru</h2>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
            Dapatkan informasi terkini seputar perawatan bayi, tips spa, dan panduan 
            perkembangan anak dari para ahli kami.
            </p>
        </div>

        <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12">
            <!-- Articles will be populated by JavaScript -->
        </div>

        <div class="text-center">
            <a href="/artikel" class="bg-babypink-500 hover:bg-babypink-600 text-white px-6 md:px-8 py-2 text-base md:text-lg rounded-md font-medium transition-colors inline-block">
            Lihat Semua Artikel
            </a>
        </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Hubungi Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Siap memberikan pengalaman spa terbaik untuk si kecil? 
                    Hubungi kami untuk konsultasi atau reservasi.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">
                        Informasi Kontak
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-babypink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-babypink-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Alamat</h4>
                                    <p class="text-gray-600">
                                        Jl. Perjuangan Baru No.2<br>
                                        Gn. Pangilun, Kec. Padang Utara<br>
                                        Kota Padang, Sumatera Barat
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-babypink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-babypink-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Telepon</h4>
                                    <p class="text-gray-600">
                                        +62 812 1293 3442
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-babypink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-babypink-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                    <p class="text-gray-600">
                                        latumi@gmail.com
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-babypink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-babypink-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Jam Operasional</h4>
                                    <div class="text-gray-600 space-y-1">
                                        <p>Senin - Kamis: 09:00 - 18:00</p>
                                        <p>Jumat : 14:00 - 18:00</p>
                                        <p>Sabtu - Minggu: 09:00 - 17:00</p>
                                        <p class="text-sm text-orange-600">Reservasi diperlukan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">
                        Kirim Pesan
                    </h3>
                    
                    <div class="bg-white p-8 rounded-lg shadow-sm">
                        <form class="space-y-6" onsubmit="handleContactForm(event)">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap
                                    </label>
                                    <input
                                        type="text"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-babypink-500 focus:border-transparent"
                                        placeholder="Masukkan nama Anda"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input
                                        type="tel"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-babypink-500 focus:border-transparent"
                                        placeholder="Nomor WhatsApp aktif"
                                    />
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <input
                                    type="email"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-babypink-500 focus:border-transparent"
                                    placeholder="email@example.com"
                                />
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Usia Bayi
                                </label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-babypink-500 focus:border-transparent">
                                    <option value="">Pilih usia bayi</option>
                                    <option value="0-3">0-3 bulan</option>
                                    <option value="3-6">3-6 bulan</option>
                                    <option value="6-12">6-12 bulan</option>
                                    <option value="12+">12+ bulan</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pesan
                                </label>
                                <textarea
                                    rows="4"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-babypink-500 focus:border-transparent"
                                    placeholder="Ceritakan kebutuhan atau pertanyaan Anda tentang layanan spa untuk si kecil..."
                                ></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-babypink-500 hover:bg-babypink-600 text-white py-3 rounded-lg transition-colors">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">
                    Lokasi Kami
                </h3>
                <div class="bg-gray-200 rounded-2xl h-96 flex items-center justify-center overflow-hidden">
                    <div class="embed-map-responsive w-full h-full"><div class="embed-map-container"><iframe class="embed-map-frame" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&height=400&hl=en&q=latumi%20baby%20spa&t=&z=14&ie=UTF8&iwloc=B&output=embed"></iframe><a href="https://sprunkiretake.net" style="font-size:2px!important;color:gray!important;position:absolute;bottom:0;left:0;z-index:1;max-height:1px;overflow:hidden">sprunki retake</a></div><style>.embed-map-responsive{position:relative;text-align:right;width:100%;height:100%;}.embed-map-container{overflow:hidden;background:none!important;width:100%;height:100%;position:absolute;top:0;left:0;}.embed-map-frame{width:100%!important;height:100%!important;position:absolute;top:0;left:0;}</style></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-0 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="toast-message">Success!</span>
        </div>
    </div>

    <script>
        // Fetch articles from the database
        async function fetchArticles() {
            try {
                const response = await fetch('/api/artikel');
                const articles = await response.json();
                renderArticles(articles);
            } catch (error) {
                console.error('Error fetching articles:', error);
            }
        }

        // Format date to Indonesian
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID');
        }

        // Render articles
        function renderArticles(articles) {
      const grid = document.getElementById('articles-grid');
            grid.innerHTML = articles.map(article => `
        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
          <div class="relative">
                        <img src="${article.thumbnail ? '/storage/' + article.thumbnail : '/images/default-article.jpg'}" 
                             alt="${article.judul}" 
                             class="h-48 w-full object-cover">
            <div class="absolute top-3 left-3">
              <span class="bg-babypink-500 text-white px-2 py-1 rounded text-xs font-medium">
                                ${article.kategori.nama}
              </span>
            </div>
          </div>
          <div class="p-4 md:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                            ${article.judul}
            </h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                            ${article.meta_description || article.konten.substring(0, 150) + '...'}
            </p>
            
            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
              <div class="flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                                <span>${article.author.name}</span>
              </div>
              <div class="flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                                <span>${formatDate(article.published_at || article.created_at)}</span>
              </div>
            </div>
            
            <a href="/artikel/${article.slug}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors group">
              Baca Selengkapnya
              <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      `).join('');
    }
    
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            fetchArticles();
        });

        // Smooth scrolling to sections
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    toggleMobileMenu();
                }
            }
        }

        // Toggle mobile menu
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        // Filter services
        function filterServices(category) {
            const serviceCards = document.querySelectorAll('.service-card');
            const filterButtons = document.querySelectorAll('.service-filter');

            // Update active button
            filterButtons.forEach(button => {
                if (button.dataset.category === category) {
                    button.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
                    button.classList.remove('text-gray-600', 'hover:text-gray-900');
                } else {
                    button.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
                    button.classList.add('text-gray-600', 'hover:text-gray-900');
                }
            });

            // Filter cards
            serviceCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Handle reservation click
        function handleReservation(serviceId) {
            // Store pending reservation in localStorage
            localStorage.setItem('pendingReservation', JSON.stringify({
                serviceId: serviceId,
                timestamp: Date.now()
            }));
            
            showToast('Silakan login terlebih dahulu untuk melakukan reservasi', 'info');
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 1500);
        }

        // Handle contact form submission
        function handleContactForm(event) {
            event.preventDefault();
            
            // Here you would normally send the data to your server
            // For demo purposes, we\'ll just show a success message
            
            showToast('Pesan Anda telah terkirim! Kami akan menghubungi Anda segera.', 'success');
            
            // Reset form
            event.target.reset();
        }

        // Show toast notification
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            
            // Set message
            toastMessage.textContent = message;
            
            // Set color based on type
            if (type === 'success') {
                toast.className = toast.className.replace(/bg-\w+-\d+/, 'bg-green-500');
            } else if (type === 'info') {
                toast.className = toast.className.replace(/bg-\w+-\d+/, 'bg-blue-500');
            } else if (type === 'error') {
                toast.className = toast.className.replace(/bg-\w+-\d+/, 'bg-red-500');
            }
            
            // Show toast
            toast.classList.remove('translate-x-full');
            
            // Hide after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
            }, 3000);
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = event.target.closest('button[onclick="toggleMobileMenu()"]');
            
            if (!mobileMenu.classList.contains('hidden') && !menuButton && !mobileMenu.contains(event.target)) {
                toggleMobileMenu();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Set default filter
            filterServices('all');
        });
    </script>
</x-main-layout>