
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

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === '') {
    // Get profile
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

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $action === 'profile') {
    // Update profile
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

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $action === 'password') {
    // Change password
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['currentPassword'], $input['newPassword'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
        exit;
    }
    $stmt = $pdo->prepare('SELECT password_hash FROM admin_users WHERE id = ? LIMIT 1');
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user || !password_verify($input['currentPassword'], $user['password_hash'])) {
        echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
        exit;
    }
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'add_admin') {
    // Add admin
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['username'], $input['email'], $input['firstName'], $input['lastName'], $input['role'], $input['password'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing fields']);
        exit;
    }
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
