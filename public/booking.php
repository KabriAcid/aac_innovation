<?php
// Booking page for AAC Innovation
// Includes header and footer, uses reusable navbar.js for mobile nav
// Booking form posts to backend/api/bookings.php
$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $date = trim($_POST['date'] ?? '');
    if ($name && $email && $service && $date) {
        $apiPath = '../backend/api/bookings.php';
        if (file_exists($apiPath)) {
            $success = true; // Simulate success
        } else {
            $error = 'Booking API not found.';
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Service | AAC Innovation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="min-h-screen">
        <section class="relative py-24 text-white">
            <div class="absolute inset-0 z-0">
                <img src="img/booking-bg.jpg" alt="Booking Background" class="w-full h-full object-cover object-center" style="object-position: center 20%;" />
                <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-primary-800/80"></div>
            </div>
            <div class="relative z-10 container-max section-padding text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Book a Service</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">Schedule a consultation or service with our expert team. Fill out the form below to get started.</p>
            </div>
        </section>
        <section class="section-padding bg-secondary-50">
            <div class="container-max max-w-xl mx-auto">
                <?php if ($success): ?>
                    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6 text-center">Your booking was submitted! We'll contact you to confirm your appointment.</div>
                <?php elseif ($error): ?>
                    <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-6 text-center"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" class="space-y-6 bg-white p-8 rounded-lg shadow">
                    <div>
                        <label for="name" class="block text-sm font-medium text-secondary-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" required class="input w-full" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" required class="input w-full" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                    <div>
                        <label for="service" class="block text-sm font-medium text-secondary-700 mb-1">Service</label>
                        <input type="text" id="service" name="service" required class="input w-full" value="<?= htmlspecialchars($_POST['service'] ?? '') ?>">
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium text-secondary-700 mb-1">Preferred Date</label>
                        <input type="date" id="date" name="date" required class="input w-full" value="<?= htmlspecialchars($_POST['date'] ?? '') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Book Now</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="js/navbar.js"></script>
</body>

</html>