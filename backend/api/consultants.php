<?php
require_once __DIR__ . '/../config/database.php';

// GET consultants (active admin_users with relevant roles)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->prepare('SELECT id, first_name, last_name, role FROM admin_users WHERE is_active = 1 AND role IN ("super_admin", "admin", "sales", "support") ORDER BY first_name, last_name');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $consultants = array_map(function ($row) {
            return [
                'id' => $row['id'],
                'name' => trim($row['first_name'] . ' ' . $row['last_name']),
                'role' => $row['role']
            ];
        }, $rows);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $consultants]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
