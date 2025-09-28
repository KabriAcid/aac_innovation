

import React, { useEffect, useState } from 'react';
import { Calendar, Users, Briefcase, TrendingUp } from 'lucide-react';
import { Card } from '@/components/ui/Card';
import { formatDate } from '@/utils/helpers';
import { adapter } from '../data/adapter';

interface KpiData {
  total_bookings: number;
  pending_bookings: number;
  confirmed_bookings: number;
  total_contacts: number;
  total_services: number;
}

interface Booking {
  id: string;
  client_name: string;
  client_email: string;
  scheduled_date: string;
  scheduled_time: string;
  status: string;
  service_title: string;
}

interface Contact {
  id: string;
  first_name: string;
  last_name: string;
  email: string;
  company?: string;
  service_interest?: string;
  message: string;
  status: string;
  created_at: string;
}




const Dashboard: React.FC = () => {
  const [kpis, setKpis] = useState<KpiData | null>(null);
  const [recentBookings, setRecentBookings] = useState<Booking[]>([]);
  const [recentContacts, setRecentContacts] = useState<Contact[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);


  useEffect(() => {
    const fetchDashboard = async () => {
      setLoading(true);
      setError(null);
      try {
        // Use adapter for all dashboard API calls
        const [kpis, recentBookings, recentContacts] = await Promise.all([
          adapter.getDashboardKpis(),
          adapter.getRecentBookings(),
          adapter.getRecentContacts(),
        ]);
        setKpis(kpis);
        setRecentBookings(recentBookings);
        setRecentContacts(recentContacts);
      } catch (err: any) {
        setError(err.message || 'Failed to load dashboard data');
      } finally {
        setLoading(false);
      }
    };
    fetchDashboard();
  }, []);


  const statCards = kpis
    ? [
        {
          title: 'Total Bookings',
          value: kpis.total_bookings,
          icon: Calendar,
          color: 'text-blue-600',
          bgColor: 'bg-blue-50',
        },
        {
          title: 'Total Contacts',
          value: kpis.total_contacts,
          icon: Users,
          color: 'text-green-600',
          bgColor: 'bg-green-50',
        },
        {
          title: 'Active Services',
          value: kpis.total_services,
          icon: Briefcase,
          color: 'text-purple-600',
          bgColor: 'bg-purple-50',
        },
        {
          title: 'Growth Rate',
          value: '+12%', // Placeholder, replace with real metric if available
          icon: TrendingUp,
          color: 'text-orange-600',
          bgColor: 'bg-orange-50',
        },
      ]
    : [];


  if (loading) {
    return (
      <div className="space-y-6">
        <h1 className="text-2xl font-bold text-gray-900">Dashboard</h1>
        <div className="animate-pulse">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {[...Array(4)].map((_, i) => (
              <div key={i} className="bg-gray-200 h-32 rounded-lg"></div>
            ))}
          </div>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="space-y-6">
        <h1 className="text-2xl font-bold text-gray-900">Dashboard</h1>
        <div className="bg-red-100 text-red-700 p-4 rounded-lg">{error}</div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-gray-900">Dashboard</h1>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {statCards.map((stat, index) => {
          const Icon = stat.icon;
          return (
            <Card key={index} className="p-6 box-shadow">
              <div className="flex items-center justify-between">
                <div>
                  <p className="text-sm font-medium text-gray-600">{stat.title}</p>
                  <p className="text-2xl font-bold text-gray-900 mt-1">{stat.value}</p>
                </div>
                <div className={`p-3 rounded-full ${stat.bgColor}`}>
                  <Icon className={`w-6 h-6 ${stat.color}`} />
                </div>
              </div>
            </Card>
          );
        })}
      </div>

      {/* Recent Activity */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card className="p-6 box-shadow">
          <h3 className="text-lg font-semibold text-gray-900 mb-4">Recent Bookings</h3>
          <div className="space-y-3">
            {recentBookings.length > 0 ? (
              recentBookings.map((booking) => (
                <div key={booking.id} className="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                  <div>
                    <p className="font-medium text-gray-900">{booking.client_name}</p>
                    <p className="text-sm text-gray-500">{booking.service_title}</p>
                  </div>
                  <div className="text-right">
                    <p className="text-sm font-medium text-gray-900">{formatDate(booking.scheduled_date)}</p>
                    <p className="text-sm text-gray-500">{booking.scheduled_time}</p>
                  </div>
                </div>
              ))
            ) : (
              <p className="text-gray-500 text-center py-4">No recent bookings</p>
            )}
          </div>
        </Card>

        <Card className="p-6 box-shadow">
          <h3 className="text-lg font-semibold text-gray-900 mb-4">Recent Contacts</h3>
          <div className="space-y-3">
            {recentContacts.length > 0 ? (
              recentContacts.map((contact) => (
                <div key={contact.id} className="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                  <div>
                    <p className="font-medium text-gray-900">{contact.first_name} {contact.last_name}</p>
                    <p className="text-sm text-gray-500">{contact.email}</p>
                  </div>
                  <div className="text-right">
                    <p className="text-sm font-medium text-gray-900">{formatDate(contact.created_at)}</p>
                    <p className="text-sm text-gray-500">{contact.status}</p>
                  </div>
                </div>
              ))
            ) : (
              <p className="text-gray-500 text-center py-4">No recent contacts</p>
            )}
          </div>
        </Card>

        {/* Quick Actions can be added here as a third card if needed */}
      </div>
    </div>
  );
};

export default Dashboard;