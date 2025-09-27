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
    const mailOptions = {
      from: smtp.smtp_user,
      to,
      subject,
      html: `<div style="font-family:sans-serif;">${message.replace(/\n/g, '<br>')}</div>`
    };
    await transporter.sendMail(mailOptions);
    res.json({ success: true, message: 'Email sent successfully' });
  } catch (err) {
    next(err);
  }
});

export default router;
