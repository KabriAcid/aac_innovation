import express from 'express';
import pool from '../config/database.js';
const router = express.Router();

// GET /api/settings/company
router.get('/company', async (req, res) => {
  try {
    const [rows] = await pool.query(
      "SELECT setting_key, setting_value FROM system_settings WHERE category = 'company' AND is_public = 1"
    );
    const settings = {};
    rows.forEach(row => {
      if (row.setting_key === 'company_name') settings.name = row.setting_value;
      if (row.setting_key === 'company_email') settings.email = row.setting_value;
      if (row.setting_key === 'company_phone') settings.phone = row.setting_value;
      if (row.setting_key === 'company_address') settings.address = row.setting_value;
      if (row.setting_key === 'company_tagline') settings.tagline = row.setting_value;
      // Add more keys as needed
    });
    res.json({ success: true, data: settings });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

export default router;
