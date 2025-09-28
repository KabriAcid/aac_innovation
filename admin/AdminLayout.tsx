import React, { useState } from 'react';
import { useAuth } from './context/AuthContext';
import { Outlet, Link, useLocation } from 'react-router-dom';
import { 
  LayoutDashboard, 
  Calendar, 
  Users, 
  Briefcase, 
  UserCheck, 
  Settings as SettingsIcon,
  Menu,
  X,
  User,
  LogOut
} from 'lucide-react';
import { cn } from '@/utils/helpers';

const AdminLayout: React.FC = () => {
  const [sidebarOpen, setSidebarOpen] = useState(false);
  const location = useLocation();
  const { logout } = useAuth();

  const navigation = [
    { name: 'Dashboard', href: '/admin/dashboard', icon: LayoutDashboard },
    { name: 'Bookings', href: '/admin/bookings', icon: Calendar },
    { name: 'Contacts', href: '/admin/contacts', icon: Users },
    { name: 'Services', href: '/admin/services', icon: Briefcase },
    { name: 'Team', href: '/admin/team', icon: UserCheck },
    { name: 'Settings', href: '/admin/settings', icon: SettingsIcon },
    { name: 'Logout', href: '/admin/', icon: LogOut, isLogout: true },
  ];

  const isActive = (href: string) => {
    return location.pathname === href || location.pathname.startsWith(href + '/');
  };

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col lg:flex-row">
      {/* Mobile sidebar overlay */}
      {sidebarOpen && (
        <div 
          className="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"
          onClick={() => setSidebarOpen(false)}
        />
      )}

      {/* Sidebar */}
      <aside className={cn(
        "z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out min-h-screen flex-shrink-0 flex flex-col",
        "fixed inset-y-0 left-0 lg:static lg:translate-x-0 lg:block",
        sidebarOpen ? "translate-x-0" : "-translate-x-full lg:translate-x-0"
      )}>
        <div className="flex items-center justify-between h-16 px-6 border-b border-gray-200">
          <img src="/favicon.png" alt="favicon" className='h-10 w-10' />
          <button
            onClick={() => setSidebarOpen(false)}
            className="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
          >
            <X className="w-5 h-5" />
          </button>
        </div>
        <nav className="mt-6 px-3 flex-1">
          <div className="space-y-3">
            {navigation.map((item) => {
              const Icon = item.icon;
              if (item.isLogout) {
                return (
                  <button
                    key={item.name}
                    className={cn(
                      "group flex items-center w-full px-3 py-2 text-sm font-medium rounded-md transition-colors",
                      "text-gray-700 hover:text-red-600 hover:bg-red-50"
                    )}
                    onClick={() => { logout(); setSidebarOpen(false); }}
                  >
                    <Icon className="mr-3 h-5 w-5 flex-shrink-0" />
                    {item.name}
                  </button>
                );
              }
              return (
                <Link
                  key={item.name}
                  to={item.href}
                  className={cn(
                    "group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors",
                    isActive(item.href)
                      ? "bg-blue-50 text-blue-600 border-r-2 border-blue-600"
                      : "text-gray-700 hover:text-blue-600 hover:bg-gray-50"
                  )}
                  onClick={() => setSidebarOpen(false)}
                >
                  <Icon className="mr-3 h-5 w-5 flex-shrink-0" />
                  {item.name}
                </Link>
              );
            })}
          </div>
        </nav>
      </aside>

      {/* Main content */}
      <div className="flex-1 flex flex-col min-h-screen lg:ml-0 lg:pl-0">
        {/* Top bar */}
        <div className="sticky top-0 z-10 bg-white shadow-sm border-b border-gray-200">
          <div className="flex items-center h-16 px-4 sm:px-6 lg:px-8">
            <button
              onClick={() => setSidebarOpen(true)}
              className="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
            >
              <Menu className="w-5 h-5" />
            </button>
            <div className="flex-1" />
            <Link
              to="/admin/profile"
              className="ml-auto flex items-center justify-center rounded-full hover:bg-gray-100 p-2 transition-colors"
              title="Profile"
            >
              <User className="w-6 h-6 text-gray-600" />
            </Link>
          </div>
        </div>
        {/* Page content */}
        <main className="p-4 sm:p-6 lg:p-8 flex-1">
          <Outlet />
        </main>
      </div>
    </div>
  );
};

export default AdminLayout;