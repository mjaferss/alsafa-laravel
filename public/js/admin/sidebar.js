// Get DOM elements
const sidebar = document.querySelector('.sidebar');
const sidebarBackdrop = document.querySelector('.sidebar-backdrop');

// Update sidebar state in localStorage
const updateSidebarState = (isCollapsed) => {
    localStorage.setItem('sidebarCollapsed', isCollapsed);
};

// Handle screen size changes
const handleScreenSize = () => {
    const width = window.innerWidth;
    if (width <= 991.98) { // Mobile & Tablet
        sidebar.classList.remove('collapsed');
        updateSidebarState(false);
        if (width <= 767.98) { // Mobile only
            sidebar.classList.remove('show');
            sidebarBackdrop.classList.remove('show');
        }
    } else { // Desktop
        const shouldCollapse = localStorage.getItem('sidebarCollapsed') === 'true';
        sidebar.classList.toggle('collapsed', shouldCollapse);
        updateSidebarState(shouldCollapse);
    }
};

// Initial setup
handleScreenSize();

// Handle window resize with debounce
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(handleScreenSize, 250);
});

// Enhanced dropdown functionality
const dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dropdown => {
    const dropdownMenu = dropdown.querySelector('.dropdown-menu');
    const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
    
    if (dropdownMenu && dropdownToggle) {
        // Desktop: Hover
        if (window.innerWidth > 991.98) {
            dropdown.addEventListener('mouseenter', () => {
                dropdownMenu.classList.add('show');
            });
            
            dropdown.addEventListener('mouseleave', () => {
                dropdownMenu.classList.remove('show');
            });
        }
        
        // Mobile: Click
        dropdownToggle.addEventListener('click', (e) => {
            if (window.innerWidth <= 991.98) {
                e.preventDefault();
                dropdownMenu.classList.toggle('show');
            }
        });
    }
});

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu.show')
            .forEach(menu => menu.classList.remove('show'));
    }
}); 