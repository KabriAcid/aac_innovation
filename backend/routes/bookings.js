import express from 'express';
import bookingsApi from '../api/bookings.js';

const router = express.Router();
router.use('/', bookingsApi);

export default router;
