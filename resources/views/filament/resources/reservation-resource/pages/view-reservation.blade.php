<div class="space-y-6">
    <div class="p-4 bg-white rounded-lg shadow">
        <h3 class="text-lg font-medium text-gray-900">Detail Bayi</h3>
        <dl class="mt-4 space-y-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama Bayi</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $reservation->bayi->nama }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $reservation->bayi->tanggal_lahir->format('d M Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $reservation->bayi->jenis_kelamin }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Berat Lahir</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $reservation->bayi->berat_lahir }} kg</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Berat Sekarang</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $reservation->bayi->berat_sekarang }} kg</dd>
            </div>
        </dl>
    </div>

    <div class="p-4 bg-white rounded-lg shadow">
        <h3 class="text-lg font-medium text-gray-900">Detail Layanan</h3>
        <dl class="mt-4 space-y-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama Layanan</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $reservation->layanan->nama_layanan }}</dd>
            </div>
        </dl>
    </div>
</div> 