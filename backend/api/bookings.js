const express = require('express');
const router = express.Router();
const pool = require('../config/database');

// GET bookings
router.get('/', async (req, res, next) => {
  try {
    const [rows] = await pool.query('SELECT * FROM bookings ORDER BY created_at DESC LIMIT 50');
    res.json({ success: true, data: rows });
  } catch (err) {
    next(err);
  }
});

// POST booking
router.post('/', async (req, res, next) => {
  try {
    const data = req.body;
    // Basic validation
    if (!data.firstName || !data.lastName || !data.email || !data.phone || !data.serviceId || !data.preferredDate || !data.preferredTime || !data.consent) {
      return res.status(400).json({ success: false, message: 'Missing required fields' });
    }
    // Insert booking
    const [result] = await pool.query(
      `INSERT INTO bookings (client_name, client_email, client_phone, company, service_id, consultant_id, scheduled_date, scheduled_time, message, status, created_at)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())`,
      [`${data.firstName} ${data.lastName}`, data.email, data.phone, data.company || '', data.serviceId, data.consultantId || '', data.preferredDate, data.preferredTime, data.message || '']
    );
    res.json({ success: true, message: 'Booking submitted successfully', data: { id: result.insertId, status: 'pending' } });
  } catch (err) {
    next(err);
  }
});

module.exports = router;
