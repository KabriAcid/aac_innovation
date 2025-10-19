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
                    const name = s.name || s.title || '';
                    const active = typeof s.is_active !== 'undefined' ? s.is_active : (typeof s.active !== 'undefined' ? s.active : false);
                    const category = s.category || '';
                    const description = s.description || '';
                    const price = s.price || s.pricing_starting_price || '';
                    const duration = s.duration || '';
                    return `
                        <div class='card p-6 hover:shadow-md transition-shadow cursor-pointer group relative'>
                            <div class='absolute top-4 right-4 z-10'>
                                <button class='edit-service-btn' data-id='${s.id}' title='Edit Service'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-pencil-icon lucide-pencil w-5 h-5 text-gray-500 hover:text-blue-600'><path d='M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z'/><path d='m15 5 4 4'/></svg>
                                </button>
                            </div>
                            <div onclick='window.location.href="services_detail.php?id=${s.id}"'>
                                <div class='flex items-start justify-between mb-4'>
                                    <div class='flex-1'>
                                        <div class='flex items-center space-x-2 mb-2'>
                                            <h3 class='text-lg font-semibold text-gray-900'>${name}</h3>
                                            <span class='px-2 py-1 text-xs font-medium rounded-full ${active ? "bg-green-100 text-green-800" : "bg-gray-100 text-gray-800"}'>${active ? 'Active' : 'Inactive'}</span>
                                        </div>
                                        <p class='text-sm text-gray-600 mb-3'>${category}</p>
                                    </div>
                                </div>
                                <p class='text-gray-700 text-sm mb-4 line-clamp-3'>${description}</p>
                                <div class='flex items-center justify-between text-sm text-gray-600 mb-4'>
                                    <span class='font-medium'>${price}</span>
                                    <span>${duration}</span>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
                // Attach edit button listeners
                document.querySelectorAll('.edit-service-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const id = this.getAttribute('data-id');
                        openServiceModal('edit', id);
                    });
                });
            }
            // Modal logic
            let modalMode = 'add';
            let editingServiceId = null;
            const addServiceBtn = document.getElementById('addServiceBtn');
            addServiceBtn.addEventListener('click', function() {
                openServiceModal('add');
            });

            function openServiceModal(mode, id = null) {
                modalMode = mode;
                editingServiceId = id;
                let service = {
                    name: '',
                    description: '',
                    price: '',
                    duration: '',
                    category: '',
                    active: true
                };
                if (mode === 'edit' && id) {
                    // Find service by id
                    const s = services.find(s => String(s.id) === String(id));
                    if (s) {
                        service = {
                            name: s.name || s.title || '',
                            description: s.description || '',
                            price: s.price || s.pricing_starting_price || '',
                            duration: s.duration || '',
                            category: s.category || '',
                            active: typeof s.is_active !== 'undefined' ? !!s.is_active : !!s.active
                        };
                    }
                }
                showServiceModal(service);
            }

            function showServiceModal(service) {
                // Remove existing modal
                document.getElementById('service-modal')?.remove();
                const modal = document.createElement('div');
                modal.id = 'service-modal';
                modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 backdrop-blur-sm';
                modal.innerHTML = `
                    <div class='bg-white rounded-lg shadow-lg w-full max-w-lg p-8 relative'>
                        <button class='absolute top-4 right-4 text-gray-400 hover:text-gray-600' onclick='document.getElementById("service-modal").remove()'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M6 18L18 6M6 6l12 12'/></svg>
                        </button>
                        <h2 class='text-xl font-bold mb-6'>${modalMode === 'edit' ? 'Edit Service' : 'Add Service'}</h2>
                        <form id='serviceForm' class='space-y-4'>
                            <div>
                                <label class='block text-sm font-medium text-gray-700 mb-1'>Service Name</label>
                                <input type='text' name='name' value='${service.name}' class='input w-full' required placeholder='e.g., AI Chatbot Development' />
                            </div>
                            <div>
                                <label class='block text-sm font-medium text-gray-700 mb-1'>Category</label>
                                <input type='text' name='category' value='${service.category}' class='input w-full' required placeholder='e.g., Cybersecurity, Cloud Computing' />
                            </div>
                            <div class='grid grid-cols-2 gap-4'>
                                <div>
                                    <label class='block text-sm font-medium text-gray-700 mb-1'>Price</label>
                                    <input type='text' name='price' value='${service.price}' class='input w-full' required placeholder='e.g., ₦2,550,000' />
                                </div>
                                <div>
                                    <label class='block text-sm font-medium text-gray-700 mb-1'>Duration</label>
                                    <input type='text' name='duration' value='${service.duration}' class='input w-full' required placeholder='e.g., 2-4 weeks, 1 hour' />
                                </div>
                            </div>
                            <div>
                                <label class='block text-sm font-medium text-gray-700 mb-1'>Description</label>
                                <textarea name='description' rows='4' class='input w-full' required placeholder='Describe the service features, benefits, and scope'>${service.description}</textarea>
                            </div>
                            <div class='flex items-center'>
                                <input type='checkbox' name='active' id='active' ${service.active ? 'checked' : ''} class='mr-2' />
                                <label for='active' class='text-sm font-medium text-gray-700'>Active Service</label>
                            </div>
                            <div class='flex space-x-3 pt-4'>
                                <button type='submit' class='btn btn-primary flex-1'>${modalMode === 'edit' ? 'Update Service' : 'Save Service'}</button>
                                <button type='button' class='btn btn-secondary flex-1' onclick='document.getElementById("service-modal").remove()'>Cancel</button>
                            </div>
                        </form>
                    </div>
                `;
                document.body.appendChild(modal);
                // Form submit logic
                document.getElementById('serviceForm').onsubmit = function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    const payload = {
                        name: fd.get('name'),
                        category: fd.get('category'),
                        price: fd.get('price'),
                        duration: fd.get('duration'),
                        description: fd.get('description'),
                        active: this.active.checked
                    };
                    if (modalMode === 'edit' && editingServiceId) {
                        // Update service
                        fetch(`../backend/api/services.php?id=${editingServiceId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(payload)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('service-modal').remove();
                                    // Reload services
                                    fetch('../backend/api/services.php')
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.success && Array.isArray(data.data)) {
                                                services = data.data;
                                                filteredServices = services;
                                                renderServices(filteredServices);
                                            }
                                        });
                                } else {
                                    alert('Failed to update service');
                                }
                            });
                    } else {
                        // Add service
                        fetch('../backend/api/services.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(payload)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('service-modal').remove();
                                    // Reload services
                                    fetch('../backend/api/services.php')
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.success && Array.isArray(data.data)) {
                                                services = data.data;
                                                filteredServices = services;
                                                renderServices(filteredServices);
                                            }
                                        });
                                } else {
                                    alert('Failed to save service');
                                }
                            });
                    }
                };
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