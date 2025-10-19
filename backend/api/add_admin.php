<?php

session_start();
require_once '../config/database.php';
header('Content-Type: application/json');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['username'], $input['email'], $input['firstName'], $input['lastName'], $input['role'], $input['password'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
        exit;
    }
    // Check if username or email exists
    $stmt = $pdo->prepare('SELECT id FROM admin_users WHERE username = ? OR email = ? LIMIT 1');
    $stmt->execute([$input['username'], $input['email']]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'error' => 'Username or email already exists']);
        exit;
    }
    $hash = password_hash($input['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO admin_users (username, email, password_hash, first_name, last_name, role, is_active) VALUES (?, ?, ?, ?, ?, ?, 1)');
    $ok = $stmt->execute([
        $input['username'],
        $input['email'],
        $hash,
        $input['firstName'],
        $input['lastName'],
        $input['role']
    ]);
    if ($ok) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to add admin']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
