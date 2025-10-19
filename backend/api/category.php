<?php
require_once __DIR__ . '/../config/database.php';
header('Content-Type: application/json');
try {
    $stmt = $pdo->query('SELECT DISTINCT category FROM services WHERE category IS NOT NULL AND category != ""');
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(['success' => true, 'data' => $rows]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
