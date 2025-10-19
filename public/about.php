<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | AAC Innovation</title>
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative py-24 text-white">
            <div class="absolute inset-0 z-0">
                <img src="img/3-staff.jpg" alt="AAC Innovation About Background" class="w-full h-full object-cover object-center" style="object-position: center 30%;" />
                <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-primary-800/80"></div>
            </div>
            <div class="relative z-10 container-max section-padding text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">About AAC Innovation</h1>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">Empowering Africa's Digital Transformation - We're passionate about empowering businesses across Africa with innovative technology solutions that drive growth and success.</p>
            </div>
        </section>
        <!-- Mission, Vision, Values -->
        <section class="section-padding bg-white">
            <div class="container-max">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php
                    $about_cards = [
                        [
                            'icon' => 'Target',
                            'title' => 'Our Mission',
                            'content' => 'To provide innovative, scalable, and accessible digital services in areas such as cybersecurity, fintech, cloud computing, AI, IoT, and strategic consulting—helping businesses and individuals embrace the digital future.'
                        ],
                        [
                            'icon' => 'Eye',
                            'title' => 'Our Vision',
                            'content' => 'To establish a trusted online platform that highlights our expertise in cutting-edge digital solutions, positioning us as a leader in technology services across Africa.'
                        ],
                        [
                            'icon' => 'Heart',
                            'title' => 'Our Values',
                            'content' => 'Innovation, integrity, excellence, and partnership. We believe in building long-term relationships with our clients and delivering solutions that create lasting value.'
                        ]
                    ];
                    function about_svg($icon, $class = '')
                    {
                        switch ($icon) {
                            case 'Target':
                                return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>';
                            case 'Eye':
                                return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
                            case 'Heart':
                                return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 21C12 21 4 13.36 4 8.5C4 5.42 6.42 3 9.5 3C11.24 3 12.91 3.81 14 5.08C15.09 3.81 16.76 3 18.5 3C21.58 3 24 5.42 24 8.5C24 13.36 16 21 16 21H12Z"/></svg>';
                            default:
                                return '';
                        }
                    }
                    foreach ($about_cards as $card): ?>
                        <div class="card text-center h-full box-shadow">
                            <div class="pt-6">
                                <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-6">
                                    <?= about_svg($card['icon'], 'h-8 w-8 text-primary-600') ?>
                                </div>
                                <h3 class="text-xl font-bold text-secondary-900 mb-4"> <?= htmlspecialchars($card['title']) ?> </h3>
                                <p class="text-secondary-600"> <?= htmlspecialchars($card['content']) ?> </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Company Story -->
        <section class="section-padding bg-secondary-50">
            <div class="container-max">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-6">Our Story</h2>
                        <div class="space-y-4 text-secondary-600">
                            <p>Founded with a vision to bridge the technology gap across Africa, AAC Innovation has grown from a small team of passionate technologists to a leading provider of digital solutions across the continent.</p>
                            <p>We recognized early on that Africa's digital transformation required more than just technology—it needed partners who understood the unique challenges and opportunities of the African market. That's why we've dedicated ourselves to creating solutions that are not only innovative but also practical and accessible.</p>
                            <p>Today, we're proud to have helped hundreds of businesses across Africa leverage technology to grow, compete, and thrive in the digital economy. Our journey is just beginning, and we're excited about the future we're building together with our clients and partners.</p>
                        </div>
                    </div>
                    <div>
                        <img src="img/3-staff-2.jpg" alt="AAC Innovation Team" class="rounded-lg shadow-lg" />
                    </div>
                </div>
            </div>
        </section>
        <!-- Stats -->
        <section class="section-padding bg-primary-900 text-white">
            <div class="container-max">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Impact in Numbers</h2>
                    <p class="text-xl text-primary-100 max-w-2xl mx-auto">These numbers represent the trust our clients place in us and the impact we've made across Africa's technology landscape.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <?php
                    $stats = [
                        ['number' => '100+', 'label' => 'Projects Completed'],
                        ['number' => '50+', 'label' => 'Happy Clients'],
                        ['number' => '10+', 'label' => 'Countries Served'],
                        ['number' => '5+', 'label' => 'Years Experience'],
                    ];
                    foreach ($stats as $stat): ?>
                        <div class="text-center">
                            <div class="text-4xl md:text-5xl font-bold text-white mb-2"> <?= $stat['number'] ?> </div>
                            <div class="text-primary-200"> <?= htmlspecialchars($stat['label']) ?> </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Team -->
        <section class="section-padding bg-white">
            <div class="container-max">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">Meet Our Team</h2>
                    <p class="text-lg text-secondary-600 max-w-2xl mx-auto">Our diverse team of experts brings together decades of experience in technology, business, and innovation.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $team = [
                        [
                            'name' => 'Adams Cheko',
                            'role' => 'CEO & Founder',
                            'avatar' => 'img/staff-1.jpg',
                            'expertise' => ['Leadership', 'Strategy', 'Innovation']
                        ],
                        [
                            'name' => 'Muhammad Alogni',
                            'role' => 'CTO',
                            'avatar' => 'img/staff-2.jpg',
                            'expertise' => ['Cloud', 'AI', 'Security']
                        ],
                        [
                            'name' => 'Muhammad Adam',
                            'role' => 'Lead Developer',
                            'avatar' => 'img/staff-1-alt.jpg',
                            'expertise' => ['Web', 'Mobile', 'Fintech']
                        ],
                    ];
                    foreach ($team as $member): ?>
                        <div class="card text-center box-shadow">
                            <div class="pt-6">
                                <img src="<?= $member['avatar'] ?>" alt="<?= htmlspecialchars($member['name']) ?>" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover" />
                                <h3 class="text-xl font-bold text-secondary-900 mb-1"> <?= htmlspecialchars($member['name']) ?> </h3>
                                <p class="text-primary-600 font-medium mb-3"> <?= htmlspecialchars($member['role']) ?> </p>
                                <div class="flex flex-wrap gap-2 justify-center">
                                    <?php foreach ($member['expertise'] as $skill): ?>
                                        <span class="px-2 py-1 bg-secondary-100 text-secondary-700 text-xs rounded-full"> <?= htmlspecialchars($skill) ?> </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Why Choose Us -->
        <section class="section-padding bg-secondary-50">
            <div class="container-max">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">Why Choose AAC Innovation?</h2>
                    <p class="text-lg text-secondary-600 max-w-2xl mx-auto">We're more than just a technology provider—we're your strategic partner in digital transformation.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php
                    $features = [
                        'Deep understanding of African markets and challenges',
                        'Proven track record of successful implementations',
                        'Comprehensive range of technology services',
                        'Expert team with international experience',
                        '24/7 support and ongoing partnership',
                        'Innovative solutions tailored to your needs',
                        'Competitive pricing and flexible engagement models',
                        'Strong focus on security and compliance',
                    ];
                    function check_svg($class = '')
                    {
                        return '<svg xmlns="http://www.w3.org/2000/svg" class="' . $class . '" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" /></svg>';
                    }
                    foreach ($features as $item): ?>
                        <div class="flex items-center space-x-3">
                            <?= check_svg('h-5 w-5 text-primary-600 flex-shrink-0') ?>
                            <span class="text-secondary-700"> <?= htmlspecialchars($item) ?> </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- CTA Section -->
        <section class="section-padding bg-primary-900">
            <div class="container-max">
                <div class="text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Work with Us?</h2>
                    <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">Let's discuss how we can help transform your business with innovative technology solutions tailored to your needs.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="contact.php" class="bg-white text-primary-600 px-6 py-3 rounded-md flex items-center justify-center font-semibold hover:bg-gray-50 transition-colors">
                            <span>Get in Touch</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="booking.php" class="bg-white text-primary-600 px-6 py-3 rounded-md flex items-center justify-center font-semibold hover:bg-gray-50 transition-colors">
                            <span>Schedule Consultation</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
    <script src="js/navbar.js"></script>
</body>

</html>