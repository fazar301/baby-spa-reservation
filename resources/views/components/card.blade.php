@props([
    'image' => 'https://placehold.co/600x400',
    'title' => 'Pijat Bayi',
    'price' => '250.000',
    'kategori' => 'Baby',
    'description' => 'Teknik pijat lembut untuk meningkatkan ikatan dan relaksasi. Membantu bayi tidur lebih nyenyak dan mengurangi rasa tidak nyaman.',
    'benefits' => [],
    'includedLayanan' => [],
    'reservationUrl' => '/appointment',
    'showBadge' => true,
    'badgeText' => 'Populer'
])

@php
    $ageRange = match($kategori) {
        'Baby' => '0-12 bulan',
        'Kids' => '1-3 tahun',
        'Children' => 'Di atas 3 tahun',
        default => '0-12 bulan'
    };
    
    // Ensure benefits is an array
    $benefits = is_array($benefits) ? $benefits : [];
@endphp

<div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden flex flex-col h-full">
    <div class="relative">
        <img class="w-full h-48 object-cover" src="{{ $image }}" alt="{{ $title }}" />
        @if($showBadge)
        <span class="absolute top-3 right-3 bg-pink-500 text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $badgeText }}</span>
        @endif
    </div>
    <div class="p-5 flex flex-col flex-grow">
        <div class="flex justify-between items-center mb-2">
            <h5 class="text-xl font-bold tracking-tight text-gray-900">{{ $title }}</h5>
            <span class="text-pink-600 font-bold">Rp {{ $price }}</span>
        </div>
        <p class="text-sm text-gray-500 mb-2">Usia: {{ $ageRange }}</p>
        <div class="flex-grow">
            <p class="mb-4 text-gray-700">
                {{ $description }}
            </p>
            @if(count($benefits) > 0)
            <div class="mb-4">
                <p class="font-medium text-gray-800 mb-2">Manfaat:</p>
                <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                    @foreach($benefits as $benefit)
                    <li>{{ is_array($benefit) && isset($benefit['value']) ? $benefit['value'] : (is_object($benefit) && isset($benefit->value) ? $benefit->value : $benefit) }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(count($includedLayanan) > 0)
            <div class="mb-4">
                <p class="font-medium text-gray-800 mb-2">Layanan yang termasuk:</p>
                <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                    @foreach($includedLayanan as $layanan)
                    <li>{{ $layanan->nama_layanan }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="mt-auto pt-4">
            <a href="{{ $reservationUrl }}" class="w-full inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Reservasi
            </a>
        </div>
    </div>
</div>