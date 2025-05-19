<x-main-layout>
    <div class="bg-pink-50 py-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran Reservasi</h1>
                <p class="text-gray-600">Selesaikan pembayaran untuk layanan Baby Spa Anda</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Payment Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Reservasi</h2>
                        
                        <!-- Reservation Details -->
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-700">
                                    @if($reservation->type === 'layanan')
                                        {{ $reservation->layanan->nama_layanan }}
                                    @else
                                        {{ $reservation->paketLayanan->nama_paket }}
                                    @endif
                                </span>
                                <span class="font-medium">{{ 'Rp ' . number_format($reservation->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-700">Subtotal</span>
                                <span class="font-medium">{{ 'Rp ' . number_format($reservation->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <!-- Voucher Code Input -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-3">Kode Voucher</h3>
                            <form id="voucher-form" class="mb-2" autocomplete="off">
                                <div class="flex">
                                    <input type="text" id="voucher-code" placeholder="Masukkan kode voucher" class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    <button type="submit" id="apply-voucher" class="px-4 py-2 bg-pink-500 text-white rounded-r-lg hover:bg-pink-600 transition">Terapkan</button>
                                </div>
                            </form>
                            <div id="voucher-message" class="mt-2 text-sm hidden"></div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-700">Total</span>
                                <span class="text-xl font-bold text-pink-600" id="total-amount">{{ 'Rp ' . number_format($reservation->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pelanggan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-500">Nama Orang Tua</p>
                                <p class="font-medium">{{ $reservation->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama Bayi</p>
                                <p class="font-medium">{{ $reservation->bayi->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nomor Telepon</p>
                                <p class="font-medium">{{ $reservation->user->noHP }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ $reservation->user->email ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>
                        <form action="{{ route('payment.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <input type="hidden" name="amount" id="payment-amount" value="{{ $reservation->harga }}">
                            <input type="hidden" name="voucher_code" id="applied-voucher-code" value="">
                            <input type="hidden" name="discount_amount" id="discount-amount-input" value="0">
                            
                            <div class="space-y-4 mb-6">
                                <!-- Payment Method: Midtrans -->
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="payment_method" value="midtrans" class="form-radio h-5 w-5 text-pink-500" checked>
                                        <span class="ml-2 text-gray-700">Midtrans (Kartu Kredit, QRIS, Bank Transfer, E-Wallet)</span>
                                    </label>
                                    <div class="mt-3 pl-7">
                                        <p class="text-sm text-gray-600">Pembayaran online melalui berbagai metode pembayaran yang tersedia di Midtrans</p>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <img src="{{ asset('images/payment/visa.png') }}" alt="Visa" class="h-8">
                                            <img src="{{ asset('images/payment/mastercard.png') }}" alt="Mastercard" class="h-8">
                                            <img src="{{ asset('images/payment/bca.png') }}" alt="BCA" class="h-8">
                                            <img src="{{ asset('images/payment/mandiri.png') }}" alt="Mandiri" class="h-8">
                                            <img src="{{ asset('images/payment/gopay.png') }}" alt="GoPay" class="h-8">
                                            <img src="{{ asset('images/payment/ovo.png') }}" alt="OVO" class="h-8">
                                            <img src="{{ asset('images/payment/qris.png') }}" alt="QRIS" class="h-8">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Payment Method: Cash -->
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="payment_method" value="cash" class="form-radio h-5 w-5 text-pink-500">
                                        <span class="ml-2 text-gray-700">Tunai (Bayar di Tempat)</span>
                                    </label>
                                    <div class="mt-3 pl-7">
                                        <p class="text-sm text-gray-600">Pembayaran tunai dilakukan saat Anda datang ke Baby Spa Blade</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" id="terms" name="terms_agreement" class="form-checkbox h-5 w-5 text-pink-500" required>
                                    <span class="ml-2 text-gray-700">Saya setuju dengan <a href="/terms" class="text-pink-500 hover:underline">Syarat & Ketentuan</a> dan <a href="/privacy-policy" class="text-pink-500 hover:underline">Kebijakan Privasi</a></span>
                                </label>
                            </div>
                            
                            <button type="submit" id="pay-button" class="w-full py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center">
                                <div class="bg-pink-100 rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Pelanggan</h3>
                                    <p class="text-sm text-gray-600">{{ $reservation->user->name }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="bg-pink-100 rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Jadwal</h3>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                                    <p class="text-sm text-gray-600">{{ $reservation->waktu_reservasi }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="bg-pink-100 rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Lokasi</h3>
                                    <p class="text-sm text-gray-600">Baby Spa Blade</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-700">Subtotal</span>
                                <span class="font-medium">{{ 'Rp ' . number_format($reservation->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between mb-2 text-green-600 hidden" id="discount-row">
                                <span>Diskon Voucher</span>
                                <span id="discount-amount">-Rp 0</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-gray-200 mt-2">
                                <span class="font-medium text-gray-700">Total</span>
                                <span class="font-bold text-pink-600" id="sidebar-total">{{ 'Rp ' . number_format($reservation->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">Butuh bantuan?</p>
                            <a href="/contact" class="text-pink-500 hover:underline text-sm font-medium">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const voucherForm = document.getElementById('voucher-form');
    const voucherCodeInput = document.getElementById('voucher-code');
    const voucherMessage = document.getElementById('voucher-message');
    const totalAmount = document.getElementById('total-amount');
    const sidebarTotal = document.getElementById('sidebar-total');
    const discountRow = document.getElementById('discount-row');
    const discountAmount = document.getElementById('discount-amount');
    const paymentAmountInput = document.getElementById('payment-amount');
    const discountAmountInput = document.getElementById('discount-amount-input');
    const appliedVoucherCode = document.getElementById('applied-voucher-code');
    const reservationId = document.querySelector('input[name="reservation_id"]').value;
    const paymentForm = document.querySelector('form[action="{{ route('payment.process') }}"]');

    voucherForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const code = voucherCodeInput.value.trim();
        if (!code) return;
        fetch(`/reservations/${reservationId}/apply-voucher`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ voucher_code: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                voucherMessage.className = 'mt-2 text-sm text-green-600';
                voucherMessage.textContent = `Voucher berhasil diterapkan! Diskon: Rp ${parseInt(data.discount).toLocaleString('id-ID')}`;
                voucherMessage.classList.remove('hidden');
                discountRow.classList.remove('hidden');
                discountAmount.textContent = `-Rp ${parseInt(data.discount).toLocaleString('id-ID')}`;
                totalAmount.textContent = `Rp ${parseInt(data.final_amount).toLocaleString('id-ID')}`;
                sidebarTotal.textContent = `Rp ${parseInt(data.final_amount).toLocaleString('id-ID')}`;
                paymentAmountInput.value = data.final_amount;
                discountAmountInput.value = data.discount;
                appliedVoucherCode.value = code;
            } else {
                voucherMessage.className = 'mt-2 text-sm text-red-600';
                voucherMessage.textContent = data.message || 'Voucher tidak valid.';
                voucherMessage.classList.remove('hidden');
                discountRow.classList.add('hidden');
                discountAmount.textContent = '-Rp 0';
                totalAmount.textContent = paymentAmountInput.value;
                sidebarTotal.textContent = paymentAmountInput.value;
                discountAmountInput.value = 0;
                appliedVoucherCode.value = '';
            }
        })
        .catch(() => {
            voucherMessage.className = 'mt-2 text-sm text-red-600';
            voucherMessage.textContent = 'Terjadi kesalahan saat memproses voucher.';
            voucherMessage.classList.remove('hidden');
        });
    });

    // Handle payment form submission
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable pay button
        const payButton = document.getElementById('pay-button');
        payButton.disabled = true;
        payButton.textContent = 'Memproses...';

        // Get form data
        const formData = new FormData(this);
        
        // Send payment request
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Open Midtrans Snap
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        console.log('Snap onSuccess result:', result);
                        // Send payment result to backend for verification
                        fetch('/payment/verify', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: JSON.stringify(result)
                        })
                        .then(response => {
                            console.log('Verification response:', response);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Verification data:', data);
                            if (data.success) {
                                window.location.href = '{{ route('reservasi.success') }}';
                            } else {
                                alert('Terjadi kesalahan saat memverifikasi pembayaran. Silakan hubungi customer service.');
                                payButton.disabled = false;
                                payButton.textContent = 'Bayar Sekarang';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memverifikasi pembayaran. Silakan hubungi customer service.');
                            payButton.disabled = false;
                            payButton.textContent = 'Bayar Sekarang';
                        });
                    },
                    onPending: function(result) {
                        console.log('Snap onPending result:', result);
                        window.location.href = '{{ route('reservasi.pending') }}';
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal! Silakan coba lagi.');
                        payButton.disabled = false;
                        payButton.textContent = 'Bayar Sekarang';
                    },
                    onClose: function() {
                        alert('Pembayaran dibatalkan. Silakan coba lagi jika Anda ingin melanjutkan pembayaran.');
                        payButton.disabled = false;
                        payButton.textContent = 'Bayar Sekarang';
                    }
                });

                // Function to poll payment status
                function startPollingPaymentStatus(snapToken) {
                    const pollInterval = setInterval(() => {
                        fetch('/payment/verify', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: JSON.stringify({ snap_token: snapToken })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.status === 'settlement') {
                                clearInterval(pollInterval);
                                window.location.href = '{{ route('reservasi.success') }}';
                            } else if (data.success && data.status === 'expire') {
                                clearInterval(pollInterval);
                                alert('Pembayaran telah kedaluwarsa. Silakan coba lagi.');
                                payButton.disabled = false;
                                payButton.textContent = 'Bayar Sekarang';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            clearInterval(pollInterval);
                            alert('Terjadi kesalahan saat memeriksa status pembayaran. Silakan hubungi customer service.');
                            payButton.disabled = false;
                            payButton.textContent = 'Bayar Sekarang';
                        });
                    }, 5000); // Poll every 5 seconds
                }
            } else {
                alert(data.message || 'Terjadi kesalahan saat memproses pembayaran.');
                payButton.disabled = false;
                payButton.textContent = 'Bayar Sekarang';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses pembayaran.');
            payButton.disabled = false;
            payButton.textContent = 'Bayar Sekarang';
        });
    });

    // Enable pay button when terms are accepted
    document.getElementById('terms').addEventListener('change', function() {
        document.getElementById('pay-button').disabled = !this.checked;
    });
});
</script>