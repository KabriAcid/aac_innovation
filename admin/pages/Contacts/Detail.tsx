import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { ArrowLeft, Mail, User, Calendar, MessageSquare, Phone } from 'lucide-react';
import { Card } from '@/components/ui/Card';
import { Button } from '@/components/ui/Button';
import { Select } from '@/components/ui/Select';
import { useToast } from '../../src/context/ToastContext';
import { adapter } from '../../data/adapter';
import { formatDate, cn } from '@/utils/helpers';

const ContactsDetail: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const navigate = useNavigate();
  const { error: showToastError, success: showToastSuccess } = useToast();
  const [contact, setContact] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [updating, setUpdating] = useState(false);

  useEffect(() => {
    const loadContact = async () => {
      if (!id) return;
      
      try {
        const data = await adapter.getContact(id);
        if (data) {
          setContact(data);
        } else {
          showToastError('Contact not found');
          navigate('/admin/contacts');
        }
      } catch (error) {
        console.error('Error loading contact:', error);
  showToastError('Error loading contact');
      } finally {
        setLoading(false);
      }
    };

    loadContact();
  }, [id, navigate, showToast]);

  const handleStatusUpdate = async (newStatus: string) => {
    if (!contact) return;

    setUpdating(true);
    try {
      const updatedContact = { ...contact, status: newStatus };
      await adapter.updateContact(contact.id, updatedContact);
      setContact(updatedContact);
  showToastSuccess('Contact status updated successfully');
    } catch (error) {
      console.error('Error updating contact:', error);
  showToastError('Error updating contact status');
    } finally {
      setUpdating(false);
    }
  };

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'replied':
        return 'bg-green-100 text-green-800 border-green-200';
      case 'in-progress':
        return 'bg-yellow-100 text-yellow-800 border-yellow-200';
      case 'closed':
        return 'bg-gray-100 text-gray-800 border-gray-200';
      default:
        return 'bg-blue-100 text-blue-800 border-blue-200';
    }
  };

  if (loading) {
    return (
      <div className="space-y-6">
        <div className="flex items-center space-x-4">
          <Button variant="outline" onClick={() => navigate('/admin/contacts')}>
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

  if (!contact) {
    return (
      <div className="text-center py-12">
        <h2 className="text-xl font-semibold text-gray-900">Contact not found</h2>
        <Button className="mt-4" onClick={() => navigate('/admin/contacts')}>
          Back to Contacts
        </Button>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div className="flex items-center space-x-4">
          <Button variant="outline" onClick={() => navigate('/admin/contacts')}>
            <ArrowLeft className="w-4 h-4 mr-2" />
            Back
          </Button>
        </div>
        
        <div className="flex items-center space-x-3">
          <span className={cn(
            "px-3 py-1 text-sm font-medium rounded-full border",
            getStatusColor(contact.status || 'new')
          )}>
            {contact.status || 'new'}
          </span>
        </div>
      </div>
        <h3 className="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Main Details */}
        <div className="lg:col-span-2 space-y-6">
          <Card className="p-6">
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="space-y-4">
                <div className="flex items-center space-x-3">
                  <User className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Name</p>
                    <p className="font-medium text-gray-900">{contact.name}</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <Mail className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Email</p>
                    <p className="font-medium text-gray-900">{contact.email}</p>
                  </div>
                </div>
                
                {contact.phone && (
                  <div className="flex items-center space-x-3">
                    <Phone className="w-5 h-5 text-gray-400" />
                    <div>
                      <p className="text-sm text-gray-500">Phone</p>
                      <p className="font-medium text-gray-900">{contact.phone}</p>
                    </div>
                  </div>
                )}
              </div>
              
              <div className="space-y-4">
                <div className="flex items-center space-x-3">
                  <MessageSquare className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Subject</p>
                    <p className="font-medium text-gray-900">{contact.subject}</p>
                  </div>
                </div>
                
                <div className="flex items-center space-x-3">
                  <Calendar className="w-5 h-5 text-gray-400" />
                  <div>
                    <p className="text-sm text-gray-500">Received</p>
                    <p className="font-medium text-gray-900">{formatDate(contact.createdAt || contact.date)}</p>
                  </div>
                </div>
              </div>
            </div>
          </Card>

          <Card className="p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4 flex items-center">
              <MessageSquare className="w-5 h-5 mr-2" />
              Message
            </h3>
            <div className="bg-gray-50 rounded-lg p-4">
              <p className="text-gray-700 whitespace-pre-wrap">{contact.message}</p>
            </div>
          </Card>
        </div>

        {/* Actions Sidebar */}
        <div className="space-y-6">
          <Card className="p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
            
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Update Status
                </label>
                <Select
                  value={contact.status || 'new'}
                  onChange={(e) => handleStatusUpdate(e.target.value)}
                  disabled={updating}
                >
                  <option value="new">New</option>
                  <option value="in-progress">In Progress</option>
                  <option value="replied">Replied</option>
                  <option value="closed">Closed</option>
                </Select>
              </div>
              
              <div className="pt-4 border-t border-gray-200">
                <Button 
                  className="w-full mb-2"
                  onClick={() => window.open(`mailto:${contact.email}?subject=Re: ${contact.subject}`)}
                >
                  <Mail className="w-4 h-4 mr-2" />
                  Reply via Email
                </Button>
                
                {contact.phone && (
                  <Button 
                    variant="outline" 
                    className="w-full"
                    onClick={() => window.open(`tel:${contact.phone}`)}
                  >
                    <Phone className="w-4 h-4 mr-2" />
                    Call Contact
                  </Button>
                )}
              </div>
            </div>
          </Card>

          <Card className="p-6">
            <h3 className="text-lg font-semibold text-gray-900 mb-4">Contact Details</h3>
            <div className="space-y-3 text-sm">
              <div className="flex justify-between">
                <span className="text-gray-500">Contact ID:</span>
                <span className="font-mono text-gray-900">{contact.id}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-500">Received:</span>
                <span className="text-gray-900">{formatDate(contact.createdAt || contact.date)}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-500">Status:</span>
                <span className="text-gray-900 capitalize">{contact.status || 'new'}</span>
              </div>
            </div>
          </Card>
        </div>
      </div>
    </div>
  );
};

export default ContactsDetail;