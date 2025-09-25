import express from 'express';
import pool from '../config/database.js';
import argon2 from 'argon2';
import jwt from 'jsonwebtoken';

const router = express.Router();

const JWT_SECRET = process.env.JWT_SECRET || 'changeme';
const JWT_EXPIRES_IN = '7d';

// POST /api/auth/login
router.post('/login', async (req, res) => {
  const { email, password } = req.body;
  if (!email || !password) {
    return res.status(400).json({ success: false, message: 'Email and password required.' });
  }
  try {
    const [rows] = await pool.query(
      'SELECT * FROM admin_users WHERE email = ? AND is_active = 1 LIMIT 1',
      [email]
    );
    if (!rows.length) {
      return res.status(401).json({ success: false, message: 'Invalid email or password.' });
    }
    const user = rows[0];
    const valid = await argon2.verify(user.password_hash, password);
    if (!valid) {
      return res.status(401).json({ success: false, message: 'Invalid email or password.' });
    }
    // Prepare user data for frontend
    const userData = {
      id: user.id,
      email: user.email,
      name: user.first_name + ' ' + user.last_name,
      role: user.role,
      lastLogin: user.last_login,
    };
    // Sign JWT
    const token = jwt.sign(
      { id: user.id, email: user.email, role: user.role },
      JWT_SECRET,
      { expiresIn: JWT_EXPIRES_IN }
    );
    // Update last_login
    await pool.query('UPDATE admin_users SET last_login = NOW() WHERE id = ?', [user.id]);
    res.json({ success: true, token, user: userData });
  } catch (err) {
    res.status(500).json({ success: false, message: 'Server error', error: err.message });
  }
});

export default router;
