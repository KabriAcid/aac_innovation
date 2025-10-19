<?php
session_start();

require_once __DIR__ . '/../config/database.php';

// GET /api/admin/profile - Get current admin user profile
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'profile') {
    try {
        $userId = $_GET['user_id']; // Assume user_id is passed as a query parameter
        $stmt = $pdo->prepare('SELECT id, username, email, first_name, last_name, role FROM admin_users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'User not found']);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $user]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

// PUT /api/admin/profile - Update profile details
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $_GET['action'] === 'profile') {
    try {
        $userId = $_GET['user_id']; // Assume user_id is passed as a query parameter
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('UPDATE admin_users SET email = ?, first_name = ?, last_name = ? WHERE id = ?');
        $stmt->execute([$data['email'], $data['firstName'], $data['lastName'], $userId]);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

// PUT /api/admin/profile/password - Change password
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $_GET['action'] === 'password') {
    try {
        $userId = $_GET['user_id']; // Assume user_id is passed as a query parameter
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('SELECT password_hash FROM admin_users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'User not found']);
            exit;
        }
        if (!password_verify($data['currentPassword'], $user['password_hash'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
            exit;
        }
        $newHash = password_hash($data['newPassword'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('UPDATE admin_users SET password_hash = ? WHERE id = ?');
        $stmt->execute([$newHash, $userId]);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
