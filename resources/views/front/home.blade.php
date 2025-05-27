<x-main-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-pink-50 py-20">
        <div class="max-w-screen-xl px-4 mx-auto lg:gap-8 xl:gap-0 lg:py-8 lg:grid lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-6">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl">
                    Pengalaman Spa Lembut untuk Si Kecil
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">
                    Sentuhan lembut, air yang menenangkan, dan perawatan khusus yang dirancang khusus untuk bayi.
                </p>
                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('layanan.index') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-pink-500 hover:bg-pink-600 focus:ring-4 focus:ring-pink-300">
                        Buat Reservasi
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                        Lihat Layanan
                    </a>
                </div>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-6 lg:flex md:ps-10">
                <img src="https://placehold.co/600x400" alt="Bayi menikmati perawatan spa lembut" class="rounded-lg">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-[130px] bg-white">
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="max-w-screen-md mx-auto mb-8 text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900">Layanan Spa Kami</h2>
                <p class="text-gray-500 sm:text-xl">
                    Temukan berbagai perawatan khusus yang dirancang untuk menenangkan, merilekskan, dan merangsang perkembangan bayi Anda.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-20">
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
            <a href="{{ route('layanan.index') }}" class="mt-10 text-pink-500 hover:text-pink-600 flex justify-center">
                Lihat lebih banyak
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>
    
    <!-- Services Packet Section -->
    <section id="services_packet" class="py-[130px] bg-white pt-[0]">
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="max-w-screen-md mx-auto mb-8 text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900">Paket Layanan Spa Bayi</h2>
                <p class="text-gray-500 sm:text-xl">
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
            <a href="{{ route('layanan.index', ['type' => 'paket']) }}" class="mt-10 text-pink-500 hover:text-pink-600 flex justify-center">
                Lihat lebih banyak
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-[130px] bg-blue-50">
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="max-w-screen-md mx-auto mb-8 text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900">Manfaat untuk Bayi Anda</h2>
                <p class="text-gray-500 sm:text-xl">
                    Perawatan spa kami dirancang dengan mempertimbangkan kesehatan dan perkembangan bayi Anda.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-pink-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-bold">Tidur Lebih Baik</h3>
                    <p class="mt-2 text-gray-500 text-center">Perawatan kami membantu bayi tidur lebih cepat dan lebih lama.</p>
                </div>
                
                <!-- Benefit 2 -->
                <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-pink-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-bold">Kekebalan Tubuh Lebih Kuat</h3>
                    <p class="mt-2 text-gray-500 text-center">Pijat lembut membantu meningkatkan sistem kekebalan alami bayi Anda.</p>
                </div>
                
                <!-- Benefit 3 -->
                <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-pink-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-bold">Ikatan Lebih Erat</h3>
                    <p class="mt-2 text-gray-500 text-center">Ciptakan momen istimewa dan perkuat hubungan Anda.</p>
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

    <!-- Booking CTA Section -->
    <section class="py-16 bg-gradient-to-r from-pink-100 to-blue-100">
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <h2 class="text-3xl font-extrabold">Siap Memesan Hari Spa untuk Bayi Anda?</h2>
                <p class="text-lg text-gray-700">Berikan hadiah relaksasi dan manfaat perkembangan untuk si kecil Anda.</p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('layanan.index') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-pink-500 hover:bg-pink-600 focus:ring-4 focus:ring-pink-300">
                        Buat Reservasi
                    </a>
                    <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                        Lihat Harga
                    </a>
                </div>
                
                <div class="flex flex-col sm:flex-row justify-center gap-8 pt-4">
                    <div class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-pink-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm">Buka 7 hari seminggu</span>
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-pink-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span class="text-sm">Pemesanan online mudah</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>