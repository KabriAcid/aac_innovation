<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/smtp.php'; // Assume SMTP settings are defined here
require_once __DIR__ . '/../vendor/autoload.php'; // For PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// POST /api/email/send
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'send') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['to'], $data['subject'], $data['message'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }

        // Fetch SMTP settings from system_settings table
        $smtpSettings = [
            'host' => '',
            'port' => '',
            'user' => '',
            'password' => '',
            'secure' => 'tls'
        ];
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM system_settings WHERE setting_key IN ('smtp_host','smtp_port','smtp_user','smtp_password','smtp_secure')");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            switch ($row['setting_key']) {
                case 'smtp_host':
                    $smtpSettings['host'] = $row['setting_value'];
                    break;
                case 'smtp_port':
                    $smtpSettings['port'] = $row['setting_value'];
                    break;
                case 'smtp_user':
                    $smtpSettings['user'] = $row['setting_value'];
                    break;
                case 'smtp_password':
                    $smtpSettings['password'] = $row['setting_value'];
                    break;
                case 'smtp_secure':
                    $smtpSettings['secure'] = $row['setting_value'];
                    break;
            }
        }
        if (!$smtpSettings['host'] || !$smtpSettings['port'] || !$smtpSettings['user'] || !$smtpSettings['password']) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'SMTP settings are not configured']);
            exit;
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtpSettings['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $smtpSettings['user'];
        $mail->Password = $smtpSettings['password'];
        $mail->SMTPSecure = $smtpSettings['secure'];
        $mail->Port = $smtpSettings['port'];

        $mail->setFrom($smtpSettings['user'], 'AAC Innovation');
        $mail->addAddress($data['to']);
        $mail->Subject = $data['subject'];
        $mail->Body = $data['message'];
        $mail->isHTML(true);

        $mail->send();

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Email could not be sent', 'error' => isset($mail) ? $mail->ErrorInfo : $e->getMessage()]);
    }
}
