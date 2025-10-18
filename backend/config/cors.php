<?php
/**
 * CORS Configuration
 * Include this at the top of every API endpoint file
 */

// Define allowed origins
$allowedOrigins = [
    'http://aacinnovation.com.ng',
    'http://localhost:5173', // Vite default port
    'http://localhost:5174',
    'http://localhost:3000',
];

// Get the origin of the request
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

// Check if the origin is allowed
if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
} else {
    // For development, you might want to allow all origins
    // Remove this in production
    header("Access-Control-Allow-Origin: *");
}

// Allow credentials (cookies, authorization headers, etc.)
header("Access-Control-Allow-Credentials: true");

// Specify allowed methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH");

// Specify allowed headers
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept, Origin");

// Set max age for preflight cache (in seconds)
header("Access-Control-Max-Age: 3600");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Set content type for API responses
header("Content-Type: application/json; charset=UTF-8");
?>