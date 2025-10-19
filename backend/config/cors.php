
<?php
// Set timezone to Africa/Lagos
date_default_timezone_set('Africa/Lagos');

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

// Log the origin and request method for debugging
error_log("CORS Debug: HTTP_ORIGIN = " . ($origin ?: 'No Origin Header'));
error_log("CORS Debug: REQUEST_METHOD = " . $_SERVER['REQUEST_METHOD']);

// Ensure Access-Control-Allow-Origin is always set
if ($origin && in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
} else {
    // Fallback to a default origin
    header("Access-Control-Allow-Origin: http://localhost:5173");
    error_log("CORS Debug: Using fallback origin http://localhost:5173");
}

// Ensure headers are set for all requests
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
