<?php
session_start();

require_once __DIR__ . '/../config/database.php';

// GET /api/settings
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->query(
            "SELECT setting_key, setting_value FROM system_settings WHERE is_public = 1 OR category IN ('company','social','smtp')"
        );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $settings = [
            'companyName' => '',
            'companyEmail' => '',
            'companyPhone' => '',
            'companyAddress' => '',
            'websiteUrl' => '',
            'socialMedia' => [
                'facebook' => '',
                'twitter' => '',
                'linkedin' => '',
                'instagram' => ''
            ],
            'emailSettings' => [
                'smtpHost' => '',
                'smtpPort' => '',
                'smtpUser' => '',
                'smtpPassword' => ''
            ]
        ];

        foreach ($rows as $row) {
            switch ($row['setting_key']) {
                case 'company_name':
                    $settings['companyName'] = $row['setting_value'];
                    break;
                case 'company_email':
                    $settings['companyEmail'] = $row['setting_value'];
                    break;
                case 'company_phone':
                    $settings['companyPhone'] = $row['setting_value'];
                    break;
                case 'company_address':
                    $settings['companyAddress'] = $row['setting_value'];
                    break;
                case 'website_url':
                    $settings['websiteUrl'] = $row['setting_value'];
                    break;
                case 'facebook':
                    $settings['socialMedia']['facebook'] = $row['setting_value'];
                    break;
                case 'twitter':
                    $settings['socialMedia']['twitter'] = $row['setting_value'];
                    break;
                case 'linkedin':
                    $settings['socialMedia']['linkedin'] = $row['setting_value'];
                    break;
                case 'instagram':
                    $settings['socialMedia']['instagram'] = $row['setting_value'];
                    break;
                case 'smtp_host':
                    $settings['emailSettings']['smtpHost'] = $row['setting_value'];
                    break;
                case 'smtp_port':
                    $settings['emailSettings']['smtpPort'] = $row['setting_value'];
                    break;
                case 'smtp_user':
                    $settings['emailSettings']['smtpUser'] = $row['setting_value'];
                    break;
                case 'smtp_password':
                    $settings['emailSettings']['smtpPassword'] = $row['setting_value'];
                    break;
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $settings]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

// PUT /api/settings
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);

        $updates = [
            ['key' => 'company_name', 'value' => $data['companyName'] ?? null],
            ['key' => 'company_email', 'value' => $data['companyEmail'] ?? null],
            ['key' => 'company_phone', 'value' => $data['companyPhone'] ?? null],
            ['key' => 'company_address', 'value' => $data['companyAddress'] ?? null],
            ['key' => 'website_url', 'value' => $data['websiteUrl'] ?? null],
            ['key' => 'facebook', 'value' => $data['socialMedia']['facebook'] ?? null],
            ['key' => 'twitter', 'value' => $data['socialMedia']['twitter'] ?? null],
            ['key' => 'linkedin', 'value' => $data['socialMedia']['linkedin'] ?? null],
            ['key' => 'instagram', 'value' => $data['socialMedia']['instagram'] ?? null],
            ['key' => 'smtp_host', 'value' => $data['emailSettings']['smtpHost'] ?? null],
            ['key' => 'smtp_port', 'value' => $data['emailSettings']['smtpPort'] ?? null],
            ['key' => 'smtp_user', 'value' => $data['emailSettings']['smtpUser'] ?? null],
            ['key' => 'smtp_password', 'value' => $data['emailSettings']['smtpPassword'] ?? null]
        ];

        foreach ($updates as $update) {
            if ($update['value'] !== null) {
                $stmt = $pdo->prepare(
                    'INSERT INTO system_settings (setting_key, setting_value, is_public) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
                );
                $stmt->execute([$update['key'], $update['value']]);
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
