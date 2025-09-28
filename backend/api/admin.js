import express from 'express';
import pool from '../config/database.js';
import argon2 from 'argon2';
import authMiddleware from '../middleware/auth.js';

const router = express.Router();

// GET /api/admin/profile - Get current admin user profile (assumes req.user.id is set)
router.get('/profile', authMiddleware, async (req, res) => {
  try {
    const [rows] = await pool.query(
      'SELECT id, username, email, first_name, last_name, role FROM admin_users WHERE id = ?',
      [req.user.id]
    );
    if (!rows.length) return res.status(404).json({ success: false, error: 'User not found' });
    const user = rows[0];
    res.json({ success: true, data: {
      id: user.id,
      username: user.username,
      email: user.email,
      firstName: user.first_name,
      lastName: user.last_name,
      role: user.role
    }});
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// PUT /api/admin/profile - Update profile details (email, first/last name)
router.put('/profile', authMiddleware, async (req, res) => {
  const { email, firstName, lastName } = req.body;
  try {
    await pool.query(
      'UPDATE admin_users SET email = ?, first_name = ?, last_name = ? WHERE id = ?',
      [email, firstName, lastName, req.user.id]
    );
    res.json({ success: true });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

// PUT /api/admin/profile/password - Change password
router.put('/profile/password', authMiddleware, async (req, res) => {
  const { currentPassword, newPassword } = req.body;
  try {
    const [rows] = await pool.query('SELECT password_hash FROM admin_users WHERE id = ?', [req.user.id]);
    if (!rows.length) return res.status(404).json({ success: false, error: 'User not found' });
  const valid = await argon2.verify(rows[0].password_hash, currentPassword);
  if (!valid) return res.status(400).json({ success: false, error: 'Current password is incorrect' });
  const newHash = await argon2.hash(newPassword);
  await pool.query('UPDATE admin_users SET password_hash = ? WHERE id = ?', [newHash, req.user.id]);
    res.json({ success: true });
  } catch (err) {
    res.status(500).json({ success: false, error: err.message });
  }
});

export default router;
