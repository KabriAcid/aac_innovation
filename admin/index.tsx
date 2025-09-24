import React from 'react';
import { Routes, Route, Navigate, useLocation } from 'react-router-dom';
import AdminLayout from './AdminLayout';
import Dashboard from './pages/Dashboard';
import BookingsList from './pages/Bookings/List';
import BookingsDetail from './pages/Bookings/Detail';
import ContactsList from './pages/Contacts/List';
import ContactsDetail from './pages/Contacts/Detail';
import ServicesList from './pages/Services/List';
import TeamList from './pages/Team/List';
import Settings from './pages/Settings';
import AdminLoginPage from './pages/AdminLoginPage';
import { useAuth } from './context/AuthContext';

const AdminRoutes: React.FC = () => {
  const { isAuthenticated, isLoading } = useAuth();
  const location = useLocation();

  // Show nothing while loading auth state
  if (isLoading) return null;

  return (
    <Routes>
      {/* Login route always at /admin/login */}
      <Route
        path="login"
        element={<AdminLoginPage />}
      />
      {/* Default /admin route: redirect to dashboard */}
      <Route
        path="/"
        element={<Navigate to="/admin/dashboard" replace />}
      />
      {/* All admin pages nested under AdminLayout, no auth required */}
      <Route element={<AdminLayout />}>
        <Route path="dashboard" element={<Dashboard />} />
        <Route path="bookings" element={<BookingsList />} />
        <Route path="bookings/:id" element={<BookingsDetail />} />
        <Route path="contacts" element={<ContactsList />} />
        <Route path="contacts/:id" element={<ContactsDetail />} />
        <Route path="services" element={<ServicesList />} />
        <Route path="team" element={<TeamList />} />
        <Route path="settings" element={<Settings />} />
      </Route>
    </Routes>
  );
};

export const adminRoutes = [
  { path: '/admin/login', element: <AdminRoutes /> }
];

export default AdminRoutes;