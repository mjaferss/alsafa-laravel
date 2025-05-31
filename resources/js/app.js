import './bootstrap';
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';

// Make Bootstrap available globally
window.bootstrap = bootstrap;

// Make SweetAlert2 available globally
window.Swal = Swal;

// Language switcher
document.addEventListener('DOMContentLoaded', function() {
    const languageSelector = document.getElementById('language-selector');
    if (languageSelector) {
        languageSelector.addEventListener('change', function() {
            const lang = this.value;
            document.documentElement.lang = lang;
            document.body.className = lang === 'ar' ? 'rtl' : 'ltr';
        });
    }
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
