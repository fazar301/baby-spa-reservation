<x-user-dashboard>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold md:mt-0">Reservasi</h1>
        <div class="flex items-center gap-4">
          <x-notification-button :count="3" />
          <x-profile-dropdown username="Akun Saya" />
        </div>
    </div>
    <!-- Search and New Reservation -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="relative w-full md:w-64">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 text-gray-500"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" placeholder="Cari reservasi..." class="w-full pl-8 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-babypink-500 focus:border-transparent">
    </div>
    <form class="flex flex-col md:flex-row gap-4 w-full md:w-auto" method="GET" id="reservation-form">
        <div class="w-full md:w-64">
            <label for="service" class="block text-sm font-medium text-gray-700">Pilih Layanan</label>
            <select id="service" name="service" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                <option value="">Pilih Layanan</option>
                <optgroup label="Layanan">
                    @foreach($layanans as $layanan)
                        <option value="layanan:{{ $layanan->slug }}">{{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga_layanan, 0, ',', '.') }}</option>
                    @endforeach
                </optgroup>
                <optgroup label="Paket Layanan">
                    @foreach($paketLayanans as $paket)
                        <option value="paket:{{ $paket->slug }}">{{ $paket->nama_paket }} - Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full md:w-auto px-4 py-2 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md" disabled>Pilih & Reservasi</button>
        </div>
    </form>
    </div>

    <!-- Tabs -->
    <div class="mb-4 border-b">
    <div class="flex">
        <button id="tab-upcoming" class="px-4 py-2 border-b-2 border-babypink-500 text-babypink-500">Akan Datang</button>
        <button id="tab-past" class="px-4 py-2 border-b-2 border-transparent text-gray-500">Riwayat</button>
    </div>
    </div>

    <!-- Reservations - Upcoming Tab -->
    <div id="upcoming-tab-content" class="block">
    @foreach($reservations as $reservation)
        @php
            $sesiDateTime = \Carbon\Carbon::parse($reservation->tanggal_reservasi->format('Y-m-d') . ' ' . $reservation->sesi->jam);
            $isPast = now()->gt($sesiDateTime->addHour()); // dianggap selesai 1 jam setelah sesi dimulai
        @endphp
        @if(!$isPast)
        <div class="bg-white rounded-xl shadow-sm mb-4">
            <div class="p-6">
                <div class="flex flex-row items-center justify-between mb-4">
                    <div>
                        <div class="flex items-center">
                            <h3 class="text-lg font-semibold me-3">{{ $reservation->type === 'layanan' ? $reservation->layanan->nama_layanan : $reservation->paketLayanan->nama_paket }}</h3>
                            <div style="height: min-content" class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground text-xs">{{ $reservation->kode }}</div>
                        </div>
                        <p class="text-sm text-gray-500">Untuk {{ $reservation->bayi->nama }}</p>
                    </div>
                    <span style="width: min-content" class="self-start mt-0 px-3 py-1 {{ $reservation->status === 'confirmed' ? 'bg-babypink-100 text-babypink-600' : 'bg-orange-100 text-orange-600' }} text-sm rounded-full">
                        {{ $reservation->status === 'confirmed' ? 'Dikonfirmasi' : 'Menunggu' }}
                    </span>
                </div>
                
                <div class="grid grid-cols-1 grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <span>{{ $reservation->tanggal_reservasi->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span>{{ Str::substr($reservation->sesi->jam,0,5) }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                    @if($reservation->catatan)
                    <div class="text-sm">
                        <span class="text-gray-500">Catatan:</span> {{ $reservation->catatan }}
                    </div>
                    @endif
                    </div>
                </div>
                <div class="flex justify-end mt-4 space-x-2">
                    @if($reservation->status === 'confirmed')
                    <button class="ubah-jadwal-btn px-3 py-1.5 text-sm border border-gray-300 rounded-md"
                        data-kode="{{ $reservation->kode }}"
                        data-service="{{ $reservation->type === 'layanan' ? $reservation->layanan->nama_layanan : $reservation->paketLayanan->nama_paket }}"
                        data-date="{{ $reservation->tanggal_reservasi->format('d F Y') }}"
                        data-time="{{ Str::substr($reservation->sesi->jam,0,5) }}"
                        data-baby="{{ $reservation->bayi->nama }}">
                        Ubah Jadwal
                    </button>
                    {{-- <button class="px-3 py-1.5 text-sm bg-red-500 text-white rounded-md">
                        Batalkan
                    </button> --}}
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
    </div>

    <!-- Reservations - Past Tab -->
    <div id="past-tab-content" class="hidden">
    @foreach($reservations as $reservation)
        @php
            $sesiDateTime = \Carbon\Carbon::parse($reservation->tanggal_reservasi->format('Y-m-d') . ' ' . $reservation->sesi->jam);
            $isPast = now()->gt($sesiDateTime->addHour()); // dianggap selesai 1 jam setelah sesi dimulai
        @endphp

        @if($isPast)
        <div class="bg-white rounded-xl shadow-sm mb-4">
            <div class="p-6">
                <div class="flex flex-row items-center justify-between mb-4">
                    <div>
                        <div class="flex items-center">
                            <h3 class="text-lg font-semibold me-3">{{ $reservation->type === 'layanan' ? $reservation->layanan->nama_layanan : $reservation->paketLayanan->nama_paket }}</h3>
                            <div style="height: min-content" class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground text-xs">{{ $reservation->kode }}</div>
                        </div>
                        <p class="text-sm text-gray-500">Untuk {{ $reservation->bayi->nama }}</p>
                    </div>
                    <span style="width: min-content" class="self-start mt-0 px-3 py-1 bg-green-100 text-green-600 text-sm rounded-full">
                    Selesai
                    </span>
                </div>
            
                <div class="grid grid-cols-1 grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <span>{{ $reservation->tanggal_reservasi->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span>{{ Str::substr($reservation->sesi->jam,0,5) }}</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        @if($reservation->catatan)
                        <div class="text-sm">
                            <span class="text-gray-500">Catatan:</span> {{ $reservation->catatan }}
                        </div>
                        @endif    
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    @if(!$reservation->ulasan)
                    <button class="review-btn px-3 py-1.5 text-sm border border-gray-300 rounded-md hover:bg-gray-50" 
                            data-service="{{ $reservation->type === 'layanan' ? $reservation->layanan->nama_layanan : $reservation->paketLayanan->nama_paket }}" 
                            data-reservation-code="{{ $reservation->kode }}">
                        Buat Ulasan
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
    </div>
    <!-- Pagination Controls -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 py-3 border-t">
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-700">
                Menampilkan
                <span id="startIndex" class="font-medium">1</span>
                -
                <span id="endIndex" class="font-medium">5</span>
                dari
                <span id="totalItems" class="font-medium">0</span>
                hasil
            </span>
        </div>
        <div class="flex items-center gap-2">
            <button id="prevPage" class="px-3 py-1 rounded-md border text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Sebelumnya
            </button>
            <div id="pageNumbers" class="flex items-center gap-1">
                <!-- Page numbers will be dynamically populated -->
            </div>
            <button id="nextPage" class="px-3 py-1 rounded-md border text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Berikutnya
            </button>
        </div>
    </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            
            const tabs = {
                upcoming: {
                    button: document.getElementById('tab-upcoming'),
                    content: document.getElementById('upcoming-tab-content')
                },
                past: {
                    button: document.getElementById('tab-past'),
                    content: document.getElementById('past-tab-content')
                }
            };

            // Review System JavaScript
            class ReviewSystem {
                constructor() {
                    this.currentRating = 0;
                    this.ratingTexts = {
                        0: "Pilih rating",
                        1: "Sangat Buruk", 
                        2: "Buruk",
                        3: "Cukup",
                        4: "Baik",
                        5: "Sangat Baik"
                    };
                    
                    this.initializeElements();
                    this.bindEvents();
                }
                
                initializeElements() {
                    // Modal elements
                    this.modal = document.getElementById('reviewModal');
                    this.form = document.getElementById('reviewForm');
                    this.cancelBtn = document.getElementById('cancelBtn');
                    this.cancelBtn2 = document.getElementById('cancelBtn2');
                    this.submitBtn = document.getElementById('submitBtn');
                    
                    // Form elements
                    this.starButtons = document.querySelectorAll('.star-button');
                    this.ratingText = document.getElementById('ratingText');
                    this.ratingValue = document.getElementById('ratingValue');
                    this.reviewText = document.getElementById('reviewText');
                    
                    // Hidden fields for data
                    this.reservationCode = document.getElementById('reservationCode');
                    this.serviceName = document.getElementById('serviceName');
                    
                    
                    // Modal display elements
                    this.modalServiceName = document.getElementById('modalServiceName');
                    
                    
                    // Toast elements
                    this.successToast = document.getElementById('successToast');
                    this.errorToast = document.getElementById('errorToast');
                    this.errorMessage = document.getElementById('errorMessage');
                    this.closeToast = document.getElementById('closeToast');
                    this.closeErrorToast = document.getElementById('closeErrorToast');
                }
                
                bindEvents() {
                    // Review button click
                    document.addEventListener('click', (e) => {
                        if (e.target.classList.contains('review-btn') || e.target.closest('.review-btn')) {
                            const btn = e.target.classList.contains('review-btn') ? e.target : e.target.closest('.review-btn');
                            this.openReviewModal(btn);
                        }
                    });
                    
                    // Star rating
                    this.starButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            this.setRating(parseInt(button.getAttribute('data-rating')));
                        });
                    });
                    
                    // Modal controls
                    this.cancelBtn.addEventListener('click', () => this.closeModal());
                    this.cancelBtn2.addEventListener('click', () => this.closeModal());
                    this.submitBtn.addEventListener('click', () => this.submitReview());
                    
                    // Close modal when clicking outside
                    this.modal.addEventListener('click', (e) => {
                        if (e.target === this.modal) {
                            this.closeModal();
                        }
                    });
                    
                    // Toast controls
                    this.closeToast.addEventListener('click', () => this.hideToast('success'));
                    this.closeErrorToast.addEventListener('click', () => this.hideToast('error'));
                    
                    // Auto-hide toasts
                    this.autoHideToasts();
                }
                
                openReviewModal(button) {
                    // Get data from button attributes
                    const service = button.getAttribute('data-service');
                    const therapist = button.getAttribute('data-therapist');
                    const reservationCode = button.getAttribute('data-reservation-code');
                    
                    // Populate modal with data
                    this.modalServiceName.textContent = service;
                    
                    
                    // Populate hidden fields
                    this.reservationCode.value = reservationCode;
                    this.serviceName.value = service;
                    
                    
                    // Reset form
                    this.resetForm();
                    
                    // Show modal
                    this.modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
                
                closeModal() {
                    this.modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                    this.resetForm();
                }
                
                setRating(rating) {
                    this.currentRating = rating;
                    this.ratingValue.value = rating;
                    this.updateStarDisplay();
                    this.ratingText.textContent = this.ratingTexts[rating];
                }
                
                updateStarDisplay() {
                    this.starButtons.forEach((button, index) => {
                        const star = button.querySelector('svg');
                        if (index < this.currentRating) {
                            star.classList.remove('star-empty');
                            star.classList.add('star-filled');
                        } else {
                            star.classList.remove('star-filled');
                            star.classList.add('star-empty');
                        }
                    });
                }
                
                resetForm() {
                    this.currentRating = 0;
                    this.ratingValue.value = 0;
                    this.reviewText.value = '';
                    this.updateStarDisplay();
                    this.ratingText.textContent = this.ratingTexts[0];
                }
                
                validateForm() {
                    if (this.currentRating === 0) {
                        this.showToast('error', 'Mohon berikan rating untuk layanan');
                        return false;
                    }
                    return true;
                }
                
                async submitReview() {
                    if (!this.validateForm()) {
                        return;
                    }
                    
                    // Prepare form data
                    const formData = new FormData(this.form);
                    
                    try {
                        const response = await fetch('/api/reviews', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });
                        
                        if (!response.ok) {
                            const errorData = await response.json();
                            throw new Error(errorData.message || 'Network response was not ok');
                        }
                        
                        const result = await response.json();
                        this.closeModal();
                        this.showToast('success', 'Ulasan Anda telah berhasil dikirim. Terima kasih atas feedback Anda!');
                        
                        // Reload the page to update the review button visibility
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                        
                    } catch (error) {
                        console.error('Error submitting review:', error);
                        this.showToast('error', error.message || 'Terjadi kesalahan saat mengirim ulasan. Silakan coba lagi.');
                    }
                }
                
                showToast(type, message) {
                    if (type === 'success') {
                        this.successToast.classList.remove('hidden');
                    } else {
                        this.errorMessage.textContent = message;
                        this.errorToast.classList.remove('hidden');
                    }
                }
                
                hideToast(type) {
                    if (type === 'success') {
                        this.successToast.classList.add('hidden');
                    } else {
                        this.errorToast.classList.add('hidden');
                    }
                }
                
                autoHideToasts() {
                    // Auto-hide success toast after 5 seconds
                    const successObserver = new MutationObserver((mutations) => {
                        mutations.forEach((mutation) => {
                            if (!this.successToast.classList.contains('hidden')) {
                                setTimeout(() => {
                                    this.hideToast('success');
                                }, 5000);
                            }
                        });
                    });
                    
                    successObserver.observe(this.successToast, {
                        attributes: true,
                        attributeFilter: ['class']
                    });
                }
            }

            // Initialize the review system
            new ReviewSystem();

            // Pagination state
            let currentPage = 1;
            const itemsPerPage = 5;
            let filteredReservations = [];
            
            // Function to get all reservations from the current tab
            function getCurrentTabReservations() {
                const activeTab = tabs.upcoming.content.classList.contains('hidden') ? 'past' : 'upcoming';
                const reservations = Array.from(tabs[activeTab].content.querySelectorAll('.bg-white'));
                return reservations;
            }
            
            // Function to render reservations
            function renderReservations(items) {
                const activeTab = tabs.upcoming.content.classList.contains('hidden') ? 'past' : 'upcoming';
                const container = tabs[activeTab].content;
                
                // Hide all reservations first
                container.querySelectorAll('.bg-white').forEach(reservation => {
                    reservation.style.display = 'none';
                });
                
                // Show only the reservations for current page
                items.forEach(reservation => {
                    reservation.style.display = 'block';
                });
            }
            
            // Function to render pagination
            function renderPagination() {
                const totalPages = Math.ceil(filteredReservations.length / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage + 1;
                const endIndex = Math.min(currentPage * itemsPerPage, filteredReservations.length);
                
                // Update pagination info
                document.getElementById('startIndex').textContent = startIndex;
                document.getElementById('endIndex').textContent = endIndex;
                document.getElementById('totalItems').textContent = filteredReservations.length;
                
                // Update pagination buttons
                document.getElementById('prevPage').disabled = currentPage === 1;
                document.getElementById('nextPage').disabled = currentPage === totalPages;
                
                // Render page numbers
                const pageNumbers = document.getElementById('pageNumbers');
                pageNumbers.innerHTML = '';
                
                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.className = `w-8 h-8 flex items-center justify-center rounded-md text-sm font-medium
                        ${currentPage === i ? 'bg-babypink-50 text-babypink-600 border-babypink-200' : 'text-gray-700 hover:bg-gray-50 border'}
                        border`;
                    button.textContent = i;
                    button.addEventListener('click', () => goToPage(i));
                    pageNumbers.appendChild(button);
                }
            }
            
            // Function to go to specific page
            function goToPage(page) {
                currentPage = page;
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                renderReservations(filteredReservations.slice(start, end));
                renderPagination();
            }
            
            // Initialize pagination controls
            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) goToPage(currentPage - 1);
            });
            
            document.getElementById('nextPage').addEventListener('click', () => {
                const totalPages = Math.ceil(filteredReservations.length / itemsPerPage);
                if (currentPage < totalPages) goToPage(currentPage + 1);
            });
    
            // Function to switch tabs
            function switchTab(activeTab) {
                console.log('Switching to tab:', activeTab);
                
                // Hide all content
                Object.values(tabs).forEach(tab => {
                    tab.content.classList.add('hidden');
                    tab.content.classList.remove('block');
                    tab.button.classList.remove('border-babypink-500', 'text-babypink-500');
                    tab.button.classList.add('border-transparent', 'text-gray-500');
                });
    
                // Show active content
                tabs[activeTab].content.classList.remove('hidden');
                tabs[activeTab].content.classList.add('block');
                tabs[activeTab].button.classList.remove('border-transparent', 'text-gray-500');
                tabs[activeTab].button.classList.add('border-babypink-500', 'text-babypink-500');

                // Update pagination for the new tab
                filteredReservations = getCurrentTabReservations();
                goToPage(1);
            }
    
            // Add click event listeners
            tabs.upcoming.button.addEventListener('click', () => {
                console.log('Upcoming tab clicked');
                switchTab('upcoming');
            });
    
            tabs.past.button.addEventListener('click', () => {
                console.log('Past tab clicked');
                switchTab('past');
            });
    
            // Initialize with upcoming tab
            switchTab('upcoming');

            const form = document.getElementById('reservation-form');
            const select = form.querySelector('select[name="service"]');
            const button = form.querySelector('button[type="submit"]');

            select.addEventListener('change', function() {
                button.disabled = !this.value;
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (select.value) {
                    const [type, slug] = select.value.split(':');
                    const url = `/reservasi/create/${type}/${slug}`;
                    window.location.href = url;
                }
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('ubah-jadwal-btn')) {
                    const btn = e.target;
                    const kode = btn.getAttribute('data-kode');
                    const service = btn.getAttribute('data-service');
                    const date = btn.getAttribute('data-date');
                    const time = btn.getAttribute('data-time');
                    const baby = btn.getAttribute('data-baby');
                    // WhatsApp number from footer, format: 6281212933442
                    const waNumber = '6281212933442';
                    const message = `Halo Admin, saya ingin mengubah jadwal reservasi dengan detail berikut:%0A%0AKode Reservasi: ${kode}%0ALayanan: ${service}%0ATanggal: ${date}%0AJam: ${time}%0ANama Bayi: ${baby}%0A%0AMohon bantuannya. Terima kasih.`;
                    const waUrl = `https://wa.me/${waNumber}?text=${message}`;
                    window.open(waUrl, '_blank');
                }
            });
        });
    </script>
    @endpush

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md relative">
            <!-- Modal Header -->
            <div class="flex flex-col space-y-1.5 text-center sm:text-left p-6 pb-4">
                <h2 class="text-lg font-semibold">Buat Ulasan</h2>
                <p class="text-sm text-gray-600">
                    Berikan ulasan untuk layanan <span id="modalServiceName">Pijat Bayi</span>
                </p>
            </div>
            
            <!-- Modal Content -->
            <div class="p-6 pt-0">
                <form id="reviewForm" class="space-y-4">
                    <!-- Hidden field for reservation data -->
                    <input type="hidden" id="reservationCode" name="reservation_code">
                    <input type="hidden" id="serviceName" name="service_name">
                    
                    <!-- Rating Section -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium">Rating Layanan</label>
                        <div class="flex gap-1" id="starRating">
                            <button type="button" class="star-button p-1" data-rating="1">
                                <svg class="h-6 w-6 star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                            </button>
                            <button type="button" class="star-button p-1" data-rating="2">
                                <svg class="h-6 w-6 star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                            </button>
                            <button type="button" class="star-button p-1" data-rating="3">
                                <svg class="h-6 w-6 star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                            </button>
                            <button type="button" class="star-button p-1" data-rating="4">
                                <svg class="h-6 w-6 star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                            </button>
                            <button type="button" class="star-button p-1" data-rating="5">
                                <svg class="h-6 w-6 star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
                                </svg>
                            </button>
                        </div>
                        <input type="hidden" id="ratingValue" name="rating" value="0">
                        <p class="text-sm text-gray-500" id="ratingText">Pilih rating</p>
                    </div>
                    
                    <!-- Review Text Section -->
                    <div class="space-y-2">
                        <label for="reviewText" class="text-sm font-medium">Ulasan (Opsional)</label>
                        <textarea
                            id="reviewText"
                            name="review_text"
                            placeholder="Ceritakan pengalaman Anda dengan layanan ini..."
                            rows="4"
                            class="flex w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-babypink-500 focus-visible:ring-offset-2"
                        ></textarea>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2 p-6 pt-0">
                <button type="button" id="cancelBtn" class="mt-2 sm:mt-0 inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white hover:bg-gray-50 h-10 px-4 py-2">
                    Batalkan
                </button>
                <button type="button" id="submitBtn" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-babypink-500 text-white hover:bg-babypink-600 h-10 px-4 py-2">
                    Kirim Ulasan
                </button>
            </div>
            <button id="cancelBtn2" type="button" class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x h-4 w-4">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </div>
    </div>

    <!-- Success Toast -->
    <div id="successToast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 min-w-80">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-gray-900">Berhasil!</h3>
                    <p class="text-sm text-gray-600 mt-1">Ulasan Anda telah berhasil dikirim. Terima kasih atas feedback Anda!</p>
                </div>
                <button type="button" id="closeToast" class="flex-shrink-0">
                    <svg class="h-4 w-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white border border-red-200 rounded-lg shadow-lg p-4 min-w-80">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-gray-900">Error!</h3>
                    <p class="text-sm text-gray-600 mt-1" id="errorMessage">Mohon berikan rating untuk layanan</p>
                </div>
                <button type="button" id="closeErrorToast" class="flex-shrink-0">
                    <svg class="h-4 w-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <style>
        .star-button {
            transition: transform 0.1s ease;
        }
        .star-button:hover {
            transform: scale(1.1);
        }
        .star-filled {
            color: #eab308;
            fill: currentColor;
        }
        .star-empty {
            color: rgb(209 213 219);
            fill: currentColor;
        }
    </style>
</x-user-dashboard>
