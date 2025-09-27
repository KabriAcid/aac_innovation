import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { ArrowLeft, Calendar, Clock, User, Mail, Phone, MessageSquare, Edit } from 'lucide-react';
import { Card } from '@/components/ui/Card';
import { Button } from '@/components/ui/Button';
import { Select } from '@/components/ui/Select';
import { useToast } from '@/context/ToastContext';

import { formatDate, formatTime, cn } from '@/utils/helpers';

const BookingsDetail: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const navigate = useNavigate();
  const { error: showToastError, success: showToastSuccess } = useToast();
  const [booking, setBooking] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [updating, setUpdating] = useState(false);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchBooking = async () => {
      if (!id) return;
      setLoading(true);
      setError(null);
      try {
        const res = await fetch(`http://localhost:4000/api/bookings/${id}`);
        if (!res.ok) throw new Error('Booking not found');
        const result = await res.json();
        setBooking(result.data);
      } catch (err: any) {
        setError(err.message || 'Error loading booking');
        showToastError(err.message || 'Error loading booking');
        setTimeout(() => navigate('/admin/bookings'), 2000);
      } finally {
        setLoading(false);
      }
    };
    fetchBooking();
  }, [id, navigate, showToastError]);

  const handleStatusUpdate = async (newStatus: string) => {
    if (!booking) return;
    setUpdating(true);
    try {
      const res = await fetch(`http://localhost:4000/api/bookings/${booking.id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ status: newStatus }),
      });
      if (!res.ok) throw new Error('Failed to update booking status');
      const result = await res.json();
      setBooking({ ...booking, status: newStatus });
      showToastSuccess('Booking status updated successfully');
    } catch (err: any) {
      showToastError(err.message || 'Error updating booking status');
    } finally {
      setUpdating(false);
    }
  };

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'confirmed':
        return 'bg-green-100 text-green-800 border-green-200';
      case 'pending':
        return 'bg-yellow-100 text-yellow-800 border-yellow-200';
      case 'cancelled':
        return 'bg-red-100 text-red-800 border-red-200';
      default:
        return 'bg-gray-100 text-gray-800 border-gray-200';
    }
  };

  if (loading) {
    return (
      <div className="space-y-6">
        <div className="flex items-center space-x-4">
          <Button variant="secondary" onClick={() => navigate('/admin/bookings')}>
            <ArrowLeft className="w-4 h-4 mr-2" />
            Back
          </Button>
        </div>
        <div className="animate-pulse">
          <div className="bg-gray-200 h-8 w-64 rounded mb-6"></div>
          <div className="bg-gray-200 h-64 rounded"></div>
        </div>
      </div>
    );
  }

  if (error || !booking) {
    return (
      <div className="text-center py-12">
        <h2 className="text-xl font-semibold text-gray-900">{error || 'Booking not found'}</h2>
        <Button className="mt-4" onClick={() => navigate('/admin/bookings')}>
          Back to Bookings
        </Button>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div className="flex items-center space-x-4">
          <Button variant="secondary" onClick={() => navigate('/admin/bookings')}>
            <ArrowLeft className="w-4 h-4 mr-2" />
            Back
          </Button>
        </div>
        
        <div className="flex items-center space-x-3">
          <span className={cn(
            "px-3 py-1 text-sm font-medium rounded-full border",
            getStatusColor(booking.status)
          )}>
            {booking.status}
          </span>
        </div>
      </div>
        <h3 className="text-lg font-semibold text-gray-900 mb-4">Booking Information</h3>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Main Details */}
        <div className="lg:col-span-2 space-y-6">
          <Card className="p-6 box-shadow">
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="space-y-4">
                <div className="flex items-center space-x-3">
                  <User className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Client Name</p>
                    <p className="font-medium text-gray-900">{booking.client_name}</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <Mail className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Email</p>
                    <p className="font-medium text-gray-900">{booking.client_email}</p>
                  </div>
                </div>
                
                {booking.client_phone && (
                  <div className="flex items-center space-x-3">
                    <Phone className="w-5 h-5 text-gray-400" />
                    <div>
                      <p className="text-sm text-gray-500">Phone</p>
                      <p className="font-medium text-gray-900">{booking.client_phone}</p>
                    </div>
                  </div>
                )}
              </div>
              
              <div className="space-y-4">
                <div className="flex items-center space-x-3">
                  <Calendar className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Date</p>
                    <p className="font-medium text-gray-900">{formatDate(booking.scheduled_date)}</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <Clock className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Time</p>
                    <p className="font-medium text-gray-900">{formatTime(booking.scheduled_time)}</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <Edit className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Service</p>
                    <p className="font-medium text-gray-900">{booking.service_title}</p>
                  </div>
                </div>
              </div>
            </div>
          </Card>

          {booking.message && (
            <Card className="p-6 box-shadow">
              <h3 className="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <MessageSquare className="w-5 h-5 mr-2" />
                Message
              </h3>
              <p className="text-gray-700 whitespace-pre-wrap">{booking.message}</p>
            </Card>
          )}
        </div>

        {/* Actions Sidebar */}
        <div className="space-y-6">
          <Card className="p-6 box-shadow">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
            
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Update Status
                </label>
                <Select
                  value={booking.status}
                  onChange={(e) => handleStatusUpdate(e.target.value)}
                  disabled={updating}
                  options={[
                    { value: 'pending', label: 'Pending' },
                    { value: 'confirmed', label: 'Confirmed' },
                    { value: 'cancelled', label: 'Cancelled' }
                  ]}
                />
              </div>
              
              <div className="pt-4 border-t border-gray-200">
                <Button 
                  variant="secondary" 
                  className="w-full mb-2"
                  onClick={() => window.open(`mailto:${booking.client_email}`)}
                >
                  <Mail className="w-4 h-4 mr-2" />
                  Send Email
                </Button>
                
                {booking.client_phone && (
                  <Button 
                    variant="secondary" 
                    className="w-full"
                    onClick={() => window.open(`tel:${booking.client_phone}`)}
                  >
                    <Phone className="w-4 h-4 mr-2" />
                    Call Client
                  </Button>
                )}
              </div>
            </div>
          </Card>

          <Card className="p-6 box-shadow">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Booking Details</h3>
            <div className="space-y-3 text-sm">
              <div className="flex justify-between">
                <span className="text-gray-500">Booking ID:</span>
                <span className="font-mono text-gray-900">{booking.id}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-500">Created:</span>
                <span className="text-gray-900">{formatDate(booking.created_at || booking.scheduled_date)}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-500">Status:</span>
                <span className="text-gray-900 capitalize">{booking.status}</span>
              </div>
            </div>
          </Card>
        </div>
      </div>
    </div>
  );
};

export default BookingsDetail;