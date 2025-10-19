document.addEventListener('DOMContentLoaded', function() {
    var mobileMenuBtn = document.getElementById('mobile-menu-btn');
    var mobileNav = document.getElementById('mobile-nav');
    var closeMobileNav = document.getElementById('close-mobile-nav');
    var overlay = document.getElementById('mobile-nav-overlay');

    function openMobileNav() {
        mobileNav.style.display = 'flex';
        overlay.classList.remove('hidden');
        setTimeout(function() {
            mobileNav.classList.remove('translate-x-full');
            overlay.classList.add('opacity-100');
        }, 10);
    }

    function closeMobileNavFn() {
        mobileNav.classList.add('translate-x-full');
        overlay.classList.remove('opacity-100');
        setTimeout(function() {
            mobileNav.style.display = 'none';
            overlay.classList.add('hidden');
        }, 300);
    }
    if (mobileMenuBtn && mobileNav && closeMobileNav && overlay) {
        mobileMenuBtn.addEventListener('click', openMobileNav);
        closeMobileNav.addEventListener('click', closeMobileNavFn);
        overlay.addEventListener('click', closeMobileNavFn);
    }
});
