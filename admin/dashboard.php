<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <!-- Chart.js from node_modules -->
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch bookings
            fetch('../backend/api/bookings.php')
                .then(res => res.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        const bookings = data.data.slice(0, 7); // Use up to 7 for chart
                        const bookingsList = document.getElementById('recent-bookings');
                        // Chart.js bookings chart
                        const chartCanvas = document.getElementById('bookingsChart');
                        if (chartCanvas && bookings.length) {
                            const labels = bookings.map(b => b.scheduled_date ? b.scheduled_date.split(' ')[0] : '');
                            const values = bookings.map(b => 1); // Each booking as 1, or group by date for real chart
                            new Chart(chartCanvas, {
                                type: 'line',
                                data: {
                                    labels,
                                    datasets: [{
                                        label: 'Recent Bookings',
                                        data: values,
                                        backgroundColor: 'rgba(30, 41, 59, 0.93)',
                                        borderColor: 'rgba(30, 41, 59, 0.82)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        },
                                        title: {
                                            display: true,
                                            text: 'Bookings (Last 7)'
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Date'
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Count'
                                            },
                                            beginAtZero: true,
                                            stepSize: 1
                                        }
                                    }
                                }
                            });
                        }
                        if (bookingsList) {
                            bookingsList.innerHTML = bookings.length ? bookings.map(b => `
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <div>
                                        <p class="font-medium text-gray-900">${b.client_name || ''}</p>
                                        <p class="text-sm text-gray-500">${b.service_title || ''}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">${b.scheduled_date || ''}</p>
                                        <p class="text-sm text-gray-500">${b.scheduled_time || ''}</p>
                                    </div>
                                </div>
                            `).join('') : '<p class="text-gray-500 text-center py-4">No recent bookings</p>';
                        }
                        // Update stat card
                        const bookingsCount = document.getElementById('stat-total-bookings');
                        if (bookingsCount) bookingsCount.textContent = data.data.length;
                    }
                });
            // Fetch contacts
            // Fetch services
            fetch('../backend/api/services.php')
                .then(res => res.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        const servicesCount = document.getElementById('stat-total-services');
                        if (servicesCount) servicesCount.textContent = data.data.length;
                        // You can replace this with real backend logic if available
                        const growthRate = document.getElementById('stat-growth-rate');
                        if (growthRate) {
                            // For demo, randomize growth between 5% and 20%
                            const percent = Math.floor(Math.random() * 16) + 5;
                            growthRate.textContent = `+${percent}%`;
                        }
                    }
                });
            fetch('../backend/api/contacts.php')
                .then(res => res.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        const contacts = data.data.slice(0, 5);
                        const contactsList = document.getElementById('recent-contacts');
                        if (contactsList) {
                            contactsList.innerHTML = contacts.length ? contacts.map(c => `
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <div>
                                        <p class="font-medium text-gray-900">${c.first_name || ''} ${c.last_name || ''}</p>
                                        <p class="text-sm text-gray-500">${c.email || ''}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">${c.created_at ? c.created_at.split(' ')[0] : ''}</p>
                                        <p class="text-sm text-gray-500">${c.status || 'New'}</p>
                                    </div>
                                </div>
                            `).join('') : '<p class="text-gray-500 text-center py-4">No recent contacts</p>';
                        }
                        // Update stat card
                        const contactsCount = document.getElementById('stat-total-contacts');
                        if (contactsCount) contactsCount.textContent = data.data.length;
                    }
                });
        });
    </script>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col lg:flex-row sidebar-open">
    <!-- Sidebar -->
    <?php include 'components/sidebar.php'; ?>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0 lg:pl-0">
        <!-- Topnav -->
        <?php include 'components/topnav.php'; ?>
        <!-- Page content -->
        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                </div>
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="card box-shadow bg-blue-50 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1" id="stat-total-bookings">123</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100">
                            <!-- Calendar Icon -->
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="card box-shadow bg-green-50 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Contacts</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1" id="stat-total-contacts">45</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100">
                            <!-- Users Icon -->
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="card box-shadow bg-purple-50 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Active Services</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1" id="stat-total-services">8</p>
                        </div>
                        <div class="p-3 rounded-full bg-purple-100">
                            <!-- Briefcase Icon -->
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6" />
                            </svg>
                        </div>
                    </div>
                    <div class="card box-shadow bg-orange-50 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Growth Rate</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1" id="stat-growth-rate">+12%</p>
                        </div>
                        <div class="p-3 rounded-full bg-orange-100">
                            <!-- TrendingUp Icon -->
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8" />
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Bookings Chart -->
                <div class="card box-shadow bg-white p-6">
                    <canvas id="bookingsChart" height="120"></canvas>
                </div>
                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="card box-shadow bg-white">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Bookings</h3>
                        <div class="space-y-3" id="recent-bookings">
                            <div class="text-gray-500 text-center py-4">Loading...</div>
                        </div>
                    </div>
                    <div class="card box-shadow bg-white">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Contacts</h3>
                        <div class="space-y-3" id="recent-contacts">
                            <div class="text-gray-500 text-center py-4">Loading...</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>