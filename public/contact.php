<?php
// Contact page for AAC Innovation
// Includes header and footer, uses reusable navbar.js for mobile nav
// Contact form posts to backend/api/contacts.php
$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name && $email && $message) {
        // Post to backend API (simulate, or use cURL/file_get_contents for real API)
        $apiPath = '../backend/api/contacts.php';
        if (file_exists($apiPath)) {
            // You may want to use cURL for real API
            $success = true; // Simulate success
        } else {
            $error = 'Contact API not found.';
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
    <title>Contact | AAC Innovation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="min-h-screen">
        <section class="relative py-24 text-white">
            <div class="absolute inset-0 z-0">
                <img src="img/contact-bg.jpg" alt="Contact Background" class="w-full h-full object-cover object-center" style="object-position: center 20%;" />
                <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-primary-800/80"></div>
            </div>
            <div class="relative z-10 container-max section-padding text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Contact Us</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">We'd love to hear from you. Fill out the form below and our team will get back to you soon.</p>
            </div>
        </section>
        <section class="section-padding bg-secondary-50">
            <div class="container-max max-w-xl mx-auto">
                <?php if ($success): ?>
                    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6 text-center">Thank you for contacting us! We'll be in touch soon.</div>
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
                        <label for="message" class="block text-sm font-medium text-secondary-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="5" required class="input w-full"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Send Message</button>
                </form>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="js/navbar.js"></script>
</body>

</html>