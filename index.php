<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAC Innovation</title>
    <link rel="stylesheet" href="config/tailwind.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="fixed top-0 left-0 right-0 z-40 bg-white shadow-md">
        <div class="container mx-auto py-4 px-4">
            <nav class="flex items-center justify-between">
                <!-- Logo -->
                <a href="/index.php" class="flex items-center space-x-3">
                    <img src="public/favicon.png" alt="AAC Innovation" class="h-10 w-10">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">AAC Innovation</h1>
                        <p class="text-xs text-gray-600 hidden sm:block">Empowering Africa's Digital Transformation</p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/index.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Home</a>
                    <a href="/public/about.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">About Us</a>
                    <a href="/public/services.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Services</a>
                    <a href="/public/contact.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Contact</a>
                </div>

                <!-- Desktop CTA -->
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="tel:07076536019" class="flex items-center space-x-2 text-sm text-gray-600 hover:text-primary-600">
                        <i class="fas fa-phone"></i>
                        <span>0707 653 6019</span>
                    </a>
                    <a href="/public/booking.php" class="bg-primary-600 text-white px-4 py-2 rounded-md text-sm hover:bg-primary-700">Book Consultation</a>
                    <a href="/admin/login" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300">Admin</a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div id="hero-carousel" class="relative w-full h-full overflow-hidden">
                    <div class="carousel-slide" style="background-image: url('public/img/hero.jpg');"></div>
                    <div class="carousel-slide" style="background-image: url('public/img/staff-1-and-2.jpg');"></div>
                    <div class="carousel-slide" style="background-image: url('public/img/3-staff.jpg');"></div>
                </div>
            </div>
            <div class="relative z-10 container mx-auto text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">AAC Innovation</h1>
                <p class="text-xl md:text-2xl mb-8">Empowering Africa's Digital Transformation</p>
                <a href="/public/services.php" class="bg-primary-600 text-white px-6 py-3 rounded-md">Explore Services</a>
            </div>
        </section>

        <!-- About Section -->
        <section class="py-12 bg-white">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-6">Empowering Africa's Digital Transformation</h2>
                <p class="text-lg text-center text-gray-600 mb-6">
                    At AAC Innovation, we're committed to driving technological advancement across Africa.
                </p>
            </div>
        </section>

        <!-- Services Overview -->
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-6">Our Service Categories</h2>
                <div id="service-categories" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </section>

        <!-- Featured Services -->
        <section class="py-12 bg-white">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-center mb-6">Featured Services</h2>
                <div id="featured-services" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto py-12 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="/favicon-black-outline.png" alt="AAC Innovation" class="h-10 w-10">
                        <div>
                            <h3 class="text-xl font-bold">AAC Innovation</h3>
                            <p class="text-sm text-gray-400">Empowering Africa's Digital Transformation</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md">
                        Driving technological advancement across Africa with expert solutions.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/index.php" class="text-gray-400 hover:text-white transition-colors duration-200">Home</a></li>
                        <li><a href="/public/about.php" class="text-gray-400 hover:text-white transition-colors duration-200">About Us</a></li>
                        <li><a href="/public/services.php" class="text-gray-400 hover:text-white transition-colors duration-200">Services</a></li>
                        <li><a href="/public/contact.php" class="text-gray-400 hover:text-white transition-colors duration-200">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <div class="space-y-3">
                        <a href="mailto:aacinovations43@gmail.com" class="flex items-center space-x-3 text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fas fa-envelope"></i>
                            <span>aacinovations43@gmail.com</span>
                        </a>
                        <a href="tel:07076536019" class="flex items-center space-x-3 text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fas fa-phone"></i>
                            <span>0707 653 6019</span>
                        </a>
                        <div class="flex items-center space-x-3 text-gray-400">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Abuja, Nigeria</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-500 text-sm">© 2025 AAC Innovation. All rights reserved.</p>
                    <p class="text-gray-500 text-sm mt-2 md:mt-0">Empowering Africa's Digital Transformation</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Hero Carousel Logic
        const slides = document.querySelectorAll('.carousel-slide');
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('selected');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('selected');
        }, 3000);

        // Fetch and Render Service Categories
        fetch('/api/services')
            .then(response => response.json())
            .then(data => {
                const categoriesContainer = document.getElementById('service-categories');
                data.categories.forEach(category => {
                    const categoryElement = document.createElement('div');
                    categoryElement.className = 'p-4 bg-white shadow rounded';
                    categoryElement.innerHTML = `
                <h3 class="text-xl font-bold">${category.name}</h3>
                <p class="text-gray-600">${category.description}</p>
            `;
                    categoriesContainer.appendChild(categoryElement);
                });
            });

        // Fetch and Render Featured Services
        fetch('/api/featured-services')
            .then(response => response.json())
            .then(data => {
                const featuredContainer = document.getElementById('featured-services');
                data.services.forEach(service => {
                    const serviceElement = document.createElement('div');
                    serviceElement.className = 'p-4 bg-white shadow rounded';
                    serviceElement.innerHTML = `
                <h3 class="text-xl font-bold">${service.name}</h3>
                <p class="text-gray-600">${service.description}</p>
            `;
                    featuredContainer.appendChild(serviceElement);
                });
            });
    </script>

</body>

</html>