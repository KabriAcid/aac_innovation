
import express from 'express';
import pool from '../config/database.js';
import authMiddleware from '../middleware/auth.js';
const router = express.Router();


// GET /api/settings
router.get('/', authMiddleware, async (req, res) => {
  try {
    const [rows] = await pool.query(
      "SELECT setting_key, setting_value FROM system_settings WHERE is_public = 1 OR category IN ('company','social','smtp')"
    );
    // Map DB keys to frontend structure
    const settings = {
      companyName: '',
      companyEmail: '',
      companyPhone: '',
      companyAddress: '',
      websiteUrl: '',
      socialMedia: {
        facebook: '',
        twitter: '',
        linkedin: '',
        instagram: ''
      },
      emailSettings: {
        smtpHost: '',
        smtpPort: '',
        smtpUser: '',
        smtpPassword: ''
      }
    };
    rows.forEach(row => {
      switch (row.setting_key) {
        case 'company_name': settings.companyName = row.setting_value; break;
        case 'company_email': settings.companyEmail = row.setting_value; break;
        case 'company_phone': settings.companyPhone = row.setting_value; break;
        case 'company_address': settings.companyAddress = row.setting_value; break;
        case 'website_url': settings.websiteUrl = row.setting_value; break;
        case 'facebook': settings.socialMedia.facebook = row.setting_value; break;
        case 'twitter': settings.socialMedia.twitter = row.setting_value; break;
        case 'linkedin': settings.socialMedia.linkedin = row.setting_value; break;
        case 'instagram': settings.socialMedia.instagram = row.setting_value; break;
        case 'smtp_host': settings.emailSettings.smtpHost = row.setting_value; break;
        case 'smtp_port': settings.emailSettings.smtpPort = row.setting_value; break;
        case 'smtp_user': settings.emailSettings.smtpUser = row.setting_value; break;
        case 'smtp_password': settings.emailSettings.smtpPassword = row.setting_value; break;
        default: break;
      }
    });
    res.json({ success: true, data: settings });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// PUT /api/settings
router.put('/', authMiddleware, async (req, res) => {
  const {
    companyName,
    companyEmail,
    companyPhone,
    companyAddress,
    websiteUrl,
    socialMedia = {},
    emailSettings = {}
  } = req.body;

  // Map frontend fields to DB keys
  const updates = [
    { key: 'company_name', value: companyName },
    { key: 'company_email', value: companyEmail },
    { key: 'company_phone', value: companyPhone },
    { key: 'company_address', value: companyAddress },
    { key: 'website_url', value: websiteUrl },
    { key: 'facebook', value: socialMedia.facebook },
    { key: 'twitter', value: socialMedia.twitter },
    { key: 'linkedin', value: socialMedia.linkedin },
    { key: 'instagram', value: socialMedia.instagram },
    { key: 'smtp_host', value: emailSettings.smtpHost },
    { key: 'smtp_port', value: emailSettings.smtpPort },
    { key: 'smtp_user', value: emailSettings.smtpUser },
    { key: 'smtp_password', value: emailSettings.smtpPassword }
  ];

  try {
    for (const { key, value } of updates) {
      if (typeof value !== 'undefined') {
        await pool.query(
          'INSERT INTO system_settings (setting_key, setting_value, is_public) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)',
          [key, value]
        );
      }
    }
    res.json({ success: true });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

export default router;
