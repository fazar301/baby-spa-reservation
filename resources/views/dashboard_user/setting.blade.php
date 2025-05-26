<x-user-dashboard>
    
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold md:mt-0">Pengaturan</h1>
    <div class="flex items-center gap-4">
      <x-notification-button :count="3" />
      <x-profile-dropdown username="Akun Saya" x-cloak />
    </div>
  </div>

  @if (session('status'))
    <div class="mb-4 p-4 rounded-md {{ session('status') === 'profile-updated' ? 'bg-green-100 text-green-700' : (session('status') === 'password-updated' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
      @if(session('status') === 'profile-updated')
        Profil berhasil diperbarui.
      @elseif(session('status') === 'password-updated')
        Kata sandi berhasil diperbarui.
      @else
        {{ session('status') }}
      @endif
    </div>
  @endif

  @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Tab Content -->
  <div x-data="{ activeTab: 'account' }">
    <!-- Account Tab -->
    <div x-show="activeTab === 'account'">
      <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6 border-b">
          <h2 class="text-lg font-semibold">Informasi Akun</h2>
          <p class="text-sm text-gray-500">Perbarui informasi akun dan alamat email Anda.</p>
        </div>
        <form method="POST" action="{{ route('profile.update') }}" class="p-6 space-y-6 pt-0">
          @csrf
          @method('patch')
          <div class="space-y-2">
            <label for="email" class="block text-sm font-medium">Alamat Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-md">
            @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <div class="space-y-2">
            <label for="name" class="block text-sm font-medium">Nama Pengguna</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-md">
            @error('name')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <button type="submit" class="py-2 px-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
      
      <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b">
          <h2 class="text-lg font-semibold">Ubah Kata Sandi</h2>
          <p class="text-sm text-gray-500">Pastikan kata sandi Anda cukup kuat dan tidak digunakan di tempat lain.</p>
        </div>
        <form method="POST" action="{{ route('password.update') }}" class="p-6 space-y-6 pt-0">
          @csrf
          @method('put')
          <div class="space-y-2">
            <label for="current_password" class="block text-sm font-medium">Kata Sandi Saat Ini</label>
            <input id="current_password" name="current_password" type="password" class="w-full px-3 py-2 border {{ $errors->updatePassword->has('current_password') ? 'border-red-500' : 'border-gray-300' }} rounded-md">
            @error('current_password', 'updatePassword')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <div class="space-y-2">
            <label for="password" class="block text-sm font-medium">Kata Sandi Baru</label>
            <input id="password" name="password" type="password" class="w-full px-3 py-2 border {{ $errors->updatePassword->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-md">
            @error('password', 'updatePassword')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          
          <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-3 py-2 border {{ $errors->updatePassword->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }} rounded-md">
            @error('password_confirmation', 'updatePassword')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <button type="submit" class="py-2 px-4 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
              Ubah Kata Sandi
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- AlpineJS for tabs -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    [x-cloak] { display: none !important; }
  </style>
</x-user-dashboard>