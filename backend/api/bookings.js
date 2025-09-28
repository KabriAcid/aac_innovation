
import express from 'express';
import pool from '../config/database.js';
import authMiddleware from '../middleware/auth.js';

const router = express.Router();

// GET bookings
router.get('/', authMiddleware, async (req, res, next) => {
  try {
    const [rows] = await pool.query('SELECT * FROM bookings ORDER BY created_at DESC LIMIT 50');
    res.json({ success: true, data: rows });
  } catch (err) {
    next(err);
  }
});

// GET booking by ID
router.get('/:id', authMiddleware, async (req, res, next) => {
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
router.post('/', authMiddleware, async (req, res, next) => {
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

// PUT booking status by ID
router.put('/:id', authMiddleware, async (req, res, next) => {
  try {
    const { id } = req.params;
    // Allowed enum values from schema
    const allowedStatus = ['pending','confirmed','rescheduled','cancelled','completed','no_show'];
    const allowedBookingType = ['consultation','demo','follow_up','technical_review'];
    // Only allow updating these fields
    const updatableFields = [
      'client_name', 'client_email', 'client_phone', 'company', 'service_id', 'consultant_id',
      'scheduled_date', 'scheduled_time', 'message', 'status', 'booking_type', 'duration_minutes',
      'meeting_link', 'meeting_notes', 'reminder_sent', 'confirmation_sent', 'calendar_event_id',
      'assigned_to'
    ];
    const updates = {};
    for (const key of updatableFields) {
      if (req.body[key] !== undefined) updates[key] = req.body[key];
    }
    // Validate enums
    if (updates.status && !allowedStatus.includes(updates.status)) {
      return res.status(400).json({ success: false, message: 'Invalid status value' });
    }
    if (updates.booking_type && !allowedBookingType.includes(updates.booking_type)) {
      return res.status(400).json({ success: false, message: 'Invalid booking_type value' });
    }
    // If nothing to update
    if (Object.keys(updates).length === 0) {
      return res.status(400).json({ success: false, message: 'No valid fields to update' });
    }
  // Set changed_by for booking_history trigger (must be a valid team_members.id or NULL)
  // Use provided changed_by or default to 'system'
  const changedBy = req.body.changed_by || 'system';
  await pool.query('SET @changed_by = ?', [changedBy]);
    // Build query
    const setClause = Object.keys(updates).map(f => `${f} = ?`).join(', ');
    const values = Object.values(updates);
    const [result] = await pool.query(
      `UPDATE bookings SET ${setClause}, updated_at = NOW() WHERE id = ?`,
      [...values, id]
    );
    if (result.affectedRows === 0) {
      return res.status(404).json({ success: false, message: 'Booking not found' });
    }
    res.json({ success: true, message: 'Booking updated' });
  } catch (err) {
    next(err);
  }
});

export default router;
