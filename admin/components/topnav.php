<!-- Topnav Component for Admin -->
<div class="sticky top-0 z-10 bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center h-16 px-4 sm:px-6 lg:px-8">
        <button id="sidebarToggle" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
            <!-- Hamburger Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="flex-1"></div>
        <a href="/admin/profile.php" class="ml-auto flex items-center justify-center rounded-full hover:bg-gray-100 p-2 transition-colors" title="Profile">
            <!-- User Icon -->
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </a>
    </div>
</div>
<script>
    // Sidebar toggle logic (to be implemented with sidebar)
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.body.classList.toggle('sidebar-open');
    });
</script>