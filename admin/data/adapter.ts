function getAuthHeaders(contentType = 'application/json') {
  const token = localStorage.getItem('auth_token');
  const headers: Record<string, string> = {};
  if (contentType) headers['Content-Type'] = contentType;
  if (token) headers['Authorization'] = `Bearer ${token}`;
  return headers;
}

export const adapter = {
  // Bookings
  async listBookings() {
  const response = await fetch('/api/bookings', { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to fetch bookings');
    const result = await response.json();
    return result.data || [];
  },
  async getBooking(id: string) {
  const response = await fetch(`/api/bookings/${id}`, { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to fetch booking');
    const result = await response.json();
    return result.data;
  },
  async createBooking(booking: any) {
    const response = await fetch('/api/bookings', {
      method: 'POST',
      headers: getAuthHeaders(),
      body: JSON.stringify(booking)
    });
    if (!response.ok) throw new Error('Failed to create booking');
    const result = await response.json();
    return result.data;
  },
  async updateBooking(id: string, updates: any) {
    const response = await fetch(`/api/bookings/${id}`, {
      method: 'PUT',
      headers: getAuthHeaders(),
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update booking');
    const result = await response.json();
    return result.data;
  },
  async deleteBooking(id: string) {
    const response = await fetch(`/api/bookings/${id}`, {
      method: 'DELETE',
  headers: getAuthHeaders()
    });
    if (!response.ok) throw new Error('Failed to delete booking');
    return true;
  },

  // Contacts
  async listContacts() {
  const response = await fetch('/api/contacts', { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to fetch contacts');
    const result = await response.json();
    return result.data || [];
  },
  async getContact(id: string) {
  const response = await fetch(`/api/contacts/${id}`, { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to fetch contact');
    const result = await response.json();
    return result.data;
  },
  async createContact(contact: any) {
    const response = await fetch('/api/contacts', {
      method: 'POST',
      headers: getAuthHeaders(),
      body: JSON.stringify(contact)
    });
    if (!response.ok) throw new Error('Failed to create contact');
    const result = await response.json();
    return result.data;
  },
  async updateContact(id: string, updates: any) {
    const response = await fetch(`/api/contacts/${id}`, {
      method: 'PUT',
      headers: getAuthHeaders(),
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update contact');
    const result = await response.json();
    return result.data;
  },
  async deleteContact(id: string) {
    const response = await fetch(`/api/contacts/${id}`, {
      method: 'DELETE',
  headers: getAuthHeaders()
    });
    if (!response.ok) throw new Error('Failed to delete contact');
    return true;
  },

  // Services
  async listServices() {
  const response = await fetch('/api/services', { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to fetch services');
    const result = await response.json();
    return result.data || [];
  },
  async getService(id: string) {
  const response = await fetch(`/api/services/${id}`, { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to fetch service');
    const result = await response.json();
    return result.data;
  },
  async createService(service: any) {
    const response = await fetch('/api/services', {
      method: 'POST',
      headers: getAuthHeaders(),
      body: JSON.stringify(service)
    });
    if (!response.ok) throw new Error('Failed to create service');
    const result = await response.json();
    return result.data;
  },
  async updateService(id: string, updates: any) {
    const response = await fetch(`/api/services/${id}`, {
      method: 'PUT',
      headers: getAuthHeaders(),
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update service');
    const result = await response.json();
    return result.data;
  },
  async deleteService(id: string) {
    const response = await fetch(`/api/services/${id}`, {
      method: 'DELETE',
  headers: getAuthHeaders()
    });
    if (!response.ok) throw new Error('Failed to delete service');
    return true;
  },

  // Team
  async listTeam() {
  const response = await fetch('/api/team', { headers: getAuthHeaders() });
    const result = await response.json();
    return result.data || [];
  },
  async getTeamMember(id: string) {
  const response = await fetch(`/api/team/${id}`, { headers: getAuthHeaders() });
    const result = await response.json();
    return result.data;
  },
  async createTeamMember(member: any) {
    const response = await fetch('/api/team', {
      method: 'POST',
      headers: getAuthHeaders(),
      body: JSON.stringify(member)
    });
    const result = await response.json();
    return result.data;
  },
  async updateTeamMember(id: string, updates: any) {
    const response = await fetch(`/api/team/${id}`, {
      method: 'PUT',
      headers: getAuthHeaders(),
      body: JSON.stringify(updates)
    });
    const result = await response.json();
    return result.data;
  },
  async deleteTeamMember(id: string) {
    const response = await fetch(`/api/team/${id}`, {
      method: 'DELETE',
  headers: getAuthHeaders()
    });
    return true;
  },

  // Dashboard
  async getDashboardKpis() {
    const response = await fetch('/api/dashboard/kpis', { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to load KPIs');
    const result = await response.json();
    return result.data;
  },
  async getRecentBookings() {
    const response = await fetch('/api/dashboard/recent-bookings', { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to load recent bookings');
    const result = await response.json();
    return result.data;
  },
  async getRecentContacts() {
    const response = await fetch('/api/dashboard/recent-contacts', { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to load recent contacts');
    const result = await response.json();
    return result.data;
  },
  // Settings
  async getSettings() {
  const response = await fetch('/api/settings', { headers: getAuthHeaders() });
    if (!response.ok) throw new Error('Failed to fetch settings');
    const result = await response.json();
    return result.data;
  },
  async updateSettings(settings: any) {
    const payload = {
      companyName: settings.companyName,
      companyEmail: settings.companyEmail,
      companyPhone: settings.companyPhone,
      companyAddress: settings.companyAddress,
      websiteUrl: settings.websiteUrl,
      socialMedia: settings.socialMedia,
      emailSettings: settings.emailSettings
    };
    const response = await fetch('/api/settings', {
      method: 'PUT',
      headers: getAuthHeaders(),
      body: JSON.stringify(payload)
    });
    if (!response.ok) throw new Error('Failed to update settings');
    return (await response.json()).success;
  }
};