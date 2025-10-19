<?php
session_start();

require_once __DIR__ . '/../config/database.php';

// GET all bookings
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
    try {
        $stmt = $pdo->query('SELECT * FROM bookings ORDER BY created_at DESC LIMIT 50');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $rows]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// GET booking by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Booking not found']);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $row]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// POST booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['firstName'], $data['lastName'], $data['email'], $data['phone'], $data['serviceId'], $data['preferredDate'], $data['preferredTime'], $data['consent'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }
        $stmt = $pdo->prepare(
            'INSERT INTO bookings (client_name, client_email, client_phone, company, service_id, scheduled_date, scheduled_time, message, consent, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())'
        );
        $stmt->execute([
            $data['firstName'] . ' ' . $data['lastName'],
            $data['email'],
            $data['phone'],
            $data['company'] ?? '',
            $data['serviceId'],
            $data['preferredDate'],
            $data['preferredTime'],
            $data['message'] ?? '',
            $data['consent'] ? 1 : 0
        ]);
        $id = $pdo->lastInsertId();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Booking submitted successfully', 'data' => ['id' => $id]]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// PUT update booking (not supported in current schema)
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    try {
        // No updatable fields in current schema, so this block can be removed or adapted if needed
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Update not supported in current schema']);
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
