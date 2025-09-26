import React, { useEffect, useState } from 'react';
import { Save, Settings as SettingsIcon } from 'lucide-react';
import { Card } from '@/components/ui/Card';
import { Button } from '@/components/ui/Button';
import { Input } from '@/components/ui/Input';
import { Textarea } from '@/components/ui/Textarea';
import { useToast } from '../../src/context/ToastContext';
import { adapter } from '../data/adapter';

interface SystemSettings {
  companyName: string;
  companyEmail: string;
  companyPhone: string;
  companyAddress: string;
  websiteUrl: string;
  socialMedia: {
    facebook: string;
    twitter: string;
    linkedin: string;
    instagram: string;
  };
  businessHours: {
    monday: string;
    tuesday: string;
    wednesday: string;
    thursday: string;
    friday: string;
    saturday: string;
    sunday: string;
  };
  emailSettings: {
    smtpHost: string;
    smtpPort: string;
    smtpUser: string;
    smtpPassword: string;
  };
  seoSettings: {
    metaTitle: string;
    metaDescription: string;
    keywords: string;
  };
}

const Settings: React.FC = () => {
  const [settings, setSettings] = useState<SystemSettings>({
    companyName: 'AAC Innovation',
    companyEmail: 'info@aacinnovation.com',
    companyPhone: '+1 (555) 123-4567',
    companyAddress: '123 Tech Street, Innovation City, IC 12345',
    websiteUrl: 'https://aacinnovation.com',
    socialMedia: {
      facebook: '',
      twitter: '',
      linkedin: '',
      instagram: ''
    },
    businessHours: {
      monday: '9:00 AM - 6:00 PM',
      tuesday: '9:00 AM - 6:00 PM',
      wednesday: '9:00 AM - 6:00 PM',
      thursday: '9:00 AM - 6:00 PM',
      friday: '9:00 AM - 6:00 PM',
      saturday: '10:00 AM - 4:00 PM',
      sunday: 'Closed'
    },
    emailSettings: {
      smtpHost: '',
      smtpPort: '587',
      smtpUser: '',
      smtpPassword: ''
    },
    seoSettings: {
      metaTitle: 'AAC Innovation - Driving Africa\'s Tech Future',
      metaDescription: 'Leading technology services provider in Africa, specializing in cybersecurity, fintech, cloud computing, AI, and IoT solutions.',
      keywords: 'technology, cybersecurity, fintech, cloud computing, AI, IoT, Africa'
    }
  });
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);
  const { error: showToastError, success: showToastSuccess } = useToast();

  useEffect(() => {
    loadSettings();
  }, []);

  const loadSettings = async () => {
    try {
      const data = await adapter.getSettings();
      if (data) {
        setSettings({ ...settings, ...data });
      }
    } catch (error) {
      console.error('Error loading settings:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setSaving(true);
    
    try {
      await adapter.updateSettings(settings);
  showToastSuccess('Settings saved successfully');
    } catch (error) {
      console.error('Error saving settings:', error);
  showToastError('Error saving settings');
    } finally {
      setSaving(false);
    }
  };

  const updateSettings = (path: string, value: any) => {
    const keys = path.split('.');
    const newSettings = { ...settings };
    let current: any = newSettings;
    
    for (let i = 0; i < keys.length - 1; i++) {
      current = current[keys[i]];
    }
    
    current[keys[keys.length - 1]] = value;
    setSettings(newSettings);
  };

  if (loading) {
    return (
      <div className="space-y-6">
        <h1 className="text-2xl font-bold text-gray-900">Settings</h1>
        <div className="animate-pulse space-y-4">
          {[...Array(3)].map((_, i) => (
            <div key={i} className="bg-gray-200 h-64 rounded-lg"></div>
          ))}
        </div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-gray-900 flex items-center">
          <SettingsIcon className="w-6 h-6 mr-2" />
          Settings
        </h1>
      </div>

      <form onSubmit={handleSubmit} className="space-y-6">
        {/* Company Information */}
        <Card className="p-6">
          <h3 className="text-lg font-semibold text-gray-900 mb-4">Company Information</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Company Name
              </label>
              <Input
                type="text"
                value={settings.companyName}
                onChange={(e) => updateSettings('companyName', e.target.value)}
                required
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Email
              </label>
              <Input
                type="email"
                value={settings.companyEmail}
                onChange={(e) => updateSettings('companyEmail', e.target.value)}
                required
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Phone
              </label>
              <Input
                type="tel"
                value={settings.companyPhone}
                onChange={(e) => updateSettings('companyPhone', e.target.value)}
                required
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Website URL
              </label>
              <Input
                type="url"
                value={settings.websiteUrl}
                onChange={(e) => updateSettings('websiteUrl', e.target.value)}
                required
              />
            </div>
            
            <div className="md:col-span-2">
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Address
              </label>
              <Textarea
                value={settings.companyAddress}
                onChange={(e) => updateSettings('companyAddress', e.target.value)}
                rows={2}
                required
              />
            </div>
          </div>
        </Card>

        {/* Social Media */}
        <Card className="p-6">
          <h3 className="text-lg font-semibold text-gray-900 mb-4">Social Media</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Facebook
              </label>
              <Input
                type="url"
                value={settings.socialMedia.facebook}
                onChange={(e) => updateSettings('socialMedia.facebook', e.target.value)}
                placeholder="https://facebook.com/yourpage"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Twitter
              </label>
              <Input
                type="url"
                value={settings.socialMedia.twitter}
                onChange={(e) => updateSettings('socialMedia.twitter', e.target.value)}
                placeholder="https://twitter.com/youraccount"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                LinkedIn
              </label>
              <Input
                type="url"
                value={settings.socialMedia.linkedin}
                onChange={(e) => updateSettings('socialMedia.linkedin', e.target.value)}
                placeholder="https://linkedin.com/company/yourcompany"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Instagram
              </label>
              <Input
                type="url"
                value={settings.socialMedia.instagram}
                onChange={(e) => updateSettings('socialMedia.instagram', e.target.value)}
                placeholder="https://instagram.com/youraccount"
              />
            </div>
          </div>
        </Card>

        {/* SEO Settings */}
        <Card className="p-6">
          <h3 className="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>
          <div className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Meta Title
              </label>
              <Input
                type="text"
                value={settings.seoSettings.metaTitle}
                onChange={(e) => updateSettings('seoSettings.metaTitle', e.target.value)}
                maxLength={60}
                required
              />
              <p className="text-xs text-gray-500 mt-1">
                {settings.seoSettings.metaTitle.length}/60 characters
              </p>
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Meta Description
              </label>
              <Textarea
                value={settings.seoSettings.metaDescription}
                onChange={(e) => updateSettings('seoSettings.metaDescription', e.target.value)}
                rows={3}
                maxLength={160}
                required
              />
              <p className="text-xs text-gray-500 mt-1">
                {settings.seoSettings.metaDescription.length}/160 characters
              </p>
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Keywords
              </label>
              <Input
                type="text"
                value={settings.seoSettings.keywords}
                onChange={(e) => updateSettings('seoSettings.keywords', e.target.value)}
                placeholder="keyword1, keyword2, keyword3"
                required
              />
            </div>
          </div>
        </Card>

        {/* Business Hours */}
        <Card className="p-6">
          <h3 className="text-lg font-semibold text-gray-900 mb-4">Business Hours</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {Object.entries(settings.businessHours).map(([day, hours]) => (
              <div key={day}>
                <label className="block text-sm font-medium text-gray-700 mb-1 capitalize">
                  {day}
                </label>
                <Input
                  type="text"
                  value={hours}
                  onChange={(e) => updateSettings(`businessHours.${day}`, e.target.value)}
                  placeholder="9:00 AM - 6:00 PM or Closed"
                />
              </div>
            ))}
          </div>
        </Card>

        {/* Save Button */}
        <div className="flex justify-end">
          <Button type="submit" disabled={saving} className="min-w-32">
            {saving ? (
              'Saving...'
            ) : (
              <>
                <Save className="w-4 h-4 mr-2" />
                Save Settings
              </>
            )}
          </Button>
        </div>
      </form>
    </div>
  );
};

export default Settings;