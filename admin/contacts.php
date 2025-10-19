<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Contacts</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let contacts = [];
            let filteredContacts = [];
            const searchInput = document.getElementById('searchContacts');
            // Fetch contacts
            fetch('../backend/api/contacts.php')
                .then(res => res.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        contacts = data.data;
                        filteredContacts = contacts;
                        renderContacts(filteredContacts);
                    }
                });

            function filterContacts() {
                let filtered = contacts;
                const searchTerm = searchInput ? searchInput.value.trim().toLowerCase() : '';
                if (searchTerm) {
                    filtered = filtered.filter(c =>
                        (c.name || '').toLowerCase().includes(searchTerm) ||
                        (c.email || '').toLowerCase().includes(searchTerm) ||
                        (c.subject || '').toLowerCase().includes(searchTerm)
                    );
                }
                filteredContacts = filtered;
                renderContacts(filteredContacts);
            }
            if (searchInput) {
                searchInput.addEventListener('input', filterContacts);
            }

            function getStatusColor(status) {
                switch (status) {
                    case 'replied':
                        return 'bg-green-100 text-green-800';
                    case 'in-progress':
                        return 'bg-yellow-100 text-yellow-800';
                    case 'closed':
                        return 'bg-gray-100 text-gray-800';
                    default:
                        return 'bg-blue-100 text-blue-800';
                }
            }

            function formatDate(dateStr) {
                if (!dateStr) return '';
                const d = new Date(dateStr);
                return d.toLocaleDateString('en-NG', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }

            function renderContacts(contactsArr) {
                const list = document.getElementById('contacts-list');
                if (!list) return;
                if (!contactsArr.length) {
                    list.innerHTML = `<div class='card p-12 text-center box-shadow'><svg class='w-12 h-12 text-gray-400 mx-auto mb-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 12v4m0 0v4m0-4h4m-4 0H8m8-4a8 8 0 11-16 0 8 8 0 0116 0z'/></svg><h3 class='text-lg font-medium text-gray-900 mb-2'>No contacts found</h3><p class='text-gray-500'>${searchInput && searchInput.value ? 'Try adjusting your search criteria.' : 'No contact messages have been received yet.'}</p></div>`;
                    return;
                }
                list.innerHTML = contactsArr.map(c => {
                    const status = c.status || 'new';
                    // Fix name and subject mapping
                    const name = c.name || ((c.first_name || '') + ' ' + (c.last_name || '')).trim() || 'No name';
                    const subject = c.subject || c.service_interest || 'No subject';
                    return `
                                <div class='card p-6 box-shadow hover:shadow-md transition-shadow'>
                                    <div class='flex items-center justify-between'>
                                        <div class='flex-1 min-w-0'>
                                            <div class='flex items-center space-x-3 mb-2'>
                                                <h3 class='text-lg font-semibold text-gray-900 truncate'>${name}</h3>
                                                <span class='px-2 py-1 text-xs font-medium rounded-full ${getStatusColor(status)}'>${status.charAt(0).toUpperCase() + status.slice(1)}</span>
                                            </div>
                                            <div class='grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-gray-600'>
                                                <div class='flex items-center'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 12v4m0 0v4m0-4h4m-4 0H8m8-4a8 8 0 11-16 0 8 8 0 0116 0z'/></svg>${c.email}</div>
                                                <div class='flex items-center'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'/></svg>${subject}</div>
                                                <div class='flex items-center'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'/></svg>${formatDate(c.created_at || c.date)}</div>
                                            </div>
                                            ${c.message ? `<p class='mt-2 text-sm text-gray-600 line-clamp-2'>${c.message}</p>` : ''}
                                        </div>
                                        <div class='ml-4'>
                                            <a href='contacts_detail.php?id=${c.id}'><button class='btn btn-secondary btn-sm'><svg class='w-4 h-4 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/></svg>View</button></a>
                                        </div>
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
                    <h1 class="text-2xl font-bold text-gray-900">Contacts</h1>
                    <div class="text-sm text-gray-500" id="contacts-count"></div>
                </div>
                <div class="card box-shadow p-4 mb-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" id="searchContacts" class="input" placeholder="Search contacts..." />
                        </div>
                    </div>
                </div>
                <div id="contacts-list" class="space-y-4">
                    <div class="text-gray-500 text-center py-4">
                        <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>