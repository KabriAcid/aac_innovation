
import express from 'express';
import pool from '../config/database.js';
import authMiddleware from '../middleware/auth.js';

const router = express.Router();


// List all active services
// List all active services, return raw DB rows
router.get('/', authMiddleware, async (req, res, next) => {
  try {
    const [rows] = await pool.query('SELECT * FROM services WHERE is_active = 1');
    res.json({ success: true, data: rows });
  } catch (err) {
    next(err);
  }
});

// Get a single service by ID
// Get a single service by ID, return raw DB row
router.get('/:id', authMiddleware, async (req, res, next) => {
  try {
    const [rows] = await pool.query('SELECT * FROM services WHERE id = ?', [req.params.id]);
    if (rows.length === 0) return res.status(404).json({ success: false, message: 'Service not found' });
    res.json({ success: true, data: rows[0] });
  } catch (err) {
    next(err);
  }
});

// Create a new service
router.post('/', authMiddleware, async (req, res, next) => {
  try {
    const { name, description, price, duration, category, active } = req.body;
    const [result] = await pool.query(
      'INSERT INTO services (name, description, price, duration, category, is_active) VALUES (?, ?, ?, ?, ?, ?)',
      [name, description, price, duration, category, active ? 1 : 0]
    );
    const [rows] = await pool.query('SELECT * FROM services WHERE id = ?', [result.insertId]);
    res.status(201).json({ success: true, data: rows[0] });
  } catch (err) {
    next(err);
  }
});

// Update a service
router.put('/:id', authMiddleware, async (req, res, next) => {
  try {
    const { name, description, price, duration, category, active } = req.body;
    const [result] = await pool.query(
      'UPDATE services SET name=?, description=?, price=?, duration=?, category=?, is_active=? WHERE id=?',
      [name, description, price, duration, category, active ? 1 : 0, req.params.id]
    );
    if (result.affectedRows === 0) return res.status(404).json({ success: false, message: 'Service not found' });
    const [rows] = await pool.query('SELECT * FROM services WHERE id = ?', [req.params.id]);
    res.json({ success: true, data: rows[0] });
  } catch (err) {
    next(err);
  }
});

// Delete a service
router.delete('/:id', authMiddleware, async (req, res, next) => {
  try {
    const [result] = await pool.query('DELETE FROM services WHERE id = ?', [req.params.id]);
    if (result.affectedRows === 0) return res.status(404).json({ success: false, message: 'Service not found' });
    res.json({ success: true });
  } catch (err) {
    next(err);
  }
});

export default router;