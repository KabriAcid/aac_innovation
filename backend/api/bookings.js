import express from 'express';
import pool from '../config/database.js';

const router = express.Router();

// GET bookings
router.get('/', async (req, res, next) => {
  try {
    const [rows] = await pool.query('SELECT * FROM bookings ORDER BY created_at DESC LIMIT 50');
    res.json({ success: true, data: rows });
  } catch (err) {
    next(err);
  }
});

// GET booking by ID
router.get('/:id', async (req, res, next) => {
  try {
    const { id } = req.params;
    const [rows] = await pool.query(
      `SELECT b.*, s.title AS service_title
       FROM bookings b
       LEFT JOIN services s ON b.service_id = s.id
       WHERE b.id = ?
       LIMIT 1`,
      [id]
    );
    if (!rows.length) {
      return res.status(404).json({ success: false, message: 'Booking not found' });
    }
    res.json({ success: true, data: rows[0] });
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

export default router;
