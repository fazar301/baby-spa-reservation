<x-main-layout>
    <div class="bg-pink-50 py-10">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="mb-6">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Reservasi Berhasil!</h1>
                <p class="text-lg text-gray-600 mb-8">
                    Terima kasih telah melakukan reservasi di Baby Spa. Detail reservasi telah dikirim ke email dan WhatsApp Anda.
                </p>
                
                <div class="space-y-4">
                    <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">
                        Kembali ke Dashboard
                    </a>
                    @if(isset($reservation) && $reservation->id)
                    <a href="{{ route('reservasi.invoice', $reservation->id) }}" class="inline-block px-6 py-3 border border-pink-500 text-pink-500 rounded-lg hover:bg-pink-50 transition ml-4">
                        Unduh Invoice
                    </a>
                    @endif
                    <a href="{{ route('layanan.index') }}" class="inline-block px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition ml-4">
                        Lihat Layanan Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-main-layout> 