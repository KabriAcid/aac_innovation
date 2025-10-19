<?php

require_once __DIR__ . '/../config/database.php';

// POST contact form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['firstName'], $data['lastName'], $data['email'], $data['message'], $data['consent'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }

        $stmt = $pdo->prepare(
            'INSERT INTO contacts (first_name, last_name, email, phone, company, service_interest, message, consent, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())'
        );
        $stmt->execute([
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['phone'] ?? '',
            $data['company'] ?? '',
            $data['serviceInterest'] ?? '',
            $data['message'],
            $data['consent'] ? 1 : 0
        ]);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Contact form submitted successfully', 'data' => ['id' => $pdo->lastInsertId()]]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// GET all contacts
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
    try {
        $stmt = $pdo->query('SELECT * FROM contacts ORDER BY created_at DESC LIMIT 100');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $rows]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// GET contact by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Contact not found']);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $row]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// PUT update contact status by ID
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $allowedStatus = ['new', 'in-progress', 'replied', 'closed'];
        if (!isset($data['status']) || !in_array($data['status'], $allowedStatus, true)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid status value']);
            exit;
        }

        // No status column in schema, so this block can be removed or adapted if needed
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Status update not supported in current schema']);
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
