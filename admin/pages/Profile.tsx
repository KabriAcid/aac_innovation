import React, { useState, useEffect } from 'react';
import { Card } from '@/components/ui/Card';
import { Button } from '@/components/ui/Button';
import { Input } from '@/components/ui/Input';
import { useToast } from '../../src/context/ToastContext';

// Profile fields based on admin_users schema
interface ProfileData {
  username: string;
  email: string;
  firstName: string;
  lastName: string;
  role: string;
  password: string;
  newPassword: string;
  confirmPassword: string;
}

const Profile: React.FC = () => {
  const [profile, setProfile] = useState<ProfileData>({
    username: '',
    email: '',
    firstName: '',
    lastName: '',
    role: '',
    password: '',
    newPassword: '',
    confirmPassword: ''
  });
  const [loading, setLoading] = useState(true);
  useEffect(() => {
    fetchProfile();
  }, []);

  const fetchProfile = async () => {
    setLoading(true);
    try {
      const res = await fetch('/api/admin/profile', { credentials: 'include' });
      const data = await res.json();
      if (data.success) {
        setProfile(prev => ({
          ...prev,
          username: data.data.username,
          email: data.data.email,
          firstName: data.data.firstName,
          lastName: data.data.lastName,
          role: data.data.role
        }));
      } else {
        showToastError(data.error || 'Failed to load profile');
      }
    } catch (err) {
      showToastError('Failed to load profile');
    } finally {
      setLoading(false);
    }
  };
  const [saving, setSaving] = useState(false);
  const { error: showToastError, success: showToastSuccess } = useToast();

  // Handle input changes
  const handleChange = (field: keyof ProfileData, value: string) => {
    setProfile(prev => ({ ...prev, [field]: value }));
  };

  // Handle profile update
  const handleProfileUpdate = async (e: React.FormEvent) => {
    e.preventDefault();
    setSaving(true);
    try {
      const res = await fetch('/api/admin/profile', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
          email: profile.email,
          firstName: profile.firstName,
          lastName: profile.lastName
        })
      });
      const data = await res.json();
      if (data.success) {
        showToastSuccess('Profile updated successfully');
      } else {
        showToastError(data.error || 'Failed to update profile');
      }
    } catch (err) {
      showToastError('Failed to update profile');
    } finally {
      setSaving(false);
    }
  };

  // Handle password change
  const handlePasswordChange = async (e: React.FormEvent) => {
    e.preventDefault();
    if (profile.newPassword !== profile.confirmPassword) {
      showToastError('Passwords do not match');
      return;
    }
    setSaving(true);
    try {
      const res = await fetch('/api/admin/profile/password', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
          currentPassword: profile.password,
          newPassword: profile.newPassword
        })
      });
      const data = await res.json();
      if (data.success) {
        showToastSuccess('Password changed successfully');
        setProfile(prev => ({ ...prev, password: '', newPassword: '', confirmPassword: '' }));
      } else {
        showToastError(data.error || 'Failed to change password');
      }
    } catch (err) {
      showToastError('Failed to change password');
    } finally {
      setSaving(false);
    }
  };

  if (loading) {
    return (
      <div className="max-w-2xl mx-auto py-12 text-center text-gray-500">Loading profile...</div>
    );
  }

  return (
    <div className="max-w-2xl mx-auto space-y-8">
      <h1 className="text-2xl font-bold text-gray-900 mb-2 flex items-center">
        Profile
      </h1>
      <Card className="p-6 box-shadow">
        <form onSubmit={handleProfileUpdate} className="space-y-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Username</label>
              <Input type="text" value={profile.username} disabled />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <Input type="email" value={profile.email} onChange={e => handleChange('email', e.target.value)} required />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">First Name</label>
              <Input type="text" value={profile.firstName} onChange={e => handleChange('firstName', e.target.value)} required />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
              <Input type="text" value={profile.lastName} onChange={e => handleChange('lastName', e.target.value)} required />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Role</label>
              <Input type="text" value={profile.role} disabled />
            </div>
          </div>
          <div className="flex justify-end">
            <Button type="submit" disabled={saving} className="min-w-32">
              {saving ? 'Saving...' : 'Save Changes'}
            </Button>
          </div>
        </form>
      </Card>

      <Card className="p-6 box-shadow">
        <h3 className="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
        <form onSubmit={handlePasswordChange} className="space-y-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
              <Input type="password" value={profile.password} onChange={e => handleChange('password', e.target.value)} required />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">New Password</label>
              <Input type="password" value={profile.newPassword} onChange={e => handleChange('newPassword', e.target.value)} required />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
              <Input type="password" value={profile.confirmPassword} onChange={e => handleChange('confirmPassword', e.target.value)} required />
            </div>
          </div>
          <div className="flex justify-end">
            <Button type="submit" disabled={saving} className="min-w-32">
              {saving ? 'Saving...' : 'Change Password'}
            </Button>
          </div>
        </form>
      </Card>
    </div>
  );
};

export default Profile;
