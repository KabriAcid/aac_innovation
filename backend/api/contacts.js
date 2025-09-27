// GET all contacts
router.get('/', async (req, res, next) => {
  try {
    const [rows] = await pool.query('SELECT * FROM contacts ORDER BY created_at DESC LIMIT 100');
    res.json({ success: true, data: rows });
  } catch (err) {
    next(err);
  }
});

// GET contact by ID
router.get('/:id', async (req, res, next) => {
  try {
    const { id } = req.params;
    const [rows] = await pool.query('SELECT * FROM contacts WHERE id = ? LIMIT 1', [id]);
    if (!rows.length) {
      return res.status(404).json({ success: false, message: 'Contact not found' });
    }
    res.json({ success: true, data: rows[0] });
  } catch (err) {
    next(err);
  }
});

// PUT update contact status by ID
router.put('/:id', async (req, res, next) => {
  try {
    const { id } = req.params;
    const allowedStatus = ['new','in-progress','replied','closed'];
    const updates = {};
    if (req.body.status && allowedStatus.includes(req.body.status)) {
      updates.status = req.body.status;
    }
    // Only allow updating status for now
    if (Object.keys(updates).length === 0) {
      return res.status(400).json({ success: false, message: 'No valid fields to update' });
    }
    const setClause = Object.keys(updates).map(f => `${f} = ?`).join(', ');
    const values = Object.values(updates);
    const [result] = await pool.query(
      `UPDATE contacts SET ${setClause}, updated_at = NOW() WHERE id = ?`,
      [...values, id]
    );
    if (result.affectedRows === 0) {
      return res.status(404).json({ success: false, message: 'Contact not found' });
    }
    res.json({ success: true, message: 'Contact updated' });
  } catch (err) {
    next(err);
  }
});
import express from 'express';
import pool from '../config/database.js';

const router = express.Router();

// POST contact form
router.post('/', async (req, res, next) => {
  try {
    const data = req.body;
    // Basic validation
    if (!data.firstName || !data.lastName || !data.email || !data.message || !data.consent) {
      return res.status(400).json({ success: false, message: 'Missing required fields' });
    }
    // Insert contact
    const [result] = await pool.query(
      `INSERT INTO contacts (first_name, last_name, email, phone, company, service_interest, message, consent, status, created_at)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'new', NOW())`,
      [data.firstName, data.lastName, data.email, data.phone || '', data.company || '', data.serviceInterest || '', data.message, data.consent ? 1 : 0]
    );
    // Log contact body (for demonstration)
    console.log('Contact form submitted:', data);
    res.json({ success: true, message: 'Contact form submitted successfully', data: { id: result.insertId, status: 'new' } });
  } catch (err) {
    next(err);
  }
});

export default router;
