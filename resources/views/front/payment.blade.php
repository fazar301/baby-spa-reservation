<x-main-layout>
    <div class="bg-pink-50 py-10">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pembayaran Reservasi</h1>

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Reservation Details -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Reservasi</h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-medium text-gray-700">Layanan</h3>
                                    <p class="text-gray-600">{{ $reservation->service->name }}</p>
                                </div>

                                <div>
                                    <h3 class="font-medium text-gray-700">Jadwal</h3>
                                    <p class="text-gray-600">
                                        {{ \Carbon\Carbon::parse($reservation->appointment_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                        <br>
                                        {{ $reservation->appointment_time }}
                                    </p>
                                </div>

                                <div>
                                    <h3 class="font-medium text-gray-700">Status</h3>
                                    <p class="text-gray-600">
                                        @if($reservation->status === 'pending')
                                            <span class="text-yellow-600">Menunggu Pembayaran</span>
                                        @elseif($reservation->status === 'confirmed')
                                            <span class="text-green-600">Dikonfirmasi</span>
                                        @else
                                            <span class="text-red-600">Dibatalkan</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Pembayaran</h2>

                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Harga Layanan</span>
                                    <span class="text-gray-800">Rp {{ number_format($reservation->price, 0, ',', '.') }}</span>
                                </div>

                                @if($reservation->discount_amount > 0)
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600">Diskon</span>
                                        <span class="text-green-600">- Rp {{ number_format($reservation->discount_amount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <div class="border-t border-gray-200 my-2"></div>

                                <div class="flex justify-between font-semibold">
                                    <span class="text-gray-800">Total Pembayaran</span>
                                    <span class="text-pink-600">Rp {{ number_format($reservation->final_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Voucher Form -->
                            @if($reservation->status === 'pending')
                                <form action="{{ route('reservations.apply-voucher', $reservation) }}" method="POST" class="mb-6">
                                    @csrf
                                    <div class="flex gap-2">
                                        <input type="text" name="voucher_code" placeholder="Masukkan kode voucher" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                                        <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">Terapkan</button>
                                    </div>
                                </form>

                                <!-- Payment Instructions -->
                                <div class="bg-pink-50 rounded-lg p-4">
                                    <h3 class="font-medium text-gray-800 mb-2">Instruksi Pembayaran</h3>
                                    <p class="text-sm text-gray-600 mb-4">
                                        Silakan lakukan pembayaran melalui salah satu metode berikut:
                                    </p>
                                    
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <div class="bg-white rounded-full p-2 mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Transfer Bank</p>
                                                <p class="text-sm text-gray-600">BCA: 1234567890</p>
                                                <p class="text-sm text-gray-600">a.n. Baby Spa</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center">
                                            <div class="bg-white rounded-full p-2 mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">E-Wallet</p>
                                                <p class="text-sm text-gray-600">GoPay: 0812-3456-7890</p>
                                                <p class="text-sm text-gray-600">a.n. Baby Spa</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600">
                                            Setelah melakukan pembayaran, silakan konfirmasi dengan mengklik tombol di bawah ini.
                                        </p>
                                        <form action="{{ route('reservations.confirm-payment', $reservation) }}" method="POST" class="mt-4">
                                            @csrf
                                            <button type="submit" class="w-full px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">
                                                Konfirmasi Pembayaran
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout> 