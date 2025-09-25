import { useEffect, useState } from 'react';

export type CompanySettings = {
  name: string;
  email: string;
  phone: string;
  address: string;
  tagline?: string;
  description?: string;
  socialLinks?: {
    linkedin?: string;
    twitter?: string;
    facebook?: string;
  };
};

const FALLBACK: CompanySettings = {
  name: 'AAC Innovation',
  email: 'aacinovations43@gmail.com',
  phone: '0707 653 6019',
  address: 'Abuja, Nigeria',
  tagline: 'Empowering Africa\'s Digital Transformation',
  description: 'Driving technological advancement across Africa with expert solutions.',
  socialLinks: {
    linkedin: '#',
    twitter: '#',
    facebook: '#',
  },
};

export function useCompanySettings() {
  const [settings, setSettings] = useState<CompanySettings>(FALLBACK);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:4000/api/settings/company')
      .then(res => res.ok ? res.json() : Promise.reject())
      .then(data => {
        if (data.success && data.data) {
          setSettings({ ...FALLBACK, ...data.data });
        }
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, []);

  return { settings, loading };
}
