<!-- Sidebar Component for Admin -->
<!-- Sidebar Overlay for mobile -->
<div id="sidebarOverlay" class="fixed inset-0 z-40 bg-black bg-opacity-30 backdrop-blur-sm hidden lg:hidden"></div>
<!-- Sidebar -->
<aside id="adminSidebar" class="z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out min-h-screen flex-shrink-0 flex flex-col fixed inset-y-0 left-0 lg:static lg:translate-x-0 lg:block sidebar">
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
        <img src="../public/favicon/favicon.png" alt="favicon" class="h-10 w-10" />
        <!-- <span class="font-semibold">AAC Innovation</span> -->
        <button id="sidebarClose" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
            <!-- X Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <nav class="mt-6 px-3 flex-1">
        <div class="space-y-3">
            <?php
            $navItems = [
                ["Dashboard", "dashboard.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 13h8V3H3v10zm10 8h8v-6h-8v6z'/></svg>"],
                ["Bookings", "bookings.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/></svg>"],
                ["Contacts", "contacts.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z'/></svg>"],
                ["Services", "services.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6'/></svg>"],
                ["Team", "team.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z'/></svg>"],
                ["Settings", "settings.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3'/></svg>"],
                ["Logout", "logout.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 16l4-4m0 0l-4-4m4 4H7'/></svg>", true],
            ];
            $current = basename($_SERVER['PHP_SELF']);
            foreach ($navItems as $item) {
                $isActive = strpos($current, basename($item[1])) !== false;
                $classes = $isActive
                    ? "bg-primary-900 text-primary-100 transition-all duration-200 shadow-sm"
                    : "text-gray-700 hover:text-secondary-900 hover:bg-secondary-300 transition-all duration-200 shadow-sm hover:scale-[1.03]";
                if (isset($item[3]) && $item[3]) {
                    echo "<form method='post' action='{$item[1]}'><button type='submit' class='group flex items-center w-full px-3 py-2 text-sm font-medium rounded-md transition-colors {$classes}'>{$item[2]}{$item[0]}</button></form>";
                } else {
                    echo "<a href='{$item[1]}' class='group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {$classes}'>{$item[2]}{$item[0]}</a>";
                }
            }
            ?>
        </div>
    </nav>
</aside>