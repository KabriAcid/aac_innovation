<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Detail</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const id = <?php echo $id; ?>;
            const detail = document.getElementById('booking-detail');
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
                    fetchBookingDetail();
                });

            function fetchBookingDetail() {
                fetch(`../backend/api/bookings.php?id=${id}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.data) {
                            const b = data.data;
                            const serviceTitle = servicesMap[b.service_id] || 'Unknown';
                            const status = b.status || 'pending';
                            detail.innerHTML = `
              <div class='card box-shadow p-8'>
                <div class='flex items-center justify-between mb-6'>
                  <h2 class='text-xl font-bold text-gray-900'>Booking #${b.id}</h2>
                  <span class='px-3 py-1 text-sm font-medium rounded-full ${getStatusColor(status)}'>${status}</span>
                </div>
                <div class='grid grid-cols-1 md:grid-cols-2 gap-6 mb-8'>
                  <div>
                    <h3 class='font-semibold mb-2'>Client Info</h3>
                    <div class='text-gray-700'>
                      <div><span class='font-medium'>Name:</span> ${b.client_name}</div>
                      <div><span class='font-medium'>Email:</span> ${b.client_email}</div>
                      <div><span class='font-medium'>Phone:</span> ${b.client_phone}</div>
                    </div>
                  </div>
                  <div>
                    <h3 class='font-semibold mb-2'>Service Info</h3>
                    <div class='text-gray-700'>
                      <div><span class='font-medium'>Service:</span> ${serviceTitle}</div>
                      <div><span class='font-medium'>Date:</span> ${b.scheduled_date}</div>
                      <div><span class='font-medium'>Time:</span> ${b.scheduled_time}</div>
                    </div>
                  </div>
                </div>
                <div class='mb-8'>
                  <h3 class='font-semibold mb-2'>Notes</h3>
                  <div class='text-gray-700'>${b.message || '<span class="text-gray-400">No notes provided.</span>'}</div>
                </div>
                <div class='flex gap-4'>
                  <button class='btn btn-primary' onclick='window.history.back()'>Back</button>
                  <button class='btn btn-danger'>Cancel Booking</button>
                  <button class='btn btn-success'>Confirm Booking</button>
                </div>
              </div>
            `;
                        } else {
                            detail.innerHTML = `<div class='card p-12 text-center'><h3 class='text-lg font-medium text-gray-900 mb-2'>Booking not found</h3><p class='text-gray-500'>No booking found for this ID.</p></div>`;
                        }
                    });
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
                <div id="booking-detail" class="py-8 text-center text-gray-500">Loading...</div>
            </div>
        </main>
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>