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
