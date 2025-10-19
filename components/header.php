<header class="fixed top-0 left-0 right-0 z-40 bg-white shadow-md">
    <div class="container mx-auto py-4 px-4">
        <nav class="flex items-center justify-between">
            <!-- Logo -->
            <a href="../index.php" class="flex items-center space-x-3">
                <img src="../public/favicon/favicon.png" alt="AAC Innovation" class="h-10 w-10">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">AAC Innovation</h1>
                    <p class="text-xs text-gray-600 hidden sm:block">Empowering Africa's Digital Transformation</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="../index.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Home</a>
                <a href="../public/about.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">About Us</a>
                <a href="../public/services.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Services</a>
                <a href="../public/contact.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Contact</a>
            </div>

            <!-- Desktop CTA -->
            <div class="hidden lg:flex items-center space-x-4">
                <a href="tel:07076536019" class="flex items-center space-x-2 text-sm text-gray-600 hover:text-primary-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 16.92V19a2 2 0 01-2.18 2A19.72 19.72 0 013 5.18 2 2 0 015 3h2.09a2 2 0 012 1.72c.13 1.05.37 2.07.72 3.06a2 2 0 01-.45 2.11l-.27.27a16 16 0 006.29 6.29l.27-.27a2 2 0 012.11-.45c.99.35 2.01.59 3.06.72A2 2 0 0122 16.92z" />
                    </svg>
                    <span>0707 653 6019</span>
                </a>
                <a href="../public/booking.php" class="bg-primary-900 text-white px-4 py-2 rounded-md text-sm hover:bg-primary-700">Book Consultation</a>
                <a href="../admin/login.php" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300">Admin</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>
        <!-- Mobile Navigation & Overlay -->
        <div id="mobile-nav-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-40 hidden lg:hidden transition-opacity duration-300"></div>
        <div id="mobile-nav" class="fixed inset-0 z-50 bg-white bg-opacity-95 flex flex-col items-center justify-center space-y-8 text-xl font-semibold text-gray-900 transition-transform duration-300 transform translate-x-full lg:hidden" style="display: none;">
            <button id="close-mobile-nav" class="absolute top-6 right-6 p-2 rounded-full bg-gray-200 hover:bg-gray-300" aria-label="Close menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <a href="../index.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">Home</a>
            <a href="../public/about.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">About Us</a>
            <a href="../public/services.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">Services</a>
            <a href="../public/contact.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">Contact</a>
            <a href="../public/booking.php" class="bg-primary-900 text-white px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-700 flex items-center justify-center">Book Consultation</a>
            <a href="../admin/login.php" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md transition-colors duration-200 hover:bg-gray-300 flex items-center justify-center">Admin</a>
        </div>
    </div>
</header>