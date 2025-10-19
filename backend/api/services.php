<?php

require_once __DIR__ . '/../config/database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// GET all active services
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
    try {
        $stmt = $pdo->query('SELECT * FROM services WHERE is_active = 1');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Parse features as JSON arrays if needed
        foreach ($rows as &$row) {
            if (isset($row['features']) && is_string($row['features'])) {
                $decoded = json_decode($row['features'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $row['features'] = $decoded;
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $rows]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// GET a single service by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM services WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Service not found']);
            exit;
        }
        // Parse features as JSON array if needed
        if (isset($row['features']) && is_string($row['features'])) {
            $decoded = json_decode($row['features'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $row['features'] = $decoded;
            }
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $row]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// POST create a new service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        // Generate a unique id if not provided
        $id = $data['id'] ?? uniqid();
        $stmt = $pdo->prepare(
            'INSERT INTO services (id, title, description, icon, category, features, pricing_model, pricing_starting_price, pricing_description, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $id,
            $data['title'],
            $data['description'],
            $data['icon'],
            $data['category'],
            json_encode($data['features'] ?? []),
            $data['pricing_model'] ?? null,
            $data['pricing_starting_price'] ?? null,
            $data['pricing_description'] ?? null,
            $data['active'] ? 1 : 0,
            $data['sort_order'] ?? 0
        ]);
        $stmt = $pdo->prepare('SELECT * FROM services WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $row]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// PUT update a service
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare(
            'UPDATE services SET title = ?, description = ?, icon = ?, category = ?, features = ?, pricing_model = ?, pricing_starting_price = ?, pricing_description = ?, is_active = ?, sort_order = ? WHERE id = ?'
        );
        $stmt->execute([
            $data['title'],
            $data['description'],
            $data['icon'],
            $data['category'],
            json_encode($data['features'] ?? []),
            $data['pricing_model'] ?? null,
            $data['pricing_starting_price'] ?? null,
            $data['pricing_description'] ?? null,
            $data['active'] ? 1 : 0,
            $data['sort_order'] ?? 0,
            $id
        ]);
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Service not found']);
            exit;
        }
        $stmt = $pdo->prepare('SELECT * FROM services WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $row]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// DELETE a service
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $stmt = $pdo->prepare('DELETE FROM services WHERE id = ?');
        $stmt->execute([$id]);
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Service not found']);
            exit;
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
