<?php
function service_icon_svg($icon, $class = '')
{
    switch ($icon) {
        case 'Shield':
        case 'ShieldCheck':
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
        default:
            return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="4" y="4" width="16" height="16" rx="2"/></svg>';
    }
}
function check_svg($class = '')
{
    return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" /></svg>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | AAC Innovation</title>
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative py-24 text-white">
            <div class="absolute inset-0 z-0">
                <img src="img/staff-1-and-2.jpg" alt="AAC Innovation Services Background" class="w-full h-full object-cover object-center" style="object-position: center 20%;" />
                <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-primary-800/80"></div>
            </div>
            <div class="relative z-10 container-max section-padding text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Our Services</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">Comprehensive technology solutions designed to drive your business forward in the digital age</p>
            </div>
        </section>
        <!-- Service Filters & Cards -->
        <section class="section-padding bg-secondary-50">
            <div class="container-max">
                <div id="services-error" class="text-center text-red-600 py-12 hidden"></div>
                <div id="services-spinner" class="flex justify-center py-12 hidden">
                    <svg id="spinner-svg" class="animate-spin h-8 w-8 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>
                <div id="services-filters" class="flex flex-wrap gap-4 justify-center mb-8"></div>
                <div id="services-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="js/navbar.js"></script>
    <script>
        // --- SVG icon helpers ---
        function serviceIconSVG(icon, cls = '') {
            switch (icon) {
                case 'Shield':
                case 'ShieldCheck':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l8 4v5c0 5.25-3.5 10-8 10S4 17.25 4 12V7l8-4z"/></svg>`;
                case 'CreditCard':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>`;
                case 'Cloud':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.5 19a4.5 4.5 0 0 0 0-9c-.2 0-.4 0-.6.03A6 6 0 1 0 6 17"/></svg>`;
                case 'Brain':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M8 15s1.5-2 4-2 4 2 4 2"/></svg>`;
                case 'Wifi':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M5 13a10 10 0 0 1 14 0M8.5 16.5a5 5 0 0 1 7 0M12 20h.01"/></svg>`;
                case 'Smartphone':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="7" y="2" width="10" height="20" rx="2"/><path d="M12 18h.01"/></svg>`;
                case 'Globe':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"/></svg>`;
                case 'ShoppingCart':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>`;
                case 'Wrench':
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M14.7 6.3a5 5 0 0 1-6.6 6.6l-4.6 4.6a2 2 0 1 0 2.8 2.8l4.6-4.6a5 5 0 0 1 6.6-6.6z"/></svg>`;
                default:
                    return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="4" y="4" width="16" height="16" rx="2"/></svg>`;
            }
        }

        function checkSVG(cls = '') {
            return `<svg xmlns="http://www.w3.org/2000/svg" class="${cls}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" /></svg>`;
        }

        // --- Render logic ---
        let allServices = [];
        let selectedCategory = null;

        function renderFilters(services) {
            const categories = Array.from(new Set(services.map(s => s.category)));
            let html = `<a href="#" class="px-4 py-2 rounded-md font-medium transition-colors ${!selectedCategory ? 'bg-primary-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-primary-50 hover:text-primary-700'}" data-category="">All Services</a>`;
            for (const cat of categories) {
                html += `<a href="#" class="px-4 py-2 rounded-md font-medium transition-colors ${selectedCategory === cat ? 'bg-primary-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-primary-50 hover:text-primary-700'}" data-category="${cat}">${cat.charAt(0).toUpperCase() + cat.slice(1)}</a>`;
            }
            document.getElementById('services-filters').innerHTML = html;
            // Add click listeners
            document.querySelectorAll('#services-filters a').forEach(a => {
                a.onclick = e => {
                    e.preventDefault();
                    selectedCategory = a.dataset.category || null;
                    renderServices();
                    renderFilters(allServices);
                };
            });
        }

        function renderServices() {
            let filtered = selectedCategory ? allServices.filter(s => s.category === selectedCategory) : allServices;
            if (!filtered.length) {
                document.getElementById('services-list').innerHTML = '<div class="text-center text-secondary-600 py-12">No services available at this time.</div>';
                return;
            }
            let html = '';
            for (const service of filtered) {
                const icon = service.icon || '';
                const categoryTitle = service.category ? service.category.charAt(0).toUpperCase() + service.category.slice(1) : '';
                html += `<div class="card h-full box-shadow">
                <div class="card-header">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                            ${serviceIconSVG(icon, 'h-5 w-5 text-primary-600')}
                        </div>
                        <span class="text-xs font-medium text-primary-600 bg-primary-50 px-2 py-1 rounded-full"> ${categoryTitle} </span>
                    </div>
                    <div class="card-title text-lg font-bold text-secondary-900">${service.title}</div>
                    <div class="card-description text-secondary-600">${service.description}</div>
                </div>
                <div class="card-content mt-4">
                    <div class="space-y-2">
                        <h4 class="font-medium text-secondary-900">Key Features:</h4>
                        <ul class="space-y-1">`;
                if (Array.isArray(service.features)) {
                    for (const feature of service.features.slice(0, 3)) {
                        html += `<li class="flex items-center text-sm text-secondary-600">${checkSVG('h-3 w-3 text-primary-600 mr-2 flex-shrink-0')}${feature}</li>`;
                    }
                }
                html += `</ul>
                    </div>
                </div>
            </div>`;
            }
            document.getElementById('services-list').innerHTML = html;
        }

        function showError(msg) {
            const el = document.getElementById('services-error');
            el.textContent = msg;
            el.classList.remove('hidden');
        }

        // Show/hide spinner
        function showSpinner(show) {
            const el = document.getElementById('services-spinner');
            if (show) {
                el.classList.remove('hidden');
            } else {
                el.classList.add('hidden');
            }
        }

        // Fetch services on page load (like useEffect), using async/await
        window.addEventListener('DOMContentLoaded', async function() {
            showSpinner(true);
            try {
                const res = await fetch('../backend/api/services.php');
                const data = await res.json();
                if (data.success && Array.isArray(data.data)) {
                    allServices = data.data;
                    renderFilters(allServices);
                    renderServices();
                } else {
                    showError('Failed to load services.');
                }
            } catch (e) {
                showError('Failed to load services.');
            } finally {
                showSpinner(false);
            }
        });
    </script>
</body>

</html>