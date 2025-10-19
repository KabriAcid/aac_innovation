<?php
require_once '../config/database.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

$userId = $_SESSION['user']['id'];


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['currentPassword'], $input['newPassword'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
        exit;
    }
    // Fetch current password hash
    $stmt = $pdo->prepare('SELECT password_hash FROM admin_users WHERE id = ? LIMIT 1');
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user || !password_verify($input['currentPassword'], $user['password_hash'])) {
        echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
        exit;
    }
    // Update password
    $newHash = password_hash($input['newPassword'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('UPDATE admin_users SET password_hash = ? WHERE id = ?');
    $ok = $stmt->execute([$newHash, $userId]);
    if ($ok) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to change password']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
