@props(['username' => 'Akun Saya'])

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <button 
        @click="open = !open"
        {{ $attributes->merge(['class' => 'bg-white inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-gray-200 hover:border-gray-300 hover:bg-gray-50 h-10 w-10 relative']) }}
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user">
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
    </button>
    <div 
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 mt-2 z-50 min-w-[8rem] overflow-hidden rounded-md border bg-white p-1 text-gray-700 shadow-lg"
    >
        <div class="py-1 px-4 border-b">
            <p class="text-sm font-medium">{{ $username }}</p>
        </div>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil</a>
        <a href="settings.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pengaturan</a>
        <div class="border-t"></div>
        <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Keluar</a>
    </div>
</div> 