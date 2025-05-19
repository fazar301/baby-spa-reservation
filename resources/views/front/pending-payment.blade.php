<x-main-layout>
    <div class="bg-pink-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-8">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran Pending</h1>
                    <p class="text-gray-600">Pembayaran Anda sedang diproses. Mohon tunggu konfirmasi dari kami.</p>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Status pembayaran Anda akan diperbarui secara otomatis. Anda juga akan menerima email konfirmasi setelah pembayaran selesai.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Status Pembayaran</span>
                        <span class="px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('reservasi.index') }}" class="inline-block px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition">
                        Kembali ke Halaman Reservasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-main-layout> 