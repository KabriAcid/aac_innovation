<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Services</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let services = [];
            let filteredServices = [];
            const searchInput = document.getElementById('searchServices');
            const list = document.getElementById('services-list');
            // Fetch services
            fetch('../backend/api/services.php')
                .then(res => res.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        services = data.data;
                        filteredServices = services;
                        renderServices(filteredServices);
                    } else {
                        list.innerHTML = `<div class='col-span-full'><div class='card p-12 text-center'><svg class='w-12 h-12 text-gray-400 mx-auto mb-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6'/></svg><h3 class='text-lg font-medium text-gray-900 mb-2'>No services found</h3><p class='text-gray-500'>No service records found.</p></div></div>`;
                    }
                })
                .catch(() => {
                    list.innerHTML = `<div class='col-span-full'><div class='card p-12 text-center'><h3 class='text-lg font-medium text-gray-900 mb-2'>Failed to load services</h3><p class='text-gray-500'>Please try again later.</p></div></div>`;
                });

            function filterServices() {
                let filtered = services;
                const searchTerm = searchInput ? searchInput.value.trim().toLowerCase() : '';
                if (searchTerm) {
                    filtered = filtered.filter(s =>
                        (s.name || '').toLowerCase().includes(searchTerm) ||
                        (s.description || '').toLowerCase().includes(searchTerm) ||
                        (s.category || '').toLowerCase().includes(searchTerm)
                    );
                }
                filteredServices = filtered;
                renderServices(filteredServices);
            }
            if (searchInput) {
                searchInput.addEventListener('input', filterServices);
            }

            function renderServices(servicesArr) {
                if (!list) return;
                if (!servicesArr.length) {
                    list.innerHTML = `<div class='col-span-full'><div class='card p-12 text-center'><svg class='w-12 h-12 text-gray-400 mx-auto mb-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6'/></svg><h3 class='text-lg font-medium text-gray-900 mb-2'>No services found</h3><p class='text-gray-500'>${searchInput && searchInput.value ? 'Try adjusting your search criteria.' : 'No service records found.'}</p></div></div>`;
                    return;
                }
                list.innerHTML = servicesArr.map(s => {
                    return `
                        <div class='card p-6 hover:shadow-md transition-shadow cursor-pointer' onclick='window.location.href="services_detail.php?id=${s.id}"'>
                            <div class='flex items-start justify-between mb-4'>
                                <div class='flex-1'>
                                    <div class='flex items-center space-x-2 mb-2'>
                                        <h3 class='text-lg font-semibold text-gray-900'>${s.name}</h3>
                                        <span class='px-2 py-1 text-xs font-medium rounded-full ${s.is_active ? "bg-green-100 text-green-800" : "bg-gray-100 text-gray-800"}'>${s.is_active ? 'Active' : 'Inactive'}</span>
                                    </div>
                                    <p class='text-sm text-gray-600 mb-3'>${s.category}</p>
                                </div>
                            </div>
                            <p class='text-gray-700 text-sm mb-4 line-clamp-3'>${s.description}</p>
                            <div class='flex items-center justify-between text-sm text-gray-600 mb-4'>
                                <span class='font-medium'>${s.price}</span>
                                <span>${s.duration}</span>
                            </div>
                        </div>
                    `;
                }).join('');
            }
        });
    </script>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col lg:flex-row sidebar-open">
    <?php include 'components/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0 lg:pl-0">
        <?php include 'components/topnav.php'; ?>
        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">Services</h1>
                    <button id="addServiceBtn" class="btn btn-primary flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>Add Service</button>
                </div>
                <div class="card box-shadow p-4 mb-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" id="searchServices" class="input" placeholder="Search services..." />
                        </div>
                    </div>
                </div>
                <div id="services-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
            </div>
        </main>
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>