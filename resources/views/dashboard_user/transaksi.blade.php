<x-user-dashboard>
    <h1 class="text-2xl font-bold mb-6 mt-8 md:mt-0">Transaksi</h1>
      
      <!-- Summary Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg p-4 shadow-sm">
          <p class="text-sm font-medium text-gray-500">Bulan Ini</p>
          <p class="text-2xl font-bold mt-1">Rp 950.000</p>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white rounded-lg p-4 shadow-sm">
          <p class="text-sm font-medium text-gray-500">Bulan Lalu</p>
          <p class="text-2xl font-bold mt-1">Rp 1.350.000</p>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-white rounded-lg p-4 shadow-sm">
          <p class="text-sm font-medium text-gray-500">Total Pengeluaran</p>
          <p class="text-2xl font-bold mt-1">Rp 2.300.000</p>
        </div>
      </div>
      
      <!-- Last Payment -->
      <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="p-4 border-b">
          <h2 class="text-lg font-semibold">Pembayaran Terakhir</h2>
          <p class="text-sm text-gray-500">Detail pembayaran terbaru Anda</p>
        </div>
        
        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <p class="text-sm font-medium text-gray-500">Tanggal Pembayaran</p>
            <p class="font-medium">20 April 2025</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Metode Pembayaran</p>
            <p class="font-medium">Kartu Kredit</p>
          </div>
        </div>
        
        <div class="p-4 border-t flex justify-end">
          <button class="flex items-center gap-2 px-4 py-2 rounded-md border border-gray-300 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
            <span>Unduh Invoice</span>
          </button>
        </div>
      </div>
      
      <!-- Transaction History -->
      <div class="bg-white rounded-lg shadow-sm">
        <div class="p-4 border-b">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
              <h2 class="text-lg font-semibold">Riwayat Transaksi</h2>
              <p class="text-sm text-gray-500">Daftar semua transaksi pembayaran</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 text-gray-500"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" placeholder="Cari transaksi..." class="pl-8 pr-4 py-2 w-full sm:w-64 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-babypink-500 focus:border-transparent">
              </div>
              
              <select class="px-4 py-2 w-full sm:w-[130px] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-babypink-500 focus:border-transparent">
                <option value="all">Semua</option>
                <option value="paid">Lunas</option>
                <option value="canceled">Dibatalkan</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="p-4 overflow-x-auto">
          <table class="w-full min-w-[640px]">
            <thead>
              <tr class="border-b">
                <th class="text-left p-2 font-medium">ID Transaksi</th>
                <th class="text-left p-2 font-medium">
                  <div class="flex items-center gap-1">
                    Tanggal
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="7 17 17 17 17 7"/><polyline points="7 7 17 7"/></svg>
                  </div>
                </th>
                <th class="text-left p-2 font-medium">Layanan</th>
                <th class="text-left p-2 font-medium">Jumlah</th>
                <th class="text-left p-2 font-medium">Status</th>
                <th class="text-left p-2 font-medium">Metode</th>
                <th class="text-right p-2 font-medium">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- Transaction Row 1 -->
              <tr class="border-b">
                <td class="p-2 font-medium">TRX-001</td>
                <td class="p-2">20 April 2025</td>
                <td class="p-2">Pijat Bayi</td>
                <td class="p-2">Rp 250.000</td>
                <td class="p-2">
                  <span class="px-2 py-1 text-xs bg-green-50 text-green-600 border border-green-200 rounded-full">
                    Lunas
                  </span>
                </td>
                <td class="p-2">Kartu Kredit</td>
                <td class="p-2 text-right">
                  <div class="relative inline-block text-left" id="dropdown1">
                    <button class="px-2 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded transition-colors dropdown-trigger">
                      ...
                    </button>
                    <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden dropdown-content z-10">
                      <div class="py-1">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                          <span>Unduh Invoice</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                          <span>Detail Pembayaran</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                          <span>Lihat Reservasi</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              
              <!-- Transaction Row 2 -->
              <tr class="border-b">
                <td class="p-2 font-medium">TRX-002</td>
                <td class="p-2">15 April 2025</td>
                <td class="p-2">Hidroterapi</td>
                <td class="p-2">Rp 350.000</td>
                <td class="p-2">
                  <span class="px-2 py-1 text-xs bg-green-50 text-green-600 border border-green-200 rounded-full">
                    Lunas
                  </span>
                </td>
                <td class="p-2">Transfer Bank</td>
                <td class="p-2 text-right">
                  <div class="relative inline-block text-left" id="dropdown2">
                    <button class="px-2 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded transition-colors dropdown-trigger">
                      ...
                    </button>
                    <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden dropdown-content z-10">
                      <div class="py-1">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                          <span>Unduh Invoice</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                          <span>Detail Pembayaran</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                          <span>Lihat Reservasi</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              
              <!-- Transaction Row 3 -->
              <tr>
                <td class="p-2 font-medium">TRX-007</td>
                <td class="p-2">20 Maret 2025</td>
                <td class="p-2">Pijat Bayi</td>
                <td class="p-2">Rp 250.000</td>
                <td class="p-2">
                  <span class="px-2 py-1 text-xs bg-red-50 text-red-600 border border-red-200 rounded-full">
                    Dibatalkan
                  </span>
                </td>
                <td class="p-2">Kartu Kredit</td>
                <td class="p-2 text-right">
                  <div class="relative inline-block text-left" id="dropdown3">
                    <button class="px-2 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded transition-colors dropdown-trigger">
                      ...
                    </button>
                    <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden dropdown-content z-10">
                      <div class="py-1">
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                          <span>Lihat Reservasi</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</x-user-dashboard>