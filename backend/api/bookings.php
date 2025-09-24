<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/email.php';

// Use $pdo from database.php
global $pdo;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $sql = "SELECT id, client_name, client_email, service_id, scheduled_date, 
                       scheduled_time, status, created_at 
                FROM bookings 
                ORDER BY created_at DESC 
                LIMIT 50";
        $stmt = $pdo->query($sql);
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode([
            'success' => true,
            'data' => $bookings
        ]);
    } catch (\Exception $e) {
        error_log("Booking fetch error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Failed to fetch bookings'
        ]);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

try {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        throw new \Exception('Invalid JSON input');
    }
    $requiredFields = ['firstName', 'lastName', 'email', 'phone', 'serviceId', 'preferredDate', 'preferredTime', 'consent'];
    $errors = [];
    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            $errors[$field] = ucfirst($field) . ' is required';
        }
    }
    if (!empty($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    if (!empty($input['phone']) && !preg_match('/^[\+]?[1-9][\d]{0,15}$/', str_replace(' ', '', $input['phone']))) {
        $errors['phone'] = 'Invalid phone number format';
    }
    if (!empty($input['preferredDate'])) {
        $selectedDate = new \DateTime($input['preferredDate']);
        $today = new \DateTime();
        if ($selectedDate <= $today) {
            $errors['preferredDate'] = 'Please select a future date';
        }
    }
    if (!empty($input['preferredTime']) && !preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $input['preferredTime'])) {
        $errors['preferredTime'] = 'Invalid time format';
    }
    if (!$input['consent']) {
        $errors['consent'] = 'You must agree to the privacy policy';
    }
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ]);
        exit();
    }
    $data = [
        'firstName' => htmlspecialchars(trim($input['firstName'])),
        'lastName' => htmlspecialchars(trim($input['lastName'])),
        'email' => filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(trim($input['phone'])),
        'company' => htmlspecialchars(trim($input['company'] ?? '')),
        'serviceId' => htmlspecialchars(trim($input['serviceId'])),
        'consultantId' => htmlspecialchars(trim($input['consultantId'] ?? '')),
        'preferredDate' => $input['preferredDate'],
        'preferredTime' => $input['preferredTime'],
        'message' => htmlspecialchars(trim($input['message'] ?? '')),
        'consent' => (bool)$input['consent']
    ];
    // Check for existing booking conflicts (same date/time)
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as count 
        FROM bookings 
        WHERE scheduled_date = :date 
        AND scheduled_time = :time 
        AND status != 'cancelled'
    ");
    $stmt->execute([
        ':date' => $data['preferredDate'],
        ':time' => $data['preferredTime']
    ]);
    $conflict = $stmt->fetch();
    if ($conflict['count'] > 0) {
        http_response_code(409);
        echo json_encode([
            'success' => false,
            'message' => 'This time slot is already booked. Please select a different time.'
        ]);
        exit();
    }
    // Save booking to database
    $stmt = $pdo->prepare("
        INSERT INTO bookings (
            client_name, client_email, client_phone, company, service_id, 
            consultant_id, scheduled_date, scheduled_time, message, status, created_at
        ) VALUES (
            :clientName, :email, :phone, :company, :serviceId, 
            :consultantId, :scheduledDate, :scheduledTime, :message, 'pending', NOW()
        )
    ");
    $stmt->execute([
        ':clientName' => $data['firstName'] . ' ' . $data['lastName'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':company' => $data['company'],
        ':serviceId' => $data['serviceId'],
        ':consultantId' => $data['consultantId'],
        ':scheduledDate' => $data['preferredDate'],
        ':scheduledTime' => $data['preferredTime'],
        ':message' => $data['message']
    ]);
    $bookingId = $pdo->lastInsertId();
    // Send confirmation email
    $emailService = new \EmailService();
    $emailSent = $emailService->sendBookingConfirmation($data);
    echo json_encode([
        'success' => true,
        'message' => 'Booking submitted successfully',
        'data' => [
            'id' => $bookingId,
            'status' => 'pending',
            'emailSent' => $emailSent
        ]
    ]);
} catch (\Exception $e) {
    error_log("Booking error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your booking'
    ]);
}
