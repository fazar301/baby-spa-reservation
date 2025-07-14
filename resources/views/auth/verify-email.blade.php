<x-auth-layout>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl my-8">
        <div class="p-8">
            <!-- Header with Baby Spa Logo -->
            {{-- <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Baby Spa Logo" class="h-16">
            </div> --}}
            
            <!-- Decorative Baby Elements -->
            {{-- <div class="flex justify-between mb-6">
                <img src="{{ asset('images/baby-float.png') }}" alt="Baby Float" class="h-10 opacity-50">
                <img src="{{ asset('images/baby-duck.png') }}" alt="Baby Duck" class="h-10 opacity-50">
            </div> --}}
            
            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-pink-600 mb-4">
                {{ __('Verifikasi Email Anda') }}
            </h2>
            
            <!-- Message -->
            <div class="mb-6 text-sm text-gray-700 bg-pink-50 p-4 rounded-lg border-l-4 border-pink-300 fs-7">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan kepada Anda? Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan email lain.') }}
            </div>

            <!-- Success Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-medium text-sm text-pink-600 bg-pink-50 p-4 rounded-lg border border-pink-200">
                    <div class="flex items-center fs-7">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                    </div>
                </div>
            @endif

            <!-- Buttons -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-medium rounded-lg text-sm transition duration-300 ease-in-out flex items-center justify-center fs-7">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 border border-pink-300 text-pink-600 hover:bg-pink-50 font-medium rounded-lg text-sm transition duration-300 ease-in-out flex items-center justify-center fs-7">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
            
            <!-- Decorative Footer -->
            <div class="mt-8 border-t border-pink-100 pt-4">
                <p class="text-xs text-center text-pink-400 fs-8">
                    {{ __('Baby Spa - Tempat terbaik untuk perawatan si kecil') }}
                </p>
            </div>
        </div>
    </div>
</x-auth-layout>
