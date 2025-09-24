<?php

/**
 * Contact Form API Endpoint
 * 
 * Handles contact form submissions with validation and email notifications
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

require_once '../config/database.php';
require_once '../config/email.php';

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input) {
        throw new Exception('Invalid JSON input');
    }

    // Validate required fields
    $required_fields = ['firstName', 'lastName', 'email', 'message', 'consent'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            $errors[$field] = ucfirst($field) . ' is required';
        }
    }

    // Validate email format
    if (!empty($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    // Validate consent
    if (!$input['consent']) {
        $errors['consent'] = 'You must agree to the privacy policy';
    }

    // Return validation errors
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ]);
        exit();
    }

    // Sanitize input data
    $data = [
        'firstName' => htmlspecialchars(trim($input['firstName'])),
        'lastName' => htmlspecialchars(trim($input['lastName'])),
        'email' => filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(trim($input['phone'] ?? '')),
        'company' => htmlspecialchars(trim($input['company'] ?? '')),
        'serviceInterest' => htmlspecialchars(trim($input['serviceInterest'] ?? '')),
        'message' => htmlspecialchars(trim($input['message'])),
        'consent' => (bool)$input['consent']
    ];

    // Save to database
    $sql = "INSERT INTO contacts (first_name, last_name, email, phone, company, service_interest, message, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = executeQuery($sql, [
        $data['firstName'],
        $data['lastName'],
        $data['email'],
        $data['phone'],
        $data['company'],
        $data['serviceInterest'],
        $data['message']
    ]);

    $contactId = getLastInsertId();

    // Send email notification
    $emailService = new EmailService();
    $emailSent = $emailService->sendContactNotification($data);

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Contact form submitted successfully',
        'data' => [
            'id' => $contactId,
            'emailSent' => $emailSent
        ]
    ]);
} catch (Exception $e) {
    error_log("Contact form error: " . $e->getMessage());

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your request'
    ]);
}
