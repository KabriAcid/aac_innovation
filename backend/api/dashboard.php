<?php

require_once __DIR__ . '/../config/database.php';

// GET /api/dashboard/kpis
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'kpis') {
    try {
        $stmt = $pdo->query('SELECT COUNT(*) AS total_bookings FROM bookings');
        $totalBookings = $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) AS pending_bookings FROM bookings WHERE status = 'pending'");
        $pendingBookings = $stmt->fetchColumn();

        $stmt = $pdo->query("SELECT COUNT(*) AS confirmed_bookings FROM bookings WHERE status = 'confirmed'");
        $confirmedBookings = $stmt->fetchColumn();

        $stmt = $pdo->query('SELECT COUNT(*) AS total_contacts FROM contacts');
        $totalContacts = $stmt->fetchColumn();

        $stmt = $pdo->query('SELECT COUNT(*) AS total_services FROM services');
        $totalServices = $stmt->fetchColumn();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => [
                'total_bookings' => $totalBookings,
                'pending_bookings' => $pendingBookings,
                'confirmed_bookings' => $confirmedBookings,
                'total_contacts' => $totalContacts,
                'total_services' => $totalServices,
            ],
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// GET /api/dashboard/recent-bookings
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'recent-bookings') {
    try {
        $stmt = $pdo->query(
            'SELECT b.id, b.client_name, b.client_email, b.scheduled_date, b.scheduled_time, b.status, s.title AS service_title
             FROM bookings b
             LEFT JOIN services s ON b.service_id = s.id
             ORDER BY b.created_at DESC
             LIMIT 8'
        );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $rows]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// GET /api/dashboard/recent-contacts
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'recent-contacts') {
    try {
        $stmt = $pdo->query(
            'SELECT id, first_name, last_name, email, company, service_interest, message, status, created_at
             FROM contacts
             ORDER BY created_at DESC
             LIMIT 8'
        );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $rows]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
