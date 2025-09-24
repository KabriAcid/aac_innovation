import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
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

const AdminRoutes: React.FC = () => {
  return (
    <Routes>
      {/* Default route: login page */}
      <Route path="/" element={<AdminLoginPage />} />
      {/* All admin pages nested under AdminLayout */}
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
  { path: '/admin', element: <AdminRoutes /> }
];

export default AdminRoutes;