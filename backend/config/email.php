<?php
/**
 * Email Configuration and Helper Functions
 */

require_once 'vendor/autoload.php'; // If using Composer for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mailer;
    
    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->configureMailer();
    }
    
    private function configureMailer() {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host       = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = $_ENV['SMTP_USER'] ?? '';
            $this->mailer->Password   = $_ENV['SMTP_PASS'] ?? '';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port       = $_ENV['SMTP_PORT'] ?? 587;
            
            // Default sender
            $this->mailer->setFrom(
                $_ENV['SMTP_USER'] ?? 'noreply@aacinnovation.com',
                $_ENV['APP_NAME'] ?? 'AAC Innovation'
            );
        } catch (Exception $e) {
            error_log("Mailer configuration error: " . $e->getMessage());
        }
    }
    
    public function sendContactNotification($data) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress('info@aacinnovation.com', 'AAC Innovation');
            
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'New Contact Form Submission';
            
            $body = $this->getContactEmailTemplate($data);
            $this->mailer->Body = $body;
            
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    }
    
    public function sendBookingConfirmation($data) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($data['email'], $data['firstName'] . ' ' . $data['lastName']);
            $this->mailer->addBCC('bookings@aacinnovation.com', 'AAC Innovation Bookings');
            
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Booking Confirmation - AAC Innovation';
            
            $body = $this->getBookingEmailTemplate($data);
            $this->mailer->Body = $body;
            
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Booking email failed: " . $e->getMessage());
            return false;
        }
    }
    
    private function getContactEmailTemplate($data) {
        return "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #2563eb; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background: #f9f9f9; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #2563eb; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Contact Form Submission</h2>
                </div>
                <div class='content'>
                    <div class='field'>
                        <div class='label'>Name:</div>
                        <div>{$data['firstName']} {$data['lastName']}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Email:</div>
                        <div>{$data['email']}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Phone:</div>
                        <div>{$data['phone']}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Company:</div>
                        <div>{$data['company']}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Service Interest:</div>
                        <div>{$data['serviceInterest']}</div>
                    </div>
                    <div class='field'>
                        <div class='label'>Message:</div>
                        <div>{$data['message']}</div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    }
    
    private function getBookingEmailTemplate($data) {
        return "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #2563eb; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                .booking-details { background: #f0f7ff; padding: 15px; border-radius: 8px; margin: 20px 0; }
                .field { margin-bottom: 10px; }
                .label { font-weight: bold; color: #2563eb; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Booking Confirmation</h2>
                    <p>Thank you for scheduling a consultation with AAC Innovation</p>
                </div>
                <div class='content'>
                    <p>Dear {$data['firstName']},</p>
                    <p>We have received your booking request and will confirm your appointment within 2 hours.</p>
                    
                    <div class='booking-details'>
                        <h3>Booking Details:</h3>
                        <div class='field'>
                            <span class='label'>Service:</span> {$data['serviceId']}
                        </div>
                        <div class='field'>
                            <span class='label'>Preferred Date:</span> {$data['preferredDate']}
                        </div>
                        <div class='field'>
                            <span class='label'>Preferred Time:</span> {$data['preferredTime']}
                        </div>
                        <div class='field'>
                            <span class='label'>Contact:</span> {$data['email']} | {$data['phone']}
                        </div>
                    </div>
                    
                    <p>If you need to make any changes or have questions, please contact us at info@aacinnovation.com or +234 123 456 7890.</p>
                    
                    <p>Best regards,<br>The AAC Innovation Team</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}

// Simple email function for basic PHP setups (without PHPMailer)
function sendSimpleEmail($to, $subject, $message, $headers = '') {
    if (empty($headers)) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: AAC Innovation <noreply@aacinnovation.com>' . "\r\n";
    }
    
    return mail($to, $subject, $message, $headers);
}
?>