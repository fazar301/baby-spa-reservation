<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demo - Buat Ulasan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            babypink: {
              50: '#fdf2f8',
              100: '#fce7f3',
              200: '#fbcfe8',
              300: '#f9a8d4',
              400: '#f472b6',
              500: '#ec4899',
              600: '#db2777',
              700: '#be185d',
              800: '#9d174d',
              900: '#831843'
            },
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
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
</head>
<body class="bg-gray-50 p-8">
  <!-- Demo Container -->
  <div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Demo - Sistem Buat Ulasan</h1>
    
    <!-- Sample Reservation Card -->
    <div class="bg-white rounded-xl shadow-sm mb-8">
      <div class="p-6">
        <div class="flex flex-row items-center justify-between mb-4">
          <div>
            <div class="flex items-center">
              <h3 class="text-lg font-semibold me-3">Pijat Bayi</h3>
              <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold text-xs">RSV-2025-001</div>
            </div>
            <p class="text-sm text-gray-500">Untuk Aditya</p>
          </div>
          <span class="px-3 py-1 bg-green-100 text-green-600 text-sm rounded-full">
            Selesai
          </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div class="space-y-2">
            <div class="flex items-center text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/>
              </svg>
              <span>20 April 2025</span>
            </div>
            <div class="flex items-center text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 text-gray-500">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
              </svg>
              <span>10:00</span>
            </div>
          </div>
          
          <div class="space-y-2">
            <div class="text-sm">
              <span class="text-gray-500">Terapis:</span> Dr. Siti
            </div>
          </div>
        </div>
        
        <div class="flex justify-end">
          <button id="reviewBtn" class="review-btn px-3 py-1.5 text-sm border border-gray-300 rounded-md hover:bg-gray-50" 
                  data-service="Pijat Bayi" 
                  data-therapist="Dr. Siti"
                  data-reservation-code="RSV-2025-001">
            Buat Ulasan
          </button>
        </div>
      </div>
    </div>

    <!-- Instructions -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
      <h2 class="text-lg font-semibold text-blue-900 mb-2">Cara Implementasi:</h2>
      <ol class="list-decimal list-inside text-blue-800 space-y-1">
        <li>Copy HTML structure untuk modal review</li>
        <li>Copy CSS classes untuk styling</li>
        <li>Copy JavaScript functions untuk functionality</li>
        <li>Integrasikan dengan Laravel Blade template Anda</li>
        <li>Sesuaikan data attributes dengan data dari backend</li>
      </ol>
    </div>
  </div>

  <!-- Review Modal -->
  <div id="reviewModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md relative">
      <!-- Modal Header -->
      <div class="flex flex-col space-y-1.5 text-center sm:text-left p-6 pb-4">
        <h2 class="text-lg font-semibold">Buat Ulasan</h2>
        <p class="text-sm text-gray-600">
          Berikan ulasan untuk layanan <span id="modalServiceName">Pijat Bayi</span> dengan <span id="modalTherapistName">Dr. Siti</span>
        </p>
      </div>
      
      <!-- Modal Content -->
      <div class="p-6 pt-0">
        <form id="reviewForm" class="space-y-4">
          <!-- Hidden field for reservation data (you can add more as needed) -->
          <input type="hidden" id="reservationCode" name="reservation_code">
          <input type="hidden" id="serviceName" name="service_name">
          <input type="hidden" id="therapistName" name="therapist_name">
          
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
      <button id="cancelBtn2" type="button" class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none data-[state=open]:bg-accent data-[state=open]:text-muted-foreground"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x h-4 w-4" data-lov-id="src/components/ui/dialog.tsx:46:8" data-lov-name="X" data-component-path="src/components/ui/dialog.tsx" data-component-line="46" data-component-file="dialog.tsx" data-component-name="X" data-component-content="%7B%22className%22%3A%22h-4%20w-4%22%7D"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg><span data-lov-id="src/components/ui/dialog.tsx:47:8" data-lov-name="span" data-component-path="src/components/ui/dialog.tsx" data-component-line="47" data-component-file="dialog.tsx" data-component-name="span" data-component-content="%7B%22text%22%3A%22Close%22%2C%22className%22%3A%22sr-only%22%7D" class="sr-only">Close</span></button>
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

  <script>
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
        this.therapistName = document.getElementById('therapistName');
        
        // Modal display elements
        this.modalServiceName = document.getElementById('modalServiceName');
        this.modalTherapistName = document.getElementById('modalTherapistName');
        
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
        this.modalTherapistName.textContent = therapist;
        
        // Populate hidden fields
        this.reservationCode.value = reservationCode;
        this.serviceName.value = service;
        this.therapistName.value = therapist;
        
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
        
        // For demo purposes, we'll just show success
        // In your Laravel implementation, you would send this data to your backend
        console.log('Form data to be sent:', Object.fromEntries(formData));
        
        // Simulate API call
        try {
          // Replace this with your actual Laravel route
          // const response = await fetch('/api/reviews', {
          //   method: 'POST',
          //   body: formData,
          //   headers: {
          //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          //   }
          // });
          
          // For demo, just simulate success
          await new Promise(resolve => setTimeout(resolve, 500));
          
          this.closeModal();
          this.showToast('success', 'Ulasan Anda telah berhasil dikirim. Terima kasih atas feedback Anda!');
          
        } catch (error) {
          console.error('Error submitting review:', error);
          this.showToast('error', 'Terjadi kesalahan saat mengirim ulasan. Silakan coba lagi.');
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
    
    // Initialize the review system when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
      new ReviewSystem();
    });
  </script>
</body>
</html>