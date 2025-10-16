<?php

require_once __DIR__ . '/../config/database.php';

// GET bookings
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
        $stmt = $pdo->prepare(
            'SELECT b.*, s.title AS service_title
             FROM bookings b
             LEFT JOIN services s ON b.service_id = s.id
             WHERE b.id = ?
             LIMIT 1'
        );
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
        // Basic validation
        if (!isset($data['firstName'], $data['lastName'], $data['email'], $data['phone'], $data['serviceId'], $data['preferredDate'], $data['preferredTime'], $data['consent'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }
        // Insert booking
        $stmt = $pdo->prepare(
            'INSERT INTO bookings (client_name, client_email, client_phone, company, service_id, consultant_id, scheduled_date, scheduled_time, message, status, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, "pending", NOW())'
        );
        $stmt->execute([
            $data['firstName'] . ' ' . $data['lastName'],
            $data['email'],
            $data['phone'],
            $data['company'] ?? '',
            $data['serviceId'],
            $data['consultantId'] ?? '',
            $data['preferredDate'],
            $data['preferredTime'],
            $data['message'] ?? ''
        ]);
        $id = $pdo->lastInsertId();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Booking submitted successfully', 'data' => ['id' => $id, 'status' => 'pending']]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// PUT booking status by ID
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $allowedStatus = ['pending', 'confirmed', 'rescheduled', 'cancelled', 'completed', 'no_show'];
        $allowedBookingType = ['consultation', 'demo', 'follow_up', 'technical_review'];
        $updatableFields = [
            'client_name',
            'client_email',
            'client_phone',
            'company',
            'service_id',
            'consultant_id',
            'scheduled_date',
            'scheduled_time',
            'message',
            'status',
            'booking_type',
            'duration_minutes',
            'meeting_link',
            'meeting_notes',
            'reminder_sent',
            'confirmation_sent',
            'calendar_event_id',
            'assigned_to'
        ];
        $updates = [];
        foreach ($updatableFields as $field) {
            if (isset($data[$field])) {
                $updates[$field] = $data[$field];
            }
        }
        if (isset($updates['status']) && !in_array($updates['status'], $allowedStatus, true)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid status value']);
            exit;
        }
        if (isset($updates['booking_type']) && !in_array($updates['booking_type'], $allowedBookingType, true)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid booking_type value']);
            exit;
        }
        if (empty($updates)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'No valid fields to update']);
            exit;
        }
        $setClause = implode(', ', array_map(fn($field) => "$field = :$field", array_keys($updates)));
        $stmt = $pdo->prepare("UPDATE bookings SET $setClause, updated_at = NOW() WHERE id = :id");
        $updates['id'] = $id;
        $stmt->execute($updates);
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Booking not found']);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Booking updated']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
