<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAC Innovation</title>
    <!-- tailwind cdn -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
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
                    <a href="public/about.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">About Us</a>
                    <a href="public/services.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Services</a>
                    <a href="public/contact.php" class="text-sm font-medium text-gray-700 hover:text-primary-600">Contact</a>
                </div>

                <!-- Desktop CTA -->
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="tel:07076536019" class="flex items-center space-x-2 text-sm text-gray-600 hover:text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 16.92V19a2 2 0 01-2.18 2A19.72 19.72 0 013 5.18 2 2 0 015 3h2.09a2 2 0 012 1.72c.13 1.05.37 2.07.72 3.06a2 2 0 01-.45 2.11l-.27.27a16 16 0 006.29 6.29l.27-.27a2 2 0 012.11-.45c.99.35 2.01.59 3.06.72A2 2 0 0122 16.92z" />
                        </svg>
                        <span>0707 653 6019</span>
                    </a>
                    <a href="public/booking.php" class="bg-primary-900 text-white px-4 py-2 rounded-md text-sm hover:bg-primary-700">Book Consultation</a>
                    <a href="admin/login" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-300">Admin</a>
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
                <a href="/index.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">Home</a>
                <a href="public/about.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">About Us</a>
                <a href="public/services.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">Services</a>
                <a href="public/contact.php" class="px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-50 hover:text-primary-700">Contact</a>
                <a href="public/booking.php" class="bg-primary-900 text-white px-6 py-2 rounded-md transition-colors duration-200 hover:bg-primary-700 flex items-center justify-center">Book Consultation</a>
                <a href="admin/login" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md transition-colors duration-200 hover:bg-gray-300 flex items-center justify-center">Admin</a>
            </div>
        </div>
    </header>
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div id="hero-carousel" class="relative w-full h-full overflow-hidden">
                    <div class="carousel-slide selected" style="background-image: url('/aac_innovation/public/img/hero.jpg');"></div>
                    <div class="carousel-slide" style="background-image: url('/aac_innovation/public/img/staff-1-and-2.jpg');"></div>
                    <div class="carousel-slide" style="background-image: url('/aac_innovation/public/img/3-staff.jpg');"></div>
                </div>
                <!-- Navigation Buttons -->
                <button id="prev-slide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-slide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            <div class="relative z-10 container-max section-padding text-center text-white">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6">
                    <span class="block">AAC Innovation</span>
                    <span class="block text-2xl md:text-3xl lg:text-4xl font-normal text-primary-200 mt-2">Empowering Africa's Digital Transformation</span>
                </h1>
                <p class="text-xl md:text-2xl text-primary-100 mb-8 max-w-3xl mx-auto">Driving technological advancement across Africa with expert solutions.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="public/services.php" class="inline bg-primary-900 text-white px-6 py-3 rounded-md flex items-center justify-center">
                        <span>Explore Services</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
                <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white/50 rounded-full mt-2"></div>
                </div>
            </div>
        </section>

        <script>
            // Improved Vanilla JS Carousel Logic
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.carousel-slide');
                const prevButton = document.getElementById('prev-slide');
                const nextButton = document.getElementById('next-slide');
                let currentSlide = 0;

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        if (i === index) {
                            slide.style.display = 'block';
                            slide.classList.add('selected');
                        } else {
                            slide.style.display = 'none';
                            slide.classList.remove('selected');
                        }
                    });
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                }

                function prevSlide() {
                    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                    showSlide(currentSlide);
                }

                nextButton.addEventListener('click', nextSlide);
                prevButton.addEventListener('click', prevSlide);

                // Auto-slide every 3 seconds
                setInterval(nextSlide, 3000);

                // Initialize
                showSlide(currentSlide);
            });
        </script>

        <!-- About Section -->
        <section class="section-padding bg-white">
            <div class="container-max">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6">Empowering Africa's Digital Transformation</h2>
                        <p class="text-lg text-secondary-600 mb-6">At AAC Innovation, we're committed to driving technological advancement across Africa. Our team of experts delivers cutting-edge solutions that help businesses and individuals embrace the digital future with confidence.</p>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" />
                                </svg>
                                <span class="text-secondary-700">Innovative technology solutions tailored for African markets</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" />
                                </svg>
                                <span class="text-secondary-700">Expert team with deep industry knowledge</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" />
                                </svg>
                                <span class="text-secondary-700">Proven track record of successful implementations</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" />
                                </svg>
                                <span class="text-secondary-700">24/7 support and ongoing partnership</span>
                            </div>
                        </div>
                        <div class="mt-8">
                            <a href="public/about.php" class="inline bg-primary-900 text-white px-4 py-2 rounded-md">
                                <span>Learn More About Us</span>
                            </a>
                        </div>
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop&crop=center" alt="Team collaboration" class="rounded-lg shadow-lg" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Overview -->
        <section class="section-padding bg-secondary-50">
            <div class="container-max">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">Our Service Categories</h2>
                    <p class="text-lg text-secondary-600 max-w-2xl mx-auto">Comprehensive technology solutions designed to meet your business needs</p>
                </div>
                <?php
                // --- PHP services array (mirroring services.ts) ---
                $services = [
                    ["id" => "penetration-testing", "title" => "Penetration Testing", "description" => "Comprehensive security assessments to identify vulnerabilities in your systems and applications.", "icon" => "Shield", "category" => "cybersecurity"],
                    ["id" => "security-consulting", "title" => "Security Consulting", "description" => "Expert cybersecurity guidance to strengthen your organization's security posture.", "icon" => "Shield", "category" => "cybersecurity"],
                    ["id" => "payment-gateway", "title" => "Payment Gateway Integration", "description" => "Seamless integration of secure payment processing solutions for your business.", "icon" => "CreditCard", "category" => "fintech"],
                    ["id" => "digital-wallet", "title" => "Digital Wallet Solutions", "description" => "Custom digital wallet development for secure financial transactions.", "icon" => "CreditCard", "category" => "fintech"],
                    ["id" => "cloud-migration", "title" => "Cloud Migration Services", "description" => "Seamless migration of your infrastructure and applications to the cloud.", "icon" => "Cloud", "category" => "cloud"],
                    ["id" => "enterprise-software", "title" => "Enterprise Software Development", "description" => "Custom enterprise applications tailored to your business needs.", "icon" => "Cloud", "category" => "cloud"],
                    ["id" => "ai-chatbots", "title" => "AI Chatbots & Virtual Assistants", "description" => "Intelligent conversational AI to enhance customer service and engagement.", "icon" => "Brain", "category" => "ai"],
                    ["id" => "process-automation", "title" => "Business Process Automation", "description" => "Streamline operations with intelligent automation solutions.", "icon" => "Brain", "category" => "ai"],
                    ["id" => "iot-solutions", "title" => "IoT Device Management", "description" => "Comprehensive IoT solutions for smart device connectivity and management.", "icon" => "Wifi", "category" => "iot"],
                    ["id" => "smart-building", "title" => "Smart Building Solutions", "description" => "Intelligent building management systems for energy efficiency and security.", "icon" => "Wifi", "category" => "iot"],
                    ["id" => "mobile-app-development", "title" => "Mobile App Development", "description" => "Custom mobile applications for iOS and Android platforms with modern technologies.", "icon" => "Smartphone", "category" => "mobile"],
                    ["id" => "uiux-design", "title" => "UI/UX Design", "description" => "User-centered design solutions for web and mobile applications.", "icon" => "Smartphone", "category" => "mobile"],
                    ["id" => "web-development", "title" => "Custom Web Development", "description" => "Professional web development services for modern, responsive websites and web applications.", "icon" => "Globe", "category" => "web"],
                    ["id" => "ecommerce-development", "title" => "E-commerce Development", "description" => "Complete e-commerce solutions with payment integration and inventory management.", "icon" => "ShoppingCart", "category" => "web"],
                    ["id" => "web-maintenance", "title" => "Website Maintenance & Support", "description" => "Ongoing maintenance, updates, and technical support for websites and web applications.", "icon" => "Wrench", "category" => "web"],
                    ["id" => "digital-transformation", "title" => "Digital Transformation Consulting", "description" => "Strategic guidance to modernize your business processes and technology stack.", "icon" => "Target", "category" => "strategic"],
                ];
                // Group by category, pick first as representative
                $categoryMap = [];
                foreach ($services as $svc) {
                    if (!isset($categoryMap[$svc["category"]])) {
                        $categoryMap[$svc["category"]] = $svc;
                    }
                }
                $serviceCategories = array_values($categoryMap);
                // Featured services: first 6
                $featuredServices = array_slice($services, 0, 6);
                function lucide_svg($icon, $class = '')
                {
                    // Only a few icons needed for HomePage
                    switch ($icon) {
                        case 'Shield':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l8 4v5c0 5.25-3.5 10-8 10S4 17.25 4 12V7l8-4z"/></svg>';
                        case 'CreditCard':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>';
                        case 'Cloud':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.5 19a4.5 4.5 0 0 0 0-9c-.2 0-.4 0-.6.03A6 6 0 1 0 6 17"/></svg>';
                        case 'Brain':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M8 15s1.5-2 4-2 4 2 4 2"/></svg>';
                        case 'Wifi':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M5 13a10 10 0 0 1 14 0M8.5 16.5a5 5 0 0 1 7 0M12 20h.01"/></svg>';
                        case 'Smartphone':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="7" y="2" width="10" height="20" rx="2"/><path d="M12 18h.01"/></svg>';
                        case 'Globe':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"/></svg>';
                        case 'ShoppingCart':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>';
                        case 'Wrench':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M14.7 6.3a5 5 0 0 1-6.6 6.6l-4.6 4.6a2 2 0 1 0 2.8 2.8l4.6-4.6a5 5 0 0 1 6.6-6.6z"/></svg>';
                        case 'Target':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>';
                        default:
                            return '';
                    }
                }
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($serviceCategories as $cat): ?>
                        <div class="card h-full flex flex-col items-center">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                                <?= lucide_svg($cat['icon'], 'h-6 w-6 text-primary-600') ?>
                            </div>
                            <div class="card-header text-center">
                                <div class="card-title"><?= htmlspecialchars(ucfirst($cat['category'])) ?></div>
                                <div class="card-description"> <?= htmlspecialchars($cat['description']) ?> </div>
                            </div>
                            <div class="card-content mt-auto">
                                <a href="public/services.php#<?= htmlspecialchars($cat['category']) ?>" class="bg-primary-900 text-white px-4 py-2 rounded-md flex items-center justify-center text-sm mt-4">
                                    <span>Learn More</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- <div class="text-center mt-12">
                    <a href="public/services.php" class="bg-primary-900 text-white px-6 py-3 rounded-md flex items-center justify-center">
                        <span>View All Services</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div> -->
            </div>
        </section>
        </div>
        </section>

        <!-- Featured Services -->
        <section class="section-padding bg-white">
            <div class="container-max">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">Featured Services</h2>
                    <p class="text-lg text-secondary-600 max-w-2xl mx-auto">Popular solutions that are transforming businesses across Africa</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($featuredServices as $svc): ?>
                        <div class="card h-full flex flex-col">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mb-3">
                                <?= lucide_svg($svc['icon'], 'h-5 w-5 text-primary-600') ?>
                            </div>
                            <div class="card-header">
                                <div class="card-title"> <?= htmlspecialchars($svc['title']) ?> </div>
                                <div class="card-description"> <?= htmlspecialchars($svc['description']) ?> </div>
                            </div>
                            <div class="card-content mt-auto">
                                <a href="public/services.php?id=<?= htmlspecialchars($svc['id']) ?>" class="bg-primary-900 text-white px-4 py-2 rounded-md flex items-center justify-center text-sm mt-4">
                                    <span>Learn More</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Quick Booking Widget -->
        <section class="section-padding bg-primary-900 text-white">
            <div class="container-max text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Transform Your Business?</h2>
                <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">Schedule a free consultation with our experts and discover how we can help you achieve your technology goals.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="public/booking.php" class="bg-white text-primary-600 px-6 py-3 rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2" stroke="currentColor" fill="none" />
                            <path d="M16 2v4M8 2v4M3 10h18" stroke-width="2" stroke="currentColor" fill="none" />
                        </svg>
                        <span>Book Free Consultation</span>
                    </a>
                    <a href="public/contact.php" class="bg-gray-200 text-primary-600 px-6 py-3 rounded-md flex items-center justify-center">
                        <span>Contact Our Team</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="section-padding bg-secondary-50">
            <div class="container-max">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">What Our Clients Say</h2>
                    <p class="text-lg text-secondary-600 max-w-2xl mx-auto">Trusted by businesses across Africa for innovative technology solutions</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="card h-full flex flex-col">
                        <div class="flex mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                        </div>
                        <p class="text-secondary-600 mb-4">"AAC Innovation transformed our payment processing system. The implementation was seamless and the results exceeded our expectations."</p>
                        <div>
                            <p class="font-semibold text-secondary-900">Sarah Johnson</p>
                            <p class="text-sm text-secondary-500">FinTech Solutions Ltd</p>
                        </div>
                    </div>
                    <div class="card h-full flex flex-col">
                        <div class="flex mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                        </div>
                        <p class="text-secondary-600 mb-4">"Their IoT solutions helped us optimize our production line and reduce costs by 30%. Excellent technical expertise and support."</p>
                        <div>
                            <p class="font-semibold text-secondary-900">Michael Okafor</p>
                            <p class="text-sm text-secondary-500">Abuja Manufacturing Co</p>
                        </div>
                    </div>
                    <div class="card h-full flex flex-col">
                        <div class="flex mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                <polygon points="12 17.27 18.18 21 16.54 13.97 22 9.24 14.81 8.63 12 2 9.19 8.63 2 9.24 7.46 13.97 5.82 21 12 17.27" />
                            </svg>
                        </div>
                        <p class="text-secondary-600 mb-4">"The cybersecurity audit and implementation by AAC Innovation gave us confidence in our security posture. Highly recommended."</p>
                        <div>
                            <p class="font-semibold text-secondary-900">Amina Hassan</p>
                            <p class="text-sm text-secondary-500">Digital Bank Africa</p>
                        </div>
                    </div>
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
                        <img src="public/favicon/favicon-black-outline.png" alt="AAC Innovation" class="h-10 w-10">
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
                        <li><a href="public/about.php" class="text-gray-400 hover:text-white transition-colors duration-200">About Us</a></li>
                        <li><a href="public/services.php" class="text-gray-400 hover:text-white transition-colors duration-200">Services</a></li>
                        <li><a href="public/contact.php" class="text-gray-400 hover:text-white transition-colors duration-200">Contact</a></li>
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

    <script>
        // Mobile nav toggle logic with overlay
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
    </script>

</body>

</html>