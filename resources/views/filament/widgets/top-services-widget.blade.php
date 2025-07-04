<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Top 3 Layanan Bulan Ini</h2>
        <ul>
            @forelse($topServices as $service)
                <li>
                    {{ $service->layanan->nama_layanan ?? '-' }}: <b>{{ $service->total }}</b> reservasi
                </li>
            @empty
                <li>Tidak ada data layanan bulan ini.</li>
            @endforelse
        </ul>
    </x-filament::card>
</x-filament::widget> 