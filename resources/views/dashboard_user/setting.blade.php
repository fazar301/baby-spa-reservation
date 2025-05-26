<x-user-dashboard>
    <div class="flex-1 p-4 md:p-6 ml-0 md:ml-64 pt-16 md:pt-6">
        <h1 class="text-2xl font-bold mb-6 mt-8 md:mt-0">Pengaturan</h1>
        
        <!-- Tabs -->
        <div class="border-b mb-6" x-data="{ activeTab: 'account' }">
          <div class="flex flex-wrap">
            <button @click="activeTab = 'account'" :class="activeTab === 'account' ? 'border-b-2 border-babypink-500 text-babypink-600' : 'border-b-2 border-transparent'" class="px-4 py-2 font-medium">Akun</button>
            <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'border-b-2 border-babypink-500 text-babypink-600' : 'border-b-2 border-transparent'" class="px-4 py-2 font-medium">Profil</button>
            <button @click="activeTab = 'notifications'" :class="activeTab === 'notifications' ? 'border-b-2 border-babypink-500 text-babypink-600' : 'border-b-2 border-transparent'" class="px-4 py-2 font-medium">Notifikasi</button>
            <button @click="activeTab = 'privacy'" :class="activeTab === 'privacy' ? 'border-b-2 border-babypink-500 text-babypink-600' : 'border-b-2 border-transparent'" class="px-4 py-2 font-medium">Privasi</button>
          </div>
        </div>
        
        <!-- Tab Content -->
        <div x-data="{ activeTab: 'account' }">
          <!-- Account Tab -->
          <div x-show="activeTab === 'account'">
            <div class="bg-white rounded-xl shadow-sm mb-6">
              <div class="p-6 border-b">
                <h2 class="text-lg font-semibold">Informasi Akun</h2>
                <p class="text-sm text-gray-500">Perbarui informasi akun dan alamat email Anda.</p>
              </div>
              <div class="p-6 space-y-6">
                <div class="space-y-2">
                  <label for="email" class="block text-sm font-medium">Alamat Email</label>
                  <input id="email" type="email" value="johndoe@example.com" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <div class="space-y-2">
                  <label for="username" class="block text-sm font-medium">Nama Pengguna</label>
                  <input id="username" value="johndoe123" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
              </div>
              <div class="p-6 border-t bg-gray-50">
                <button class="py-2 px-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
                  Simpan Perubahan
                </button>
              </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm">
              <div class="p-6 border-b">
                <h2 class="text-lg font-semibold">Ubah Kata Sandi</h2>
                <p class="text-sm text-gray-500">Pastikan kata sandi Anda cukup kuat dan tidak digunakan di tempat lain.</p>
              </div>
              <div class="p-6 space-y-6">
                <div class="space-y-2">
                  <label for="current_password" class="block text-sm font-medium">Kata Sandi Saat Ini</label>
                  <input id="current_password" type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <div class="space-y-2">
                  <label for="new_password" class="block text-sm font-medium">Kata Sandi Baru</label>
                  <input id="new_password" type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <div class="space-y-2">
                  <label for="confirm_password" class="block text-sm font-medium">Konfirmasi Kata Sandi</label>
                  <input id="confirm_password" type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
              </div>
              <div class="p-6 border-t bg-gray-50">
                <button class="py-2 px-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
                  Ubah Kata Sandi
                </button>
              </div>
            </div>
          </div>
          
          <!-- Profile Tab -->
          <div x-show="activeTab === 'profile'" class="hidden">
            <div class="bg-white rounded-xl shadow-sm">
              <div class="p-6 border-b">
                <h2 class="text-lg font-semibold">Informasi Profil</h2>
                <p class="text-sm text-gray-500">Perbarui informasi pribadi Anda.</p>
              </div>
              <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="space-y-2">
                    <label for="first_name" class="block text-sm font-medium">Nama Depan</label>
                    <input id="first_name" value="John" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                  </div>
                  
                  <div class="space-y-2">
                    <label for="last_name" class="block text-sm font-medium">Nama Belakang</label>
                    <input id="last_name" value="Doe" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                  </div>
                </div>
                
                <div class="space-y-2">
                  <label for="phone" class="block text-sm font-medium">Nomor Telepon</label>
                  <input id="phone" type="tel" value="+62123456789" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <div class="space-y-2">
                  <label for="address" class="block text-sm font-medium">Alamat</label>
                  <input id="address" value="Jl. Contoh No. 123" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div class="space-y-2">
                    <label for="city" class="block text-sm font-medium">Kota</label>
                    <input id="city" value="Jakarta" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                  </div>
                  
                  <div class="space-y-2">
                    <label for="province" class="block text-sm font-medium">Provinsi</label>
                    <input id="province" value="DKI Jakarta" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                  </div>
                  
                  <div class="space-y-2">
                    <label for="postal_code" class="block text-sm font-medium">Kode Pos</label>
                    <input id="postal_code" value="12345" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                  </div>
                </div>
              </div>
              <div class="p-6 border-t bg-gray-50">
                <button class="py-2 px-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
                  Simpan Perubahan
                </button>
              </div>
            </div>
          </div>
          
          <!-- Notifications Tab -->
          <div x-show="activeTab === 'notifications'" class="hidden">
            <div class="bg-white rounded-xl shadow-sm">
              <div class="p-6 border-b">
                <h2 class="text-lg font-semibold">Preferensi Notifikasi</h2>
                <p class="text-sm text-gray-500">Kelola bagaimana Anda ingin dihubungi.</p>
              </div>
              <div class="p-6 space-y-6">
                <div>
                  <h3 class="text-sm font-medium mb-3">Notifikasi Email</h3>
                  <div class="space-y-3">
                    <div class="flex items-center justify-between border-b pb-3">
                      <div class="space-y-0.5">
                        <label for="email_reservations" class="block text-sm font-medium">Reservasi</label>
                        <p class="text-sm text-gray-500">Dapatkan email tentang reservasi Anda</p>
                      </div>
                      <div class="relative inline-flex h-6 w-11">
                        <input type="checkbox" id="email_reservations" class="peer sr-only" checked>
                        <span class="inline-block h-6 w-11 rounded-full bg-gray-300 peer-checked:bg-babypink-500"></span>
                        <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:left-6"></span>
                      </div>
                    </div>
                    
                    <div class="flex items-center justify-between border-b pb-3">
                      <div class="space-y-0.5">
                        <label for="email_reminders" class="block text-sm font-medium">Pengingat</label>
                        <p class="text-sm text-gray-500">Dapatkan pengingat sebelum jadwal Anda</p>
                      </div>
                      <div class="relative inline-flex h-6 w-11">
                        <input type="checkbox" id="email_reminders" class="peer sr-only" checked>
                        <span class="inline-block h-6 w-11 rounded-full bg-gray-300 peer-checked:bg-babypink-500"></span>
                        <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:left-6"></span>
                      </div>
                    </div>
                    
                    <div class="flex items-center justify-between pb-3">
                      <div class="space-y-0.5">
                        <label for="email_promotions" class="block text-sm font-medium">Promosi</label>
                        <p class="text-sm text-gray-500">Dapatkan info tentang promosi dan diskon</p>
                      </div>
                      <div class="relative inline-flex h-6 w-11">
                        <input type="checkbox" id="email_promotions" class="peer sr-only">
                        <span class="inline-block h-6 w-11 rounded-full bg-gray-300 peer-checked:bg-babypink-500"></span>
                        <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:left-6"></span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="border-t pt-6">
                  <h3 class="text-sm font-medium mb-3">Notifikasi SMS</h3>
                  <div class="space-y-3">
                    <div class="flex items-center justify-between border-b pb-3">
                      <div class="space-y-0.5">
                        <label for="sms_reservations" class="block text-sm font-medium">Reservasi</label>
                        <p class="text-sm text-gray-500">Dapatkan SMS tentang reservasi Anda</p>
                      </div>
                      <div class="relative inline-flex h-6 w-11">
                        <input type="checkbox" id="sms_reservations" class="peer sr-only" checked>
                        <span class="inline-block h-6 w-11 rounded-full bg-gray-300 peer-checked:bg-babypink-500"></span>
                        <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:left-6"></span>
                      </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                      <div class="space-y-0.5">
                        <label for="sms_reminders" class="block text-sm font-medium">Pengingat</label>
                        <p class="text-sm text-gray-500">Dapatkan pengingat sebelum jadwal Anda</p>
                      </div>
                      <div class="relative inline-flex h-6 w-11">
                        <input type="checkbox" id="sms_reminders" class="peer sr-only" checked>
                        <span class="inline-block h-6 w-11 rounded-full bg-gray-300 peer-checked:bg-babypink-500"></span>
                        <span class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:left-6"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="p-6 border-t bg-gray-50">
                <button class="py-2 px-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
                  Simpan Preferensi
                </button>
              </div>
            </div>
          </div>
          
          <!-- Privacy Tab -->
          <div x-show="activeTab === 'privacy'" class="hidden">
            <div class="bg-white rounded-xl shadow-sm">
              <div class="p-6 border-b">
                <h2 class="text-lg font-semibold">Pengaturan Privasi</h2>
                <p class="text-sm text-gray-500">Kelola preferensi privasi Anda.</p>
              </div>
              <div class="p-6 space-y-6">
                <div class="space-y-3">
                  <div class="flex items-start space-x-2">
                    <input type="checkbox" id="privacy_policy" class="mt-0.5" checked>
                    <div class="space-y-1 leading-none">
                      <label for="privacy_policy" class="text-sm font-medium">
                        Saya telah membaca dan menyetujui Kebijakan Privasi
                      </label>
                      <p class="text-sm text-gray-500">
                        Anda harus menyetujui Kebijakan Privasi kami untuk menggunakan layanan.
                      </p>
                    </div>
                  </div>
                  
                  <div class="flex items-start space-x-2">
                    <input type="checkbox" id="data_sharing" class="mt-0.5">
                    <div class="space-y-1 leading-none">
                      <label for="data_sharing" class="text-sm font-medium">
                        Izinkan berbagi data dengan mitra
                      </label>
                      <p class="text-sm text-gray-500">
                        Kami mungkin membagikan data Anda dengan mitra terpercaya untuk meningkatkan pengalaman Anda.
                      </p>
                    </div>
                  </div>
                  
                  <div class="flex items-start space-x-2">
                    <input type="checkbox" id="marketing_consent" class="mt-0.5" checked>
                    <div class="space-y-1 leading-none">
                      <label for="marketing_consent" class="text-sm font-medium">
                        Terima materi pemasaran
                      </label>
                      <p class="text-sm text-gray-500">
                        Kami akan mengirimkan penawaran dan pembaruan yang relevan dengan layanan kami.
                      </p>
                    </div>
                  </div>
                </div>
                
                <div class="space-y-2 border-t pt-6">
                  <label for="data_retention" class="block text-sm font-medium">Retensi Data</label>
                  <select id="data_retention" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="6_months">6 bulan</option>
                    <option value="1_year" selected>1 tahun</option>
                    <option value="2_years">2 tahun</option>
                    <option value="indefinite">Tanpa batas waktu</option>
                  </select>
                  <p class="text-sm text-gray-500">
                    Pilih berapa lama kami menyimpan data Anda setelah masa tidak aktif.
                  </p>
                </div>
                
                <div class="border-t pt-6">
                  <button class="py-2 px-4 bg-red-600 hover:bg-red-700 text-white rounded-md">
                    Hapus Akun Saya
                  </button>
                  <p class="text-sm text-gray-500 mt-2">
                    Menghapus akun Anda akan menghapus semua data dan tidak dapat dikembalikan.
                  </p>
                </div>
              </div>
              <div class="p-6 border-t bg-gray-50">
                <button class="py-2 px-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
                  Simpan Pengaturan
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      // Sidebar Toggle Functionality
      
    </script>
    
    <!-- AlpineJS for tabs -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-user-dashboard>