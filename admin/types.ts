export type { Appointment } from '@/types';

// Admin-specific types
export interface AdminUser {
  id: string;
  email: string;
  name: string;
  role: 'admin' | 'moderator';
  lastLogin?: string;
}

export interface DashboardStats {
  totalBookings: number;
  totalContacts: number;
  totalServices: number;
  recentBookings: any[];
}

export interface Service {
  id: string;
  name: string;
  description: string;
  price: string;
  duration: string;
  category: string;
  active: boolean;
}

export interface TeamMember {
  id: string;
  name: string;
  position: string;
  bio: string;
  email: string;
  image: string;
  linkedin?: string;
  twitter?: string;
  active: boolean;
}

export interface Contact {
  id: string;
  name: string;
  email: string;
  phone?: string;
  subject: string;
  message: string;
  status: 'new' | 'in-progress' | 'replied' | 'closed';
  createdAt: string;
}

export interface SystemSettings {
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
    [key: string]: string;
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