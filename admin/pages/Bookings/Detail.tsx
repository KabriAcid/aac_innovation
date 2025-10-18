import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { ArrowLeft, Calendar, Clock, User, Mail, Phone, MessageSquare, Edit } from 'lucide-react';
import { Card } from '@/components/ui/Card';
import { Button } from '@/components/ui/Button';
import { Select } from '@/components/ui/Select';

import { useToast } from '@/context/ToastContext';
import { useAuth } from '../../context/AuthContext';

import { Modal } from '@/components/ui/Modal';
import { Spinner } from '../../components/Spinner';

import { formatDate, formatTime, cn } from '@/utils/helpers';
import API_BASE_URL from '../../src/config/apiConfig';

const BookingsDetail: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const navigate = useNavigate();
  const { error: showToastError, success: showToastSuccess } = useToast();
  const [booking, setBooking] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [updating, setUpdating] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [showEmailModal, setShowEmailModal] = useState(false);
  const [emailForm, setEmailForm] = useState({
    to: '',
    subject: '',
    message: ''
  });
  const [sendingEmail, setSendingEmail] = useState(false);

  useEffect(() => {
    const fetchBooking = async () => {
      if (!id) return;
      setLoading(true);
      setError(null);
      try {
        const data = await require('../../data/adapter').adapter.getBooking(id);
        setBooking(data);
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

  const { user } = useAuth();

  const handleStatusUpdate = async (newStatus: string) => {
    if (!booking || !user) return;
    setUpdating(true);
    try {
      const updated = await require('../../data/adapter').adapter.updateBooking(booking.id, { status: newStatus, changed_by: user.id });
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

  useEffect(() => {
    if (booking) {
      setEmailForm({
        to: booking.client_email || '',
        subject: '',
        message: ''
      });
    }
  }, [booking]);

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
          <span
            className="flex items-center text-gray-700 cursor-pointer select-none"
            onClick={() => navigate('/admin/bookings')}
            role="button"
            tabIndex={0}
            onKeyDown={e => { if (e.key === 'Enter' || e.key === ' ') navigate('/admin/bookings'); }}
          >
            <ArrowLeft className="w-4 h-4 mr-2" />
            Back
          </span>
        </div>
        <div className="flex items-center space-x-3">
          <span className={cn(
            "px-3 py-1 text-sm font-medium rounded-full border",
            getStatusColor(booking.status)
          )}>
            {booking.status.charAt(0).toUpperCase() + booking.status.slice(1)}
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
              
              <div className="pt-4 border-t border-gray-200 space-y-2">
                <Button 
                  variant="secondary" 
                  className="w-full mb-2"
                  onClick={() => setShowEmailModal(true)}
                >
                  <Mail className="w-4 h-4 mr-2" />
                  Send Email
                </Button>

                {booking.client_phone && (
                  <a href={`tel:${booking.client_phone}`} className="block">
                    <Button 
                      variant="secondary" 
                      className="w-full"
                    >
                      <Phone className="w-4 h-4 mr-2" />
                      Call Client
                    </Button>
                  </a>
                )}
              </div>
      {/* Email Modal using global Modal component */}
      <Modal isOpen={showEmailModal} onClose={() => setShowEmailModal(false)} title="Send Email" size="md">
        <form
          onSubmit={async e => {
            e.preventDefault();
            setSendingEmail(true);
            try {
              const res = await fetch(`${API_BASE_URL}/email/send`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                  to: emailForm.to,
                  subject: emailForm.subject,
                  message: emailForm.message
                })
              });
              const result = await res.json();
              if (!res.ok || !result.success) throw new Error(result.message || 'Failed to send email');
              showToastSuccess('Email sent successfully');
              setShowEmailModal(false);
            } catch (err: any) {
              showToastError(err.message || 'Error sending email');
            } finally {
              setSendingEmail(false);
            }
          }}
          className="bg-white/70 backdrop-blur rounded-xl p-4 shadow-inner"
        >
          <div className="mb-4">
            <label className="block text-sm font-medium text-gray-700 mb-1">To</label>
            <input
              type="email"
              className="w-full rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-gray-100/70 px-3 py-2 transition-all outline-none text-gray-700 placeholder-gray-400"
              value={emailForm.to}
              disabled
            />
          </div>
          <div className="mb-4">
            <label className="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <input
              type="text"
              className="w-full rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-gray-100/70 px-3 py-2 transition-all outline-none text-gray-700 placeholder-gray-400"
              value={emailForm.subject}
              onChange={e => setEmailForm(f => ({ ...f, subject: e.target.value }))}
              placeholder="Subject"
              required
            />
          </div>
          <div className="mb-6">
            <label className="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <textarea
              className="w-full rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 bg-gray-100/70 px-3 py-2 min-h-[100px] transition-all outline-none text-gray-700 placeholder-gray-400"
              value={emailForm.message}
              onChange={e => setEmailForm(f => ({ ...f, message: e.target.value }))}
              placeholder="Type your message..."
              required
            />
          </div>
          <div className="flex justify-end gap-2">
            <button type="button" className="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors" onClick={() => setShowEmailModal(false)} disabled={sendingEmail}>
              Cancel
            </button>
            <button type="submit" className="px-4 py-2 rounded-lg bg-primary-900 text-white hover:bg-primary-700 transition-colors flex items-center justify-center min-w-[80px]" disabled={sendingEmail}>
              {sendingEmail ? <Spinner className="mr-2" /> : null}
              {sendingEmail ? 'Sending...' : 'Send'}
            </button>
          </div>
        </form>
      </Modal>
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