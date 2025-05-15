
    <x-user-dashboard>
        
    
      <h1 class="text-2xl font-bold mb-6 mt-8 md:mt-0">Layanan</h1>
      
      <!-- Search -->
      <div class="relative w-full max-w-md mx-auto mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 text-gray-500"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" placeholder="Cari layanan spa bayi..." class="w-full pl-8 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-babypink-500 focus:border-transparent">
      </div>
      
      <!-- Tabs -->
      <div class="mb-6 border-b">
        <div class="flex flex-wrap">
          <button id="tab-all" class="px-4 py-2 border-b-2 border-babypink-500 text-babypink-500">Semua</button>
          <button id="tab-pijat" class="px-4 py-2 border-b-2 border-transparent text-gray-500">Pijat</button>
          <button id="tab-air" class="px-4 py-2 border-b-2 border-transparent text-gray-500">Sesi Air</button>
          <button id="tab-paket" class="px-4 py-2 border-b-2 border-transparent text-gray-500">Paket</button>
        </div>
      </div>
      
      <!-- Services Grid - All Tab (Default View) -->
      <div id="all-tab-content" class="block">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Service Card 1 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="relative">
              <img src="https://placehold.co/600x400" alt="Pijat Bayi" class="h-48 w-full object-cover">
              <span class="absolute top-2 right-2 px-2 py-1 bg-babypink-500 text-white text-xs rounded-full">
                Populer
              </span>
            </div>
            <div class="p-6">
              <div class="mb-2 flex justify-between items-start">
                <h3 class="text-lg font-semibold">Pijat Bayi</h3>
                <p class="font-semibold text-babypink-600">Rp 250.000</p>
              </div>
              
              <div class="flex gap-4 text-sm text-gray-500 mb-4">
                <div class="flex-1">
                  <p>Durasi: 45 menit</p>
                </div>
                <div class="flex-1">
                  <p>Usia: 0-12 bulan</p>
                </div>
              </div>
              
              <p class="text-sm text-gray-600 mb-4">
                Teknik pijat lembut untuk meningkatkan ikatan dan relaksasi. Membantu bayi tidur lebih nyenyak dan mengurangi rasa tidak nyaman.
              </p>
              
              <div class="mb-4">
                <h4 class="text-sm font-semibold mb-2">Manfaat:</h4>
                <ul class="text-sm text-gray-600 list-disc list-inside">
                  <li>Meningkatkan kualitas tidur</li>
                  <li>Memperkuat ikatan orang tua-anak</li>
                  <li>Membantu perkembangan saraf</li>
                </ul>
              </div>
              
              <div class="flex gap-2">
                <button class="flex-1 py-2 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md flex items-center justify-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><line x1="9" y1="16" x2="15" y2="16"/><line x1="12" y1="13" x2="12" y2="19"/></svg>
                  <span>Reservasi</span>
                </button>
                <button class="flex-1 py-2 border border-gray-300 rounded-md">
                  Detail
                </button>
              </div>
            </div>
          </div>
          
          <!-- Service Card 2 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="relative">
              <img src="https://placehold.co/600x400" alt="Hidroterapi" class="h-48 w-full object-cover">
              <span class="absolute top-2 right-2 px-2 py-1 bg-babypink-500 text-white text-xs rounded-full">
                Terlaris
              </span>
            </div>
            <div class="p-6">
              <div class="mb-2 flex justify-between items-start">
                <h3 class="text-lg font-semibold">Hidroterapi</h3>
                <p class="font-semibold text-babypink-600">Rp 350.000</p>
              </div>
              
              <div class="flex gap-4 text-sm text-gray-500 mb-4">
                <div class="flex-1">
                  <p>Durasi: 30 menit</p>
                </div>
                <div class="flex-1">
                  <p>Usia: 1-24 bulan</p>
                </div>
              </div>
              
              <p class="text-sm text-gray-600 mb-4">
                Sesi air hangat untuk meningkatkan kualitas tidur dan mengurangi stres. Bayi Anda akan menikmati sensasi mengambang dan bermain di air.
              </p>
              
              <div class="mb-4">
                <h4 class="text-sm font-semibold mb-2">Manfaat:</h4>
                <ul class="text-sm text-gray-600 list-disc list-inside">
                  <li>Memperkuat otot</li>
                  <li>Meningkatkan koordinasi</li>
                  <li>Merangsang perkembangan otak</li>
                </ul>
              </div>
              
              <div class="flex gap-2">
                <button class="flex-1 py-2 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md flex items-center justify-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><line x1="9" y1="16" x2="15" y2="16"/><line x1="12" y1="13" x2="12" y2="19"/></svg>
                  <span>Reservasi</span>
                </button>
                <button class="flex-1 py-2 border border-gray-300 rounded-md">
                  Detail
                </button>
              </div>
            </div>
          </div>
          
          <!-- Service Card 3 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="relative">
              <img src="https://placehold.co/600x400" alt="Sesi Mengambang" class="h-48 w-full object-cover">
            </div>
            <div class="p-6">
              <div class="mb-2 flex justify-between items-start">
                <h3 class="text-lg font-semibold">Sesi Mengambang</h3>
                <p class="font-semibold text-babypink-600">Rp 300.000</p>
              </div>
              
              <div class="flex gap-4 text-sm text-gray-500 mb-4">
                <div class="flex-1">
                  <p>Durasi: 20 menit</p>
                </div>
                <div class="flex-1">
                  <p>Usia: 3-18 bulan</p>
                </div>
              </div>
              
              <p class="text-sm text-gray-600 mb-4">
                Pengalaman mengambang yang aman untuk meningkatkan perkembangan sensorik. Dilakukan di kolam khusus dengan suhu air yang diatur.
              </p>
              
              <div class="mb-4">
                <h4 class="text-sm font-semibold mb-2">Manfaat:</h4>
                <ul class="text-sm text-gray-600 list-disc list-inside">
                  <li>Meningkatkan keseimbangan</li>
                  <li>Memberikan stimulasi sensorik</li>
                  <li>Meningkatkan kekuatan leher</li>
                </ul>
              </div>
              
              <div class="flex gap-2">
                <button class="flex-1 py-2 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md flex items-center justify-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><line x1="9" y1="16" x2="15" y2="16"/><line x1="12" y1="13" x2="12" y2="19"/></svg>
                  <span>Reservasi</span>
                </button>
                <button class="flex-1 py-2 border border-gray-300 rounded-md">
                  Detail
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Category tabs content (These will be displayed via JS) -->
      <div id="pijat-tab-content" class="hidden">
        <!-- Will contain only pijat services -->
      </div>

      <div id="air-tab-content" class="hidden">
        <!-- Will contain only air services -->
      </div>

      <div id="paket-tab-content" class="hidden">
        <!-- Will contain only paket services -->
      </div>
  

  <script>
    // Sidebar Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarTrigger = document.getElementById('sidebarTrigger');
      const closeSidebar = document.getElementById('closeSidebar');
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');
      
      function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      }
      
      function closeSidebarFunc() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      }
      
      sidebarTrigger.addEventListener('click', openSidebar);
      closeSidebar.addEventListener('click', closeSidebarFunc);
      overlay.addEventListener('click', closeSidebarFunc);
      
      // Tabs functionality
      const tabAll = document.getElementById('tab-all');
      const tabPijat = document.getElementById('tab-pijat');
      const tabAir = document.getElementById('tab-air');
      const tabPaket = document.getElementById('tab-paket');
      
      const allContent = document.getElementById('all-tab-content');
      const pijatContent = document.getElementById('pijat-tab-content');
      const airContent = document.getElementById('air-tab-content');
      const paketContent = document.getElementById('paket-tab-content');
      
      function resetTabs() {
        [tabAll, tabPijat, tabAir, tabPaket].forEach(tab => {
          tab.classList.add('border-transparent', 'text-gray-500');
          tab.classList.remove('border-babypink-500', 'text-babypink-500');
        });
        
        [allContent, pijatContent, airContent, paketContent].forEach(content => {
          content.classList.add('hidden');
          content.classList.remove('block');
        });
      }
      
      tabAll.addEventListener('click', function() {
        resetTabs();
        tabAll.classList.add('border-babypink-500', 'text-babypink-500');
        tabAll.classList.remove('border-transparent', 'text-gray-500');
        allContent.classList.add('block');
        allContent.classList.remove('hidden');
      });
      
      tabPijat.addEventListener('click', function() {
        resetTabs();
        tabPijat.classList.add('border-babypink-500', 'text-babypink-500');
        tabPijat.classList.remove('border-transparent', 'text-gray-500');
        pijatContent.classList.add('block');
        pijatContent.classList.remove('hidden');
      });
      
      tabAir.addEventListener('click', function() {
        resetTabs();
        tabAir.classList.add('border-babypink-500', 'text-babypink-500');
        tabAir.classList.remove('border-transparent', 'text-gray-500');
        airContent.classList.add('block');
        airContent.classList.remove('hidden');
      });
      
      tabPaket.addEventListener('click', function() {
        resetTabs();
        tabPaket.classList.add('border-babypink-500', 'text-babypink-500');
        tabPaket.classList.remove('border-transparent', 'text-gray-500');
        paketContent.classList.add('block');
        paketContent.classList.remove('hidden');
      });
    });
  </script>
</x-user-dashboard>