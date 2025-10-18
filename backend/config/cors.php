<?php
// ============================================
// CORS HEADERS - MUST BE FIRST
// ============================================

// Allowed origins
$allowedOrigins = [
    'http://localhost:5173',
    'http://localhost:5174',
    'http://localhost:3000',
    'http://localhost:5175',
    'https://aacinnovation.com.ng',
    'https://www.aacinnovation.com.ng',
];

// Get the request origin
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

// CRITICAL: When using credentials, cannot use wildcard (*)
// Must specify exact origin
if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
} elseif ($origin) {
    // Development only - allow any origin that sends one
    // REMOVE THIS IN PRODUCTION!
    header("Access-Control-Allow-Origin: $origin");
} else {
    // Fallback
    header("Access-Control-Allow-Origin: http://localhost:5173");
}

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept, Origin");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(0);
}
