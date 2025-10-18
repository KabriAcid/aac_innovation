<?php

/**
 * CORS Configuration for Development
 * File: backend/config/cors.php
 */

// Allowed origins for CORS
$allowedOrigins = [
    'http://localhost:5173',
    'http://localhost:5174',
    'http://localhost:3000',
    'http://aacinnovation.com.ng',
    'https://aacinnovation.com.ng',
];

// Get the request origin
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

// Check if origin is allowed and set header
if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $origin");
} else {
    // For development only - comment out in production
    header("Access-Control-Allow-Origin: *");
}

// Allow credentials (cookies, authorization headers)
header("Access-Control-Allow-Credentials: true");

// Allowed HTTP methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH");

// Allowed request headers
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept, Origin, X-Auth-Token");

// Cache preflight response for 1 hour
header("Access-Control-Max-Age: 3600");

// Set content type
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
