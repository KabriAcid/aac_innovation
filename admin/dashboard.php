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
                            <p class="text-2xl font-bold text-gray-900 mt-1">123</p>
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
                            <p class="text-2xl font-bold text-gray-900 mt-1">45</p>
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
                            <p class="text-2xl font-bold text-gray-900 mt-1">8</p>
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
                            <p class="text-2xl font-bold text-gray-900 mt-1">+12%</p>
                        </div>
                        <div class="p-3 rounded-full bg-orange-100">
                            <!-- TrendingUp Icon -->
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8" />
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="card box-shadow bg-white">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Bookings</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <p class="font-medium text-gray-900">Jane Doe</p>
                                    <p class="text-sm text-gray-500">Consulting</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">2025-10-18</p>
                                    <p class="text-sm text-gray-500">10:00 AM</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <p class="font-medium text-gray-900">John Smith</p>
                                    <p class="text-sm text-gray-500">Strategy</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">2025-10-17</p>
                                    <p class="text-sm text-gray-500">2:00 PM</p>
                                </div>
                            </div>
                            <!-- Add more bookings as needed -->
                        </div>
                    </div>
                    <div class="card box-shadow bg-white">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Contacts</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <p class="font-medium text-gray-900">Alice Johnson</p>
                                    <p class="text-sm text-gray-500">alice@email.com</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">2025-10-19</p>
                                    <p class="text-sm text-gray-500">New</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                <div>
                                    <p class="font-medium text-gray-900">Bob Lee</p>
                                    <p class="text-sm text-gray-500">bob@email.com</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">2025-10-18</p>
                                    <p class="text-sm text-gray-500">Pending</p>
                                </div>
                            </div>
                            <!-- Add more contacts as needed -->
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