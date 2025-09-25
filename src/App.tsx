import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { Layout } from '@/components/layout/Layout';
import { HomePage } from '@/pages/HomePage';
import { ServicesPage } from '@/pages/ServicesPage';
import { BookingPage } from '@/pages/BookingPage';
import { ContactPage } from '@/pages/ContactPage';
import { AboutPage } from '@/pages/AboutPage';
// Admin module (placed at project root /admin)
import AdminRoutes from '../admin';
import { AuthProvider } from '../admin/context/AuthContext';
import ScrollToTop from '@/components/ScrollToTop';
import { ToastContainer } from '@/components/ui/Toast';
import { useToast } from '@/context/ToastContext';

function App() {
  const { toasts, removeToast } = useToast();
  return (
    <Router>
      <ScrollToTop />
      <AuthProvider>
        <ToastContainer toasts={toasts} onRemove={removeToast} />
        <Routes>
          {/* Public routes wrapped in Layout */}
          <Route element={<Layout />}> 
            <Route path="/" element={<HomePage />} />
            <Route path="/services" element={<ServicesPage />} />
            <Route path="/services/:serviceId" element={<ServicesPage />} />
            <Route path="/booking" element={<BookingPage />} />
            <Route path="/contact" element={<ContactPage />} />
            <Route path="/about" element={<AboutPage />} />
          </Route>
          {/* Admin routes NOT wrapped in Layout */}
          <Route path="/admin/*" element={<AdminRoutes />} />
        </Routes>
      </AuthProvider>
    </Router>
  );
}

export default App;