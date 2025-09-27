import express from 'express';
import pool from '../config/database.js';

const router = express.Router();

// GET /api/dashboard/kpis
router.get('/kpis', async (req, res) => {
  try {
    const [[{ total_bookings }]] = await pool.query('SELECT COUNT(*) AS total_bookings FROM bookings');
    const [[{ pending_bookings }]] = await pool.query("SELECT COUNT(*) AS pending_bookings FROM bookings WHERE status = 'pending'");
    const [[{ confirmed_bookings }]] = await pool.query("SELECT COUNT(*) AS confirmed_bookings FROM bookings WHERE status = 'confirmed'");
    const [[{ total_contacts }]] = await pool.query('SELECT COUNT(*) AS total_contacts FROM contacts');
    const [[{ total_services }]] = await pool.query('SELECT COUNT(*) AS total_services FROM services');
    res.json({
      success: true,
      data: {
        total_bookings,
        pending_bookings,
        confirmed_bookings,
        total_contacts,
        total_services,
      },
    });
  } catch (err) {
    res.status(500).json({ success: false, message: 'Server error', error: err.message });
  }
});

// GET /api/dashboard/recent-bookings
router.get('/recent-bookings', async (req, res) => {
  try {
    const [rows] = await pool.query(
      `SELECT b.id, b.client_name, b.client_email, b.scheduled_date, b.scheduled_time, b.status, s.title AS service_title
       FROM bookings b
       LEFT JOIN services s ON b.service_id = s.id
       ORDER BY b.created_at DESC
       LIMIT 8`
    );
    res.json({ success: true, data: rows });
  } catch (err) {
    res.status(500).json({ success: false, message: 'Server error', error: err.message });
  }
});

// GET /api/dashboard/recent-contacts
router.get('/recent-contacts', async (req, res) => {
  try {
    const [rows] = await pool.query(
      `SELECT id, first_name, last_name, email, company, service_interest, message, status, created_at
       FROM contacts
       ORDER BY created_at DESC
       LIMIT 8`
    );
    res.json({ success: true, data: rows });
  } catch (err) {
    res.status(500).json({ success: false, message: 'Server error', error: err.message });
  }
});

export default router;
