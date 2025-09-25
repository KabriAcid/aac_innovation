import express from 'express';
import pool from '../config/database.js';

const router = express.Router();

router.get('/', async (req, res, next) => {
  try {
    // Fetch all columns for all active services
    const [rows] = await pool.query('SELECT * FROM services WHERE is_active = 1');
    res.json({ success: true, data: rows });
  } catch (err) {
    next(err);
  }
});

export default router;