<x-user-dashboard>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
    .dropdown-content {
      opacity: 0;
      visibility: hidden;
      transform: scale(0.95);
      transition: opacity 0.1s ease, transform 0.1s ease, visibility 0.1s;
    }
    .dropdown-content.show {
      opacity: 1;
      visibility: visible;
      transform: scale(1);
    }
    .animate-fade-in {
      animation: fadeIn 0.2s ease-out;
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95) translateY(-10px);
      }
      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }
  </style>


    

    
      <!-- Dashboard Header with Profile and Notification Buttons -->
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold md:mt-0">Transaksi</h1>
        <div class="flex items-center gap-4">
          <x-notification-button :count="3" />
          <x-profile-dropdown username="Akun Saya" />
        </div>
      </div>
      
      <!-- Summary Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-sm p-6">
          <p class="text-sm font-medium text-gray-500">Bulan Ini</p>
          <p class="text-2xl font-bold mt-1">Rp {{ number_format($thisMonthSpending, 0, ',', '.') }}</p>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-sm p-6">
          <p class="text-sm font-medium text-gray-500">Bulan Lalu</p>
          <p class="text-2xl font-bold mt-1">Rp {{ number_format($lastMonthSpending, 0, ',', '.') }}</p>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-sm p-6">
          <p class="text-sm font-medium text-gray-500">Total Pengeluaran</p>
          <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalSpending, 0, ',', '.') }}</p>
        </div>
      </div>
      
      <!-- Last Payment -->
      <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="p-6 border-b">
          <h2 class="text-lg font-semibold">Pembayaran Terakhir</h2>
          <p class="text-sm text-gray-500">Detail pembayaran terbaru Anda</p>
        </div>
        
        @if($lastTransaction)
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <p class="text-sm font-medium text-gray-500">Tanggal Pembayaran</p>
            <p class="font-medium">{{ \Carbon\Carbon::parse($lastTransaction->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</p>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-500">Metode Pembayaran</p>
            <p class="font-medium">{{ strtoupper($lastTransaction->metode) }}</p>
          </div>
        </div>
        
        <div class="p-6 border-t flex justify-end">
          <a href="{{ route('reservasi.invoice', $lastTransaction->reservasi->id) }}" class="flex items-center gap-2 px-4 py-2 rounded-md border border-gray-300 text-sm hover:bg-gray-50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
            <span>Unduh Invoice</span>
          </a>
        </div>
        @else
        <div class="p-6 text-center text-gray-500">
            Tidak ada transaksi terakhir.
        </div>
        @endif
      </div>
      
      <!-- Transaction History -->
      <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6 border-b">
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
              
              <select id="filterSelect" class="px-4 py-2 w-full sm:w-[130px] rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-babypink-500 focus:border-transparent">
                <option value="all">Semua</option>
                <option value="paid">Lunas</option>
                <option value="canceled">Dibatalkan</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="ps-8 overflow-x-auto w-full max-w-[100vw] -mx-4 overflow-y-hidden">
          <table class="w-full min-w-[640px] text-sm">
            <thead>
              <tr class="border-b">
                <th class="text-left p-4 font-medium text-gray-500">Kode Reservasi</th>
                <th class="text-left p-4 font-medium text-gray-500">
                  <div class="flex items-center gap-1 cursor-pointer" id="sortByDate">
                    Tanggal
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down-up"><path d="m3 16 4 4 4-4"/><path d="M7 20V4"/><path d="m21 8-4-4-4 4"/><path d="M17 4v16"/></svg>
                  </div>
                </th>
                <th class="text-left p-4 font-medium text-gray-500">Layanan</th>
                <th class="text-left p-4 font-medium text-gray-500">Jumlah</th>
                <th class="text-left p-4 font-medium text-gray-500">Status</th>
                <th class="text-left p-4 font-medium text-gray-500">Metode</th>
                <th class="text-right p-4 font-medium text-gray-500">Aksi</th>
              </tr>
            </thead>
            <tbody id="transactionTableBody">
              <!-- Table rows will be dynamically populated -->
            </tbody>
          </table>
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
    
  

  <script>
    // Sidebar Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {

      // Transaction data
      const transactions = @json($transactions)

      // Pagination state
      let currentPage = 1;
      const itemsPerPage = 5;
      let filteredTransactions = [...transactions];
      
      // Function to render table rows
      function renderTableRows(items) {
        const tableBody = document.getElementById('transactionTableBody');
        tableBody.innerHTML = '';
        
        items.forEach((transaction,i) => {
          const row = document.createElement('tr');
          row.className = 'border-b hover:bg-gray-50 transition-colors';
          row.setAttribute('data-status', transaction.status);
          
          let statusClass = 'bg-red-50 text-red-600 border-red-200'; // Default for failed/cancelled/no_transaction
          if (transaction.status === 'paid') {
              statusClass = 'bg-green-50 text-green-600 border-green-200';
          } else if (transaction.status === 'pending') {
              statusClass = 'bg-yellow-50 text-yellow-600 border-yellow-200';
          }
          
          row.innerHTML = `
            <td class="p-4 font-medium">${transaction.kode}</td>
            <td class="p-4">${transaction.date}</td>
            <td class="p-4">${transaction.service}</td>
            <td class="p-4">${transaction.amount}</td>
            <td class="p-4">
              <span class="px-2 py-1 text-xs ${statusClass} border rounded-full">
                ${transaction.statusText}
              </span>
            </td>
            <td class="p-4">${transaction.method}</td>
            <td class="p-4 text-right">
              <div class="inline-block text-left">
                <button class="px-2 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded transition-colors dropdown-trigger">
                  ...
                </button>
                <div class="origin-top-right absolute right-[20px] mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 dropdown-content z-10">
                  <div class="py-1">
                    ${transaction.status === 'paid' ? `
                      <a href="/reservations/`+ transaction.id +`/invoice" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        <span>Unduh Invoice</span>
                      </a>
                      <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                        <span>Detail Pembayaran</span>
                      </a>
                    ` : ''}
                    ${transaction.status === 'pending' ? `
                      <a href="/reservations/`+ transaction.id +`/payment" class="flex items-center px-4 py-2 text-sm text-blue-700 hover:bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4m0-4h.01"/></svg>
                        <span>Bayar Sekarang</span>
                      </a>
                    ` : ''}
                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                      <span>Lihat Reservasi</span>
                    </a>
                  </div>
                </div>
              </div>
            </td>
          `;
          
          tableBody.appendChild(row);
        });
        
        // Reinitialize dropdown triggers
        initializeDropdowns();
      }
      
      // Function to render pagination
      function renderPagination() {
        const totalPages = Math.ceil(filteredTransactions.length / itemsPerPage);
        const startIndex = (currentPage - 1) * itemsPerPage + 1;
        const endIndex = Math.min(currentPage * itemsPerPage, filteredTransactions.length);
        
        // Update pagination info
        document.getElementById('startIndex').textContent = startIndex;
        document.getElementById('endIndex').textContent = endIndex;
        document.getElementById('totalItems').textContent = filteredTransactions.length;
        
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
        renderTableRows(filteredTransactions.slice(start, end));
        renderPagination();
      }
      
      // Initialize pagination controls
      document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) goToPage(currentPage - 1);
      });
      
      document.getElementById('nextPage').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredTransactions.length / itemsPerPage);
        if (currentPage < totalPages) goToPage(currentPage + 1);
      });
      
      // Transaction filtering functionality
      const filterSelect = document.getElementById('filterSelect');
      
      filterSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        
        filteredTransactions = selectedValue === 'all'
          ? [...transactions]
          : transactions.filter(t => t.status === selectedValue);
        
        currentPage = 1;
        goToPage(1);
      });
      
      // Sorting functionality
      const sortByDate = document.getElementById('sortByDate');
      let ascending = true;
      
      sortByDate.addEventListener('click', function() {
        ascending = !ascending;
        
        filteredTransactions.sort((a, b) => {
          return ascending
            ? a.date.localeCompare(b.date)
            : b.date.localeCompare(a.date);
        });
        
        goToPage(currentPage);
      });
      
      // Initialize dropdowns
      function initializeDropdowns() {
        const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
        
        dropdownTriggers.forEach(trigger => {
          trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdownContent = this.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-content').forEach(content => {
              if (content !== dropdownContent && content !== dropdownContent) {
                content.classList.remove('show');
              }
            });
            
            dropdownContent.classList.toggle('show');
          });
        });
      }
      
      // Close dropdowns when clicking elsewhere
      document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-content').forEach(content => {
          content.classList.remove('show');
        });
      });
      
      // Initial render
      goToPage(1);
    });
  </script>
</x-user-dashboard>