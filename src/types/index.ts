export interface Service {
  id: string;
  title: string;
  description: string;
  icon: string;
  features: string[];
  pricing?: {
    model: 'subscription' | 'one-time' | 'transaction' | 'licensing' | 'consulting';
    startingPrice?: string;
    description?: string;
  };
  category: 'cybersecurity' | 'fintech' | 'cloud' | 'ai' | 'iot' | 'mobile' | 'web' | 'strategic';
}

export interface TeamMember {
  id: string;
  name: string;
  role: string;
  expertise: string[];
  avatar?: string;
}

export interface BookingFormData {
  firstName: string;
  lastName: string;
  email: string;
  phone: string;
  company?: string;
  serviceId: string;
  consultantId?: string;
  preferredDate: string;
  preferredTime: string;
  message?: string;
  consent: boolean;
}

export interface ContactFormData {
  firstName: string;
  lastName: string;
  email: string;
  phone?: string;
  company?: string;
  serviceInterest?: string;
  message: string;
  consent: boolean;
}

export interface Appointment {
  id: string;
  clientName: string;
  clientEmail: string;
  clientPhone: string;
  company?: string;
  serviceId: string;
  consultantId?: string;
  scheduledDate: string;
  scheduledTime: string;
  status: 'pending' | 'confirmed' | 'cancelled' | 'completed';
  message?: string;
  createdAt: string;
  updatedAt: string;
}

export interface ToastNotification {
  id: string;
  type: 'success' | 'error' | 'warning' | 'info';
  title: string;
  message?: string;
  duration?: number;
}

export interface ApiResponse<T = any> {
  success: boolean;
  data?: T;
  message?: string;
  errors?: Record<string, string[]>;
}