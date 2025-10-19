<?php
session_start();
require_once '../config/database.php';
header('Content-Type: application/json');


if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}
$userId = $_SESSION['user']['id'];


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare('SELECT username, email, first_name, last_name, role FROM admin_users WHERE id = ? LIMIT 1');
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo json_encode(['success' => true, 'data' => [
            'username' => $user['username'],
            'email' => $user['email'],
            'firstName' => $user['first_name'],
            'lastName' => $user['last_name'],
            'role' => $user['role']
        ]]);
    } else {
        echo json_encode(['success' => false, 'error' => 'User not found']);
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['email'], $input['firstName'], $input['lastName'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
        exit;
    }
    $stmt = $pdo->prepare('UPDATE admin_users SET email = ?, first_name = ?, last_name = ? WHERE id = ?');
    $ok = $stmt->execute([
        $input['email'],
        $input['firstName'],
        $input['lastName'],
        $userId
    ]);
    if ($ok) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update profile']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
