<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables
$envFile = getenv('NODE_ENV') === 'production' ? '.env.production' : '.env';
$dotenv = Dotenv::createImmutable(__DIR__, $envFile);
$dotenv->load();

// Include API files directly
require_once __DIR__ . '/api/bookings.php';
require_once __DIR__ . '/api/services.php';
require_once __DIR__ . '/api/contacts.php';
require_once __DIR__ . '/api/email.php';
require_once __DIR__ . '/api/settings.php';
require_once __DIR__ . '/api/auth.php';
require_once __DIR__ . '/api/admin.php';
require_once __DIR__ . '/api/dashboard.php';

// Simple response for testing
header('Content-Type: application/json');
echo json_encode(["status" => "API is running"]);
