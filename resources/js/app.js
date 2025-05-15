import 'flowbite';
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Initialize Flowbite
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM Content Loaded');
    
    const navbarToggle = document.querySelector('[aria-controls="navbar-default"]');
    const navbar = document.getElementById('navbar-default');
    
    console.log('Navbar Toggle:', navbarToggle);
    console.log('Navbar:', navbar);

    if (navbarToggle && navbar) {
        console.log('Adding click event listener');
        navbarToggle.addEventListener('click', (e) => {
            console.log('Button clicked');
            e.preventDefault();
            navbar.classList.toggle('hidden');
            const isExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';
            navbarToggle.setAttribute('aria-expanded', !isExpanded);
            console.log('Navbar hidden:', navbar.classList.contains('hidden'));
        });
    } else {
        console.error('Navbar elements not found');
        if (!navbarToggle) console.error('Navbar toggle button not found');
        if (!navbar) console.error('Navbar element not found');
    }
});
