import express from 'express';
import cors from 'cors';
import dotenv from 'dotenv';
import logger from './middleware/logger.js';
import errorHandler from './middleware/errorHandler.js';
import bookingsRoute from './routes/bookings.js';
import servicesRoute from './api/services.js';

dotenv.config();
const app = express();

app.use(cors());
app.use(express.json());
app.use(logger);

app.use('/api/bookings', bookingsRoute);
app.use('/api/services', servicesRoute);

app.use(errorHandler);

const PORT = process.env.PORT || 4000;
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
