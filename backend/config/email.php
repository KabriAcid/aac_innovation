<?php

/**
 * Email Configuration and Helper Functions (Procedural Approach)
 * 
 * Handles email notifications using simple PHP mail() function
 * Compatible with AAC Innovation database and PDO setup
 */

// Prevent direct access
if (!defined('AAC_BACKEND')) {
    define('AAC_BACKEND', true);
}

// Email configuration
$email_config = [
    'from_email' => 'noreply@aacinnovation.com',
    'from_name' => 'AAC Innovation',
    'admin_email' => 'aacinovations43@gmail.com',
    'admin_name' => 'AAC Innovation Admin'
];

/**
 * Simple EmailService class for API compatibility
 */
class EmailService
{
    public function sendContactNotification($data)
    {
        return sendContactEmail($data);
    }

    public function sendBookingConfirmation($data)
    {
        return sendBookingEmail($data);
    }
}

/**
 * Send contact form notification
 * 
 * @param array $data Contact form data
 * @return bool Success status
 */
function sendContactEmail($data)
{
    global $email_config;

    try {
        // Send notification to admin
        $subject = 'New Contact Form Submission - AAC Innovation';
        $message = getContactEmailTemplate($data);
        $headers = getEmailHeaders($email_config['from_email'], $email_config['from_name']);

        $emailSent = mail($email_config['admin_email'], $subject, $message, $headers);

        // Log email attempt
        logEmailActivity('contact_notification', $email_config['admin_email'], $emailSent ? 'sent' : 'failed');

        return $emailSent;
    } catch (Exception $e) {
        error_log('Contact Email Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send booking confirmation email
 * 
 * @param array $data Booking data
 * @return bool Success status
 */
function sendBookingEmail($data)
{
    global $email_config;

    try {
        // Send confirmation to client
        $subject = 'Booking Confirmation - AAC Innovation';
        $message = getBookingEmailTemplate($data);
        $headers = getEmailHeaders($email_config['from_email'], $email_config['from_name']);

        $clientEmail = $data['email'];
        $clientEmailSent = mail($clientEmail, $subject, $message, $headers);

        // Send notification to admin
        $adminSubject = 'New Booking Request - AAC Innovation';
        $adminMessage = getAdminBookingEmailTemplate($data);
        $adminEmailSent = mail($email_config['admin_email'], $adminSubject, $adminMessage, $headers);

        // Log email attempts
        logEmailActivity('booking_confirmation', $clientEmail, $clientEmailSent ? 'sent' : 'failed');
        logEmailActivity('booking_notification', $email_config['admin_email'], $adminEmailSent ? 'sent' : 'failed');

        return $clientEmailSent && $adminEmailSent;
    } catch (Exception $e) {
        error_log('Booking Email Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Get email headers
 * 
 * @param string $fromEmail
 * @param string $fromName
 * @return string Headers
 */
function getEmailHeaders($fromEmail, $fromName)
{
    $headers = [];
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=UTF-8";
    $headers[] = "From: {$fromName} <{$fromEmail}>";
    $headers[] = "Reply-To: {$fromEmail}";
    $headers[] = "X-Mailer: PHP/" . phpversion();

    return implode("\r\n", $headers);
}

/**
 * Get contact form email template
 * 
 * @param array $data Contact data
 * @return string HTML email content
 */
function getContactEmailTemplate($data)
{
    $name = $data['firstName'] . ' ' . $data['lastName'];
    $phone = isset($data['phone']) ? $data['phone'] : 'Not provided';
    $company = isset($data['company']) ? $data['company'] : 'Not specified';
    $serviceInterest = isset($data['serviceInterest']) ? $data['serviceInterest'] : 'General Inquiry';

    return "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #007bff; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background: #f9f9f9; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #007bff; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>📨 New Contact Form Submission</h2>
                <p>AAC Innovation Website</p>
            </div>
            <div class='content'>
                <div class='field'>
                    <div class='label'>Name:</div>
                    <div>{$name}</div>
                </div>
                <div class='field'>
                    <div class='label'>Email:</div>
                    <div><a href='mailto:{$data['email']}'>{$data['email']}</a></div>
                </div>
                <div class='field'>
                    <div class='label'>Phone:</div>
                    <div>{$phone}</div>
                </div>
                <div class='field'>
                    <div class='label'>Company:</div>
                    <div>{$company}</div>
                </div>
                <div class='field'>
                    <div class='label'>Service Interest:</div>
                    <div>{$serviceInterest}</div>
                </div>
                <div class='field'>
                    <div class='label'>Message:</div>
                    <div style='background: white; padding: 15px; border-radius: 5px;'>{$data['message']}</div>
                </div>
                <div class='field'>
                    <div class='label'>Submitted:</div>
                    <div>" . date('Y-m-d H:i:s') . "</div>
                </div>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Get booking confirmation email template
 * 
 * @param array $data Booking data
 * @return string HTML email content
 */
function getBookingEmailTemplate($data)
{
    $name = $data['firstName'] . ' ' . $data['lastName'];
    $company = isset($data['company']) ? $data['company'] : 'Not specified';
    $message = isset($data['message']) ? $data['message'] : '';

    return "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #17a2b8; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .booking-details { background: #f0f7ff; padding: 15px; border-radius: 8px; margin: 20px 0; }
            .field { margin-bottom: 10px; }
            .label { font-weight: bold; color: #17a2b8; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>📅 Booking Confirmation</h2>
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
                    <div class='field'>
                        <span class='label'>Company:</span> {$company}
                    </div>
                </div>" .
        ($message ? "
                <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                    <h3>Your Message:</h3>
                    <p>{$message}</p>
                </div>" : "") . "
                
                <p><strong>What happens next:</strong></p>
                <ul>
                    <li>We'll call you at the scheduled time</li>
                    <li>The consultation will last 30-60 minutes</li>
                    <li>Please prepare any relevant questions</li>
                    <li>We'll provide a detailed proposal after</li>
                </ul>
                
                <p>If you need to make changes, please contact us at aacinovations43@gmail.com or 0707 653 6019.</p>
                
                <p>Best regards,<br>The AAC Innovation Team</p>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Get admin booking notification template
 * 
 * @param array $data Booking data
 * @return string HTML email content
 */
function getAdminBookingEmailTemplate($data)
{
    $name = $data['firstName'] . ' ' . $data['lastName'];
    $company = isset($data['company']) ? $data['company'] : 'Not specified';
    $consultantId = isset($data['consultantId']) ? $data['consultantId'] : 'Any available';
    $message = isset($data['message']) ? $data['message'] : 'No additional message';

    return "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #dc3545; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background: #f9f9f9; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #dc3545; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>📅 New Booking Request</h2>
                <p>AAC Innovation Website</p>
            </div>
            <div class='content'>
                <div class='field'>
                    <div class='label'>Client:</div>
                    <div>{$name}</div>
                </div>
                <div class='field'>
                    <div class='label'>Email:</div>
                    <div><a href='mailto:{$data['email']}'>{$data['email']}</a></div>
                </div>
                <div class='field'>
                    <div class='label'>Phone:</div>
                    <div>{$data['phone']}</div>
                </div>
                <div class='field'>
                    <div class='label'>Company:</div>
                    <div>{$company}</div>
                </div>
                <div class='field'>
                    <div class='label'>Service:</div>
                    <div>{$data['serviceId']}</div>
                </div>
                <div class='field'>
                    <div class='label'>Preferred Date & Time:</div>
                    <div>{$data['preferredDate']} at {$data['preferredTime']}</div>
                </div>
                <div class='field'>
                    <div class='label'>Consultant Requested:</div>
                    <div>{$consultantId}</div>
                </div>
                <div class='field'>
                    <div class='label'>Message:</div>
                    <div style='background: white; padding: 15px; border-radius: 5px;'>{$message}</div>
                </div>
                <div class='field'>
                    <div class='label'>Submitted:</div>
                    <div>" . date('Y-m-d H:i:s') . "</div>
                </div>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Log email activity to database
 * 
 * @param string $type Email type
 * @param string $recipient Recipient email
 * @param string $status Status (sent/failed)
 */
function logEmailActivity($type, $recipient, $status)
{
    try {
        require_once __DIR__ . '/database.php';

        $sql = "INSERT INTO email_logs (recipient_email, email_type, status, sent_at) VALUES (?, ?, ?, NOW())";
        executeQuery($sql, [$recipient, $type, $status]);
    } catch (Exception $e) {
        error_log('Email Log Error: ' . $e->getMessage());
    }
}
