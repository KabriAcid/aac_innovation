import { generateId } from '@/utils/helpers';

// Mock data storage using localStorage
const STORAGE_KEYS = {
  BOOKINGS: 'admin_bookings',
  CONTACTS: 'admin_contacts',
  SERVICES: 'admin_services',
  TEAM: 'admin_team',
  SETTINGS: 'admin_settings'
};

// Initialize with sample data if localStorage is empty
const initializeData = () => {
  // Sample bookings
  if (!localStorage.getItem(STORAGE_KEYS.BOOKINGS)) {
    const sampleBookings = [
      {
        id: generateId(),
        name: 'John Doe',
        email: 'john@example.com',
        phone: '+1 (555) 123-4567',
        service: 'Cybersecurity Consultation',
        date: '2024-01-15',
        time: '10:00',
        message: 'Looking for a comprehensive security audit for our startup.',
        status: 'confirmed',
        createdAt: '2024-01-10'
      },
      {
        id: generateId(),
        name: 'Jane Smith',
        email: 'jane@company.com',
        phone: '+1 (555) 987-6543',
        service: 'Cloud Migration',
        date: '2024-01-20',
        time: '14:00',
        message: 'Need help migrating our infrastructure to AWS.',
        status: 'pending',
        createdAt: '2024-01-12'
      }
    ];
    localStorage.setItem(STORAGE_KEYS.BOOKINGS, JSON.stringify(sampleBookings));
  }

  // Sample contacts
  if (!localStorage.getItem(STORAGE_KEYS.CONTACTS)) {
    const sampleContacts = [
      {
        id: generateId(),
        name: 'Alice Johnson',
        email: 'alice@startup.com',
        subject: 'Partnership Inquiry',
        message: 'We are interested in exploring partnership opportunities with AAC Innovation.',
        status: 'new',
        createdAt: '2024-01-14'
      },
      {
        id: generateId(),
        name: 'Bob Wilson',
        email: 'bob@enterprise.com',
        phone: '+1 (555) 456-7890',
        subject: 'Enterprise Solutions',
        message: 'Looking for enterprise-level cybersecurity solutions for our organization.',
        status: 'in-progress',
        createdAt: '2024-01-13'
      }
    ];
    localStorage.setItem(STORAGE_KEYS.CONTACTS, JSON.stringify(sampleContacts));
  }

  // Sample services
  if (!localStorage.getItem(STORAGE_KEYS.SERVICES)) {
    const sampleServices = [
      {
        id: generateId(),
        name: 'Cybersecurity Audit',
        description: 'Comprehensive security assessment of your digital infrastructure.',
        price: '$2,500 - $5,000',
        duration: '2-3 weeks',
        category: 'Cybersecurity',
        active: true
      },
      {
        id: generateId(),
        name: 'Cloud Migration',
        description: 'Seamless migration of your applications and data to the cloud.',
        price: '$5,000 - $15,000',
        duration: '4-8 weeks',
        category: 'Cloud Computing',
        active: true
      },
      {
        id: generateId(),
        name: 'AI Implementation',
        description: 'Custom AI solutions to automate and optimize your business processes.',
        price: 'Contact for quote',
        duration: '6-12 weeks',
        category: 'Artificial Intelligence',
        active: true
      }
    ];
    localStorage.setItem(STORAGE_KEYS.SERVICES, JSON.stringify(sampleServices));
  }

  // Sample team
  if (!localStorage.getItem(STORAGE_KEYS.TEAM)) {
    const sampleTeam = [
      {
        id: generateId(),
        name: 'Dr. Amara Okafor',
        position: 'CEO & Founder',
        bio: 'Visionary leader with 15+ years in technology and innovation across Africa.',
        email: 'amara@aacinnovation.com',
        image: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400',
        linkedin: 'https://linkedin.com/in/amaraokafor',
        active: true
      },
      {
        id: generateId(),
        name: 'Kwame Asante',
        position: 'CTO',
        bio: 'Expert in cybersecurity and cloud architecture with a passion for African tech.',
        email: 'kwame@aacinnovation.com',
        image: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400',
        linkedin: 'https://linkedin.com/in/kwameasante',
        active: true
      }
    ];
    localStorage.setItem(STORAGE_KEYS.TEAM, JSON.stringify(sampleTeam));
  }
};

// Initialize data on first load
initializeData();

// Generic storage functions
const getFromStorage = <T>(key: string): T[] => {
  try {
    const data = localStorage.getItem(key);
    return data ? JSON.parse(data) : [];
  } catch (error) {
    console.error(`Error reading from localStorage key ${key}:`, error);
    return [];
  }
};

const saveToStorage = <T>(key: string, data: T[]): void => {
  try {
    localStorage.setItem(key, JSON.stringify(data));
  } catch (error) {
    console.error(`Error saving to localStorage key ${key}:`, error);
    throw new Error('Failed to save data');
  }
};

// Adapter interface - replace these functions with actual API calls
export const adapter = {
  // Bookings
  async listBookings() {
    return getFromStorage(STORAGE_KEYS.BOOKINGS);
  },

  async getBooking(id: string) {
    const bookings = getFromStorage(STORAGE_KEYS.BOOKINGS);
    return bookings.find((booking: any) => booking.id === id);
  },

  async createBooking(booking: any) {
    const bookings = getFromStorage(STORAGE_KEYS.BOOKINGS);
    const newBooking = { ...booking, id: generateId(), createdAt: new Date().toISOString() };
    bookings.push(newBooking);
    saveToStorage(STORAGE_KEYS.BOOKINGS, bookings);
    return newBooking;
  },

  async updateBooking(id: string, updates: any) {
    const bookings = getFromStorage(STORAGE_KEYS.BOOKINGS);
    const index = bookings.findIndex((booking: any) => booking.id === id);
    if (index === -1) throw new Error('Booking not found');
    
    bookings[index] = { ...bookings[index], ...updates };
    saveToStorage(STORAGE_KEYS.BOOKINGS, bookings);
    return bookings[index];
  },

  async deleteBooking(id: string) {
    const bookings = getFromStorage(STORAGE_KEYS.BOOKINGS);
    const filtered = bookings.filter((booking: any) => booking.id !== id);
    saveToStorage(STORAGE_KEYS.BOOKINGS, filtered);
  },

  // Contacts
  async listContacts() {
    return getFromStorage(STORAGE_KEYS.CONTACTS);
  },

  async getContact(id: string) {
    const contacts = getFromStorage(STORAGE_KEYS.CONTACTS);
    return contacts.find((contact: any) => contact.id === id);
  },

  async createContact(contact: any) {
    const contacts = getFromStorage(STORAGE_KEYS.CONTACTS);
    const newContact = { ...contact, id: generateId(), createdAt: new Date().toISOString() };
    contacts.push(newContact);
    saveToStorage(STORAGE_KEYS.CONTACTS, contacts);
    return newContact;
  },

  async updateContact(id: string, updates: any) {
    const contacts = getFromStorage(STORAGE_KEYS.CONTACTS);
    const index = contacts.findIndex((contact: any) => contact.id === id);
    if (index === -1) throw new Error('Contact not found');
    
    contacts[index] = { ...contacts[index], ...updates };
    saveToStorage(STORAGE_KEYS.CONTACTS, contacts);
    return contacts[index];
  },

  async deleteContact(id: string) {
    const contacts = getFromStorage(STORAGE_KEYS.CONTACTS);
    const filtered = contacts.filter((contact: any) => contact.id !== id);
    saveToStorage(STORAGE_KEYS.CONTACTS, filtered);
  },

  // Services
  async listServices() {
    return getFromStorage(STORAGE_KEYS.SERVICES);
  },

  async getService(id: string) {
    const services = getFromStorage(STORAGE_KEYS.SERVICES);
    return services.find((service: any) => service.id === id);
  },

  async createService(service: any) {
    const services = getFromStorage(STORAGE_KEYS.SERVICES);
    const newService = { ...service, id: generateId() };
    services.push(newService);
    saveToStorage(STORAGE_KEYS.SERVICES, services);
    return newService;
  },

  async updateService(id: string, updates: any) {
    const services = getFromStorage(STORAGE_KEYS.SERVICES);
    const index = services.findIndex((service: any) => service.id === id);
    if (index === -1) throw new Error('Service not found');
    
    services[index] = { ...services[index], ...updates };
    saveToStorage(STORAGE_KEYS.SERVICES, services);
    return services[index];
  },

  async deleteService(id: string) {
    const services = getFromStorage(STORAGE_KEYS.SERVICES);
    const filtered = services.filter((service: any) => service.id !== id);
    saveToStorage(STORAGE_KEYS.SERVICES, filtered);
  },

  // Team
  async listTeam() {
    return getFromStorage(STORAGE_KEYS.TEAM);
  },

  async getTeamMember(id: string) {
    const team = getFromStorage(STORAGE_KEYS.TEAM);
    return team.find((member: any) => member.id === id);
  },

  async createTeamMember(member: any) {
    const team = getFromStorage(STORAGE_KEYS.TEAM);
    const newMember = { ...member, id: generateId() };
    team.push(newMember);
    saveToStorage(STORAGE_KEYS.TEAM, team);
    return newMember;
  },

  async updateTeamMember(id: string, updates: any) {
    const team = getFromStorage(STORAGE_KEYS.TEAM);
    const index = team.findIndex((member: any) => member.id === id);
    if (index === -1) throw new Error('Team member not found');
    
    team[index] = { ...team[index], ...updates };
    saveToStorage(STORAGE_KEYS.TEAM, team);
    return team[index];
  },

  async deleteTeamMember(id: string) {
    const team = getFromStorage(STORAGE_KEYS.TEAM);
    const filtered = team.filter((member: any) => member.id !== id);
    saveToStorage(STORAGE_KEYS.TEAM, filtered);
  },

  // Settings
  async getSettings() {
    try {
      const settings = localStorage.getItem(STORAGE_KEYS.SETTINGS);
      return settings ? JSON.parse(settings) : null;
    } catch (error) {
      console.error('Error reading settings:', error);
      return null;
    }
  },

  async updateSettings(settings: any) {
    try {
      localStorage.setItem(STORAGE_KEYS.SETTINGS, JSON.stringify(settings));
      return settings;
    } catch (error) {
      console.error('Error saving settings:', error);
      throw new Error('Failed to save settings');
    }
  }
};

/* 
  BACKEND INTEGRATION EXAMPLES:
  
  Replace the localStorage functions above with actual API calls:

  async listBookings() {
    const response = await fetch('/api/bookings');
    if (!response.ok) throw new Error('Failed to fetch bookings');
    return response.json();
  },

  async createBooking(booking) {
    const response = await fetch('/api/bookings', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(booking)
    });
    if (!response.ok) throw new Error('Failed to create booking');
    return response.json();
  },

  async updateBooking(id, updates) {
    const response = await fetch(`/api/bookings/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update booking');
    return response.json();
  },

  // Similar patterns for contacts, services, team, and settings...
*/