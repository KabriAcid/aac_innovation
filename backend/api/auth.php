<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/jwt.php';
require_once __DIR__ . '/../config/cors.php';

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// POST /api/auth/login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'login') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (!$email || !$password) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Email and password required.']);
            exit;
        }

        $stmt = $pdo->prepare('SELECT * FROM admin_users WHERE email = ? AND is_active = 1 LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
            exit;
        }

        $token = jwt_encode(['id' => $user['id'], 'email' => $user['email'], 'role' => $user['role']], JWT_SECRET);

        $stmt = $pdo->prepare('UPDATE admin_users SET last_login = NOW() WHERE id = ?');
        $stmt->execute([$user['id']]);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'token' => $token, 'user' => [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['first_name'] . ' ' . $user['last_name'],
            'role' => $user['role'],
            'lastLogin' => $user['last_login'],
        ]]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
    }
}

// POST /api/auth/register
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'register') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $firstName = $data['first_name'] ?? '';
        $lastName = $data['last_name'] ?? '';
        $role = $data['role'] ?? 'user';

        if (!$email || !$password || !$firstName || !$lastName) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        $stmt = $pdo->prepare('SELECT id FROM admin_users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            http_response_code(409);
            echo json_encode(['success' => false, 'message' => 'Email already registered.']);
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $username = explode('@', $email)[0];

        $stmt = $pdo->prepare('INSERT INTO admin_users (username, email, password_hash, first_name, last_name, role, is_active, created_at) VALUES (?, ?, ?, ?, ?, ?, 1, NOW())');
        $stmt->execute([$username, $email, $passwordHash, $firstName, $lastName, $role]);

        http_response_code(201);
        echo json_encode(['success' => true, 'message' => 'User registered successfully.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
    }
}
