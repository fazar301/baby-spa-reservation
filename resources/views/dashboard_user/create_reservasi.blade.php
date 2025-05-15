<x-user-dashboard>
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 mt-8 md:mt-0">Buat Reservasi Baru</h1>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('reservasi.store') }}" method="POST">
                @csrf
                
                <!-- Layanan Selection -->
                <div class="mb-6">
                    <label for="layanan_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Layanan</label>
                    <select name="layanan_id" id="layanan_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-babypink-500 focus:ring-babypink-500">
                        <option value="">Pilih layanan...</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                    @error('layanan_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sesi Selection -->
                <div class="mb-6">
                    <label for="sesi_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Jadwal</label>
                    <select name="sesi_id" id="sesi_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-babypink-500 focus:ring-babypink-500">
                        <option value="">Pilih jadwal...</option>
                        @foreach($sesis as $sesi)
                            <option value="{{ $sesi->id }}">{{ Str::substr($sesi->jam, 0, 5) }}</option>
                        @endforeach
                    </select>
                    @error('sesi_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div class="mb-6">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" id="catatan" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-babypink-500 focus:ring-babypink-500" placeholder="Tambahkan catatan khusus untuk terapis..."></textarea>
                    @error('catatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-babypink-500 hover:bg-babypink-600 text-white rounded-md">
                        Buat Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-user-dashboard> 