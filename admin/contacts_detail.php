<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Detail</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const id = <?php echo $id; ?>;
            const detail = document.getElementById('contact-detail');
            // Fetch contact detail
            fetch(`../backend/api/contacts.php?id=${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.data) {
                        const c = data.data;
                        const status = c.status || 'new';
                        detail.innerHTML = `
              <div class='space-y-6'>
                <!-- Breadcrumb -->
                <nav class='flex mb-4 text-sm text-gray-500' aria-label='Breadcrumb'>
                  <ol class='inline-flex items-center space-x-1'>
                    <li><a href='dashboard.php' class='hover:text-blue-600'>Dashboard</a></li>
                    <li>/</li>
                    <li><a href='contacts.php' class='hover:text-blue-600'>Contacts</a></li>
                    <li>/</li>
                    <li class='text-gray-700 font-semibold'>Contact Detail</li>
                  </ol>
                </nav>
                <div class='flex items-center justify-between mb-4'>
                  <button class='btn btn-secondary' style='background-color:#f3f4f6;color:#374151;' onclick='window.location.href="contacts.php"'>Back</button>
                  <span class='px-3 py-1 text-sm font-medium rounded-full border ${getStatusColor(status)}'>${status.charAt(0).toUpperCase() + status.slice(1)}</span>
                </div>
                <h3 class='text-lg font-semibold text-gray-900 mb-4'>Contact Information</h3>
                <div class='grid grid-cols-1 lg:grid-cols-3 gap-6'>
                  <div class='lg:col-span-2 space-y-6'>
                    <div class='card p-6 box-shadow'>
                      <div class='grid grid-cols-1 md:grid-cols-2 gap-6'>
                        <div class='space-y-4'>
                          <div><span class='text-sm text-gray-500'>Name</span><div class='font-medium text-gray-900'>${c.name}</div></div>
                          <div><span class='text-sm text-gray-500'>Email</span><div class='font-medium text-gray-900'>${c.email}</div></div>
                          ${c.phone ? `<div><span class='text-sm text-gray-500'>Phone</span><div class='font-medium text-gray-900'>${c.phone}</div></div>` : ''}
                        </div>
                        <div class='space-y-4'>
                          <div><span class='text-sm text-gray-500'>Subject</span><div class='font-medium text-gray-900'>${c.subject}</div></div>
                          <div><span class='text-sm text-gray-500'>Received</span><div class='font-medium text-gray-900'>${formatDate(c.created_at || c.date)}</div></div>
                        </div>
                      </div>
                    </div>
                    <div class='card p-6 box-shadow'>
                      <h3 class='text-lg font-semibold text-gray-900 mb-4'>Message</h3>
                      <div class='bg-gray-50 rounded-lg p-4'>
                        <p class='text-gray-700 whitespace-pre-wrap'>${c.message || '<span class="text-gray-400">No message provided.</span>'}</p>
                      </div>
                    </div>
                  </div>
                  <div class='space-y-6'>
                    <div class='card p-6 box-shadow'>
                      <h3 class='text-lg font-semibold text-gray-900 mb-4'>Contact Details</h3>
                      <div class='space-y-3 text-sm'>
                        <div class='flex justify-between'><span class='text-gray-500'>Contact ID:</span><span class='font-mono text-gray-900'>${c.id}</span></div>
                        <div class='flex justify-between'><span class='text-gray-500'>Received:</span><span class='text-gray-900'>${formatDate(c.created_at || c.date)}</span></div>
                        <div class='flex justify-between'><span class='text-gray-500'>Status:</span><span class='text-gray-900 capitalize'>${status}</span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            `;
                    } else {
                        detail.innerHTML = `<div class='card p-12 text-center'><h3 class='text-lg font-medium text-gray-900 mb-2'>Contact not found</h3><p class='text-gray-500'>No contact found for this ID.</p></div>`;
                    }
                });

            function getStatusColor(status) {
                switch (status) {
                    case 'replied':
                        return 'bg-green-100 text-green-800 border-green-200';
                    case 'in-progress':
                        return 'bg-yellow-100 text-yellow-800 border-yellow-200';
                    case 'closed':
                        return 'bg-gray-100 text-gray-800 border-gray-200';
                    default:
                        return 'bg-blue-100 text-blue-800 border-blue-200';
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
        });
    </script>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col lg:flex-row sidebar-open">
    <?php include 'components/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0 lg:pl-0">
        <?php include 'components/topnav.php'; ?>
        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            <div class="space-y-6">
                <div id="contact-detail" class="py-8 text-center text-gray-500">
                    <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>
            </div>
        </main>
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>