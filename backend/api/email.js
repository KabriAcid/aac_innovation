import express from 'express';
import pool from '../config/database.js';
import nodemailer from 'nodemailer';

const router = express.Router();

// Helper to get SMTP settings from DB
async function getSmtpSettings() {
  const [rows] = await pool.query(
    `SELECT setting_key, setting_value FROM system_settings WHERE setting_key IN ('smtp_host','smtp_port','smtp_secure','smtp_user','smtp_pass')`
  );
  const settings = {};
  for (const row of rows) {
    settings[row.setting_key] = row.setting_value;
  }
  return settings;
}

// POST /api/email/send
router.post('/send', async (req, res, next) => {
  try {
    const { to, subject, message } = req.body;
    if (!to || !subject || !message) {
      return res.status(400).json({ success: false, message: 'Missing required fields' });
    }
    const smtp = await getSmtpSettings();
    if (!smtp.smtp_host || !smtp.smtp_port || !smtp.smtp_user || !smtp.smtp_pass) {
      return res.status(500).json({ success: false, message: 'SMTP settings are not configured' });
    }
    const transporter = nodemailer.createTransport({
      host: smtp.smtp_host,
      port: Number(smtp.smtp_port),
      secure: smtp.smtp_secure === 'true' || smtp.smtp_port === '465',
      auth: {
        user: smtp.smtp_user,
        pass: smtp.smtp_pass,
      },
    });
    // Compose a formal, professional HTML email body
    const htmlBody = `
      <div style="background:#f6f8fa;padding:32px 0;min-height:100vh;">
        <table style="max-width:520px;margin:0 auto;background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.04);overflow:hidden;font-family:Inter,Arial,sans-serif;">
          <tr>
            <td style="padding:32px 32px 0 32px;text-align:left;">
              <img src='https://aacinnovation.com/logo192.png' alt='AAC Innovation' style='height:40px;margin-bottom:16px;border-radius:8px;' />
              <h2 style="margin:0 0 16px 0;font-size:1.25rem;color:#1a237e;font-weight:700;">AAC Innovation</h2>
              <div style="height:1px;background:#e5e7eb;margin:16px 0;"></div>
              <p style="font-size:1rem;color:#222;margin:0 0 16px 0;">Hi,</p>
              <div style="font-size:1rem;color:#222;line-height:1.7;">${message.replace(/\n/g, '<br>')}</div>
              <p style="margin:32px 0 0 0;font-size:1rem;color:#222;">Best regards,<br><span style="font-weight:600;">AAC Innovation Team</span></p>
            </td>
          </tr>
          <tr>
            <td style="padding:24px 32px 24px 32px;text-align:center;background:#f6f8fa;font-size:0.85rem;color:#888;">
              AAC Innovation, Abuja, Nigeria &bull; <a href="mailto:info@aacinnovation.com" style="color:#1a237e;text-decoration:underline;">info@aacinnovation.com</a>
            </td>
          </tr>
        </table>
      </div>
    `;
    const mailOptions = {
      from: smtp.smtp_user,
      to,
      subject,
      html: htmlBody
    };
    await transporter.sendMail(mailOptions);
    res.json({ success: true, message: 'Email sent successfully' });
  } catch (err) {
    next(err);
  }
});

export default router;
