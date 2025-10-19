<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bookings</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let servicesMap = {};
            // Fetch services first for lookup
            fetch('../backend/api/services.php')
                .then(res => res.json())
                .then(svc => {
                    if (svc.success && Array.isArray(svc.data)) {
                        svc.data.forEach(s => {
                            servicesMap[s.id] = s.name;
                        });
                    }
                    fetchBookings();
                });

            function fetchBookings() {
                fetch('../backend/api/bookings.php')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && Array.isArray(data.data)) {
                            renderBookings(data.data);
                        }
                    });
            }

            function renderBookings(bookings) {
                const list = document.getElementById('bookings-list');
                if (!list) return;
                if (!bookings.length) {
                    list.innerHTML = `<div class='card p-12 text-center'><svg class='w-12 h-12 text-gray-400 mx-auto mb-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/></svg><h3 class='text-lg font-medium text-gray-900 mb-2'>No bookings found</h3><p class='text-gray-500'>No bookings have been made yet.</p></div>`;
                    return;
                }
                list.innerHTML = bookings.map(b => {
                    const serviceTitle = servicesMap[b.service_id] || 'Unknown';
                    const status = b.status || 'pending';
                    return `
                    <div class='card box-shadow p-6 mb-4'>
                        <div class='flex items-center justify-between'>
                            <div class='flex-1 min-w-0'>
                                <div class='flex items-center space-x-3 mb-2'>
                                    <h3 class='text-lg font-semibold text-gray-900 truncate'>${b.client_name}</h3>
                                    <span class='px-2 py-1 text-xs font-medium rounded-full ${getStatusColor(status)}'>${status}</span>
                                </div>
                                <div class='grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600'>
                                    <div class='flex items-center'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 7a4 4 0 11-8 0 4 4 0 018 0z'/></svg>${b.client_email}</div>
                                    <div class='flex items-center'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6'/></svg>${serviceTitle}</div>
                                    <div class='flex items-center'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/></svg>${b.scheduled_date}</div>
                                    <div class='flex items-center'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3'/></svg>${b.scheduled_time}</div>
                                </div>
                            </div>
                            <div class='ml-4'>
                                <a href='bookings_detail.php?id=${b.id}'><button class='btn btn-primary btn-sm'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/></svg>View</button></a>
                            </div>
                        </div>
                    </div>
                `;
                }).join('');
            }

            function getStatusColor(status) {
                switch (status) {
                    case 'confirmed':
                        return 'bg-green-100 text-green-800';
                    case 'pending':
                        return 'bg-yellow-100 text-yellow-800';
                    case 'cancelled':
                        return 'bg-red-100 text-red-800';
                    default:
                        return 'bg-gray-100 text-gray-800';
                }
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
                    <h1 class="text-2xl font-bold text-gray-900">Bookings</h1>
                </div>
                <div class="card box-shadow p-4 mb-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" id="searchBookings" class="input" placeholder="Search bookings..." />
                        </div>
                        <div class="sm:w-48">
                            <select id="statusFilter" class="input">
                                <option value="all">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="bookings-list" class="space-y-4">
                    <div class="text-gray-500 text-center py-4">Loading...</div>
                </div>
            </div>
        </main>
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>