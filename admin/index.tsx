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
        element={
          isAuthenticated ? (
            <Navigate to="/admin/dashboard" replace />
          ) : (
            <AdminLoginPage />
          )
        }
      />
      {/* Default /admin route: redirect to login or dashboard */}
      <Route
        path="/"
        element={
          isAuthenticated ? (
            <Navigate to="/admin/dashboard" replace />
          ) : (
            <Navigate to="/admin/login" replace />
          )
        }
      />
      {/* All admin pages nested under AdminLayout, protected */}
      <Route element={<AdminLayout />}>
        <Route
          path="dashboard"
          element={
            isAuthenticated ? <Dashboard /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
        <Route
          path="bookings"
          element={
            isAuthenticated ? <BookingsList /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
        <Route
          path="bookings/:id"
          element={
            isAuthenticated ? <BookingsDetail /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
        <Route
          path="contacts"
          element={
            isAuthenticated ? <ContactsList /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
        <Route
          path="contacts/:id"
          element={
            isAuthenticated ? <ContactsDetail /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
        <Route
          path="services"
          element={
            isAuthenticated ? <ServicesList /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
        <Route
          path="team"
          element={
            isAuthenticated ? <TeamList /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
        <Route
          path="settings"
          element={
            isAuthenticated ? <Settings /> : <Navigate to="/admin/login" replace state={{ from: location }} />
          }
        />
      </Route>
    </Routes>
  );
};

export const adminRoutes = [
  { path: '/admin', element: <AdminRoutes /> }
];

export default AdminRoutes;