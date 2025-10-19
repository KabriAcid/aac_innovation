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
                ["Dashboard", "dashboard.php", "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-layout-dashboard-icon lucide-layout-dashboard mr-3 h-5 w-5 flex-shrink-0'><rect width='7' height='9' x='3' y='3' rx='1'/><rect width='7' height='5' x='14' y='3' rx='1'/><rect width='7' height='9' x='14' y='12' rx='1'/><rect width='7' height='5' x='3' y='16' rx='1'/></svg>"],
                ["Bookings", "bookings.php", "<svg class='mr-3 h-5 w-5 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/></svg>"],
                ["Contacts", "contacts.php", "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-contact-icon lucide-contact mr-3 h-5 w-5 flex-shrink-0'><path d='M16 2v2'/><path d='M7 22v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2'/><path d='M8 2v2'/><circle cx='12' cy='11' r='3'/><rect x='3' y='4' width='18' height='18' rx='2'/></svg>"],
                ["Categories", "categories.php", "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-folder-icon lucide-folder mr-3 h-5 w-5 flex-shrink-0'><path d='M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z'/></svg>"],
                ["Services", "services.php", "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-wrench-icon lucide-wrench mr-3 h-5 w-5 flex-shrink-0'><path d='M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.106-3.105c.32-.322.863-.22.983.218a6 6 0 0 1-8.259 7.057l-7.91 7.91a1 1 0 0 1-2.999-3l7.91-7.91a6 6 0 0 1 7.057-8.259c.438.12.54.662.219.984z'/></svg>"],
                ["Team", "team.php", "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-circle-user-icon lucide-circle-user mr-3 h-5 w-5 flex-shrink-0'><circle cx='12' cy='12' r='10'/><circle cx='12' cy='10' r='3'/><path d='M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662'/></svg>"],
                ["Settings", "settings.php", "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-settings-icon lucide-settings mr-3 h-5 w-5 flex-shrink-0'><path d='M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915'/><circle cx='12' cy='12' r='3'/></svg>"],
                ["Logout", "logout.php", "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-log-out-icon lucide-log-out mr-3 h-5 w-5 flex-shrink-0'><path d='m16 17 5-5-5-5'/><path d='M21 12H9'/><path d='M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4'/></svg>", true],
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