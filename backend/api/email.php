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

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port = SMTP_PORT;

        $mail->setFrom(SMTP_USER, 'AAC Innovation');
        $mail->addAddress($data['to']);
        $mail->Subject = $data['subject'];
        $mail->Body = $data['message'];
        $mail->isHTML(true);

        $mail->send();

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Email could not be sent', 'error' => $mail->ErrorInfo]);
    }
}
