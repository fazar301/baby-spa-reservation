<header class="sticky top-0 z-40 border-b bg-white">
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-4">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="/" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-pink-400 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                <span class="self-center text-xl font-bold whitespace-nowrap">BabySpa</span>
            </a>
            <div class="flex items-center lg:order-2">
                <a href="/login" class="text-white bg-pink-500 hover:bg-pink-600 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">{{ Auth::check() ? 'Dashboard' : 'Masuk' }}</a>
                <button onclick="toggleMenu()" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:w-auto lg:order-1" id="desktop-menu">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="/#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Beranda</a>
                    </li>
                    <li>
                        <a href="/layanan" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Layanan</a>
                    </li>
                    <li>
                        <a href="/#benefits" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Manfaat</a>
                    </li>
                    <li>
                        <a href="/#testimonials" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Testimoni</a>
                    </li>
                    <li>
                        <a href="/#contact" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Kontak</a>
                    </li>
                </ul>
            </div>
            <div class="hidden w-full lg:hidden lg:w-auto lg:order-1" id="mobile-menu">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="/#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Beranda</a>
                    </li>
                    <li>
                        <a href="/layanan" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Layanan</a>
                    </li>
                    <li>
                        <a href="/#benefits" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Manfaat</a>
                    </li>
                    <li>
                        <a href="/#testimonials" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Testimoni</a>
                    </li>
                    <li>
                        <a href="/#contact" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-pink-500 lg:p-0 transition-colors duration-200">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
#mobile-menu {
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease-in-out;
    max-height: 0;
    overflow: hidden;
    visibility: hidden;
}

#mobile-menu.expanded {
    opacity: 1;
    transform: translateY(0);
    max-height: 500px;
    visibility: visible;
}

#mobile-menu.collapsed {
    opacity: 0;
    transform: translateY(-10px);
    max-height: 0;
    visibility: hidden;
}
</style>

<script>
let isExpanded = false;

function toggleMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu) {
        isExpanded = !isExpanded;
        
        if (isExpanded) {
            mobileMenu.classList.remove('hidden');
            // Force a reflow to ensure the animation starts from the beginning
            mobileMenu.offsetHeight;
            mobileMenu.classList.remove('collapsed');
            mobileMenu.classList.add('expanded');
        } else {
            mobileMenu.classList.remove('expanded');
            mobileMenu.classList.add('collapsed');
            // Wait for the animation to complete before hiding
            setTimeout(() => {
                if (!isExpanded) { // Check if still collapsed
                    mobileMenu.classList.add('hidden');
                }
            }, 300);
        }
    }
}

// Handle window resize
window.addEventListener('resize', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    const desktopMenu = document.getElementById('desktop-menu');
    
    if (window.innerWidth >= 1024) { // lg breakpoint
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('expanded', 'collapsed');
        desktopMenu.classList.remove('hidden');
    } else {
        desktopMenu.classList.add('hidden');
        if (!isExpanded) {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('expanded', 'collapsed');
        }
    }
});

// Initial check on page load
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    const desktopMenu = document.getElementById('desktop-menu');
    
    if (window.innerWidth >= 1024) {
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('expanded', 'collapsed');
        desktopMenu.classList.remove('hidden');
    } else {
        desktopMenu.classList.add('hidden');
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('expanded', 'collapsed');
    }
});
</script>