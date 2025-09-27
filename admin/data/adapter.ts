export const adapter = {
  // Bookings
  async listBookings() {
    const response = await fetch('/api/bookings');
    if (!response.ok) throw new Error('Failed to fetch bookings');
    const result = await response.json();
    return result.data || [];
  },

  async getBooking(id: string) {
    const response = await fetch(`/api/bookings/${id}`);
    if (!response.ok) throw new Error('Failed to fetch booking');
    const result = await response.json();
    return result.data;
  },

  async createBooking(booking: any) {
    const response = await fetch('/api/bookings', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(booking)
    });
    if (!response.ok) throw new Error('Failed to create booking');
    const result = await response.json();
    return result.data;
  },

  async updateBooking(id: string, updates: any) {
    const response = await fetch(`/api/bookings/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update booking');
    const result = await response.json();
    return result.data;
  },

  async deleteBooking(id: string) {
    const response = await fetch(`/api/bookings/${id}`, {
      method: 'DELETE'
    });
    if (!response.ok) throw new Error('Failed to delete booking');
    return true;
  },

  // Contacts
  async listContacts() {
    const response = await fetch('/api/contacts');
    if (!response.ok) throw new Error('Failed to fetch contacts');
    const result = await response.json();
    return result.data || [];
  },

  async getContact(id: string) {
    const response = await fetch(`/api/contacts/${id}`);
    if (!response.ok) throw new Error('Failed to fetch contact');
    const result = await response.json();
    return result.data;
  },

  async updateContact(id: string, updates: any) {
    const response = await fetch(`/api/contacts/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update contact');
    const result = await response.json();
    return result.data;
  },

  // Services
  async listServices() {
    const response = await fetch('/api/services');
    if (!response.ok) throw new Error('Failed to fetch services');
    const result = await response.json();
    return result.data || [];
  },

  async getService(id: string) {
    const response = await fetch(`/api/services/${id}`);
    if (!response.ok) throw new Error('Failed to fetch service');
    const result = await response.json();
    return result.data;
  },

  async createService(service: any) {
    const response = await fetch('/api/services', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(service)
    });
    if (!response.ok) throw new Error('Failed to create service');
    const result = await response.json();
    return result.data;
  },

  async updateService(id: string, updates: any) {
    const response = await fetch(`/api/services/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update service');
    const result = await response.json();
    return result.data;
  },

  async deleteService(id: string) {
    const response = await fetch(`/api/services/${id}`, {
      method: 'DELETE'
    });
    if (!response.ok) throw new Error('Failed to delete service');
    return true;
  },

  // Team
  async listTeam() {
    const response = await fetch('/api/team');
    if (!response.ok) throw new Error('Failed to fetch team');
    const result = await response.json();
    return result.data || [];
  },

  async getTeamMember(id: string) {
    const response = await fetch(`/api/team/${id}`);
    if (!response.ok) throw new Error('Failed to fetch team member');
    const result = await response.json();
    return result.data;
  },

  async createTeamMember(member: any) {
    const response = await fetch('/api/team', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(member)
    });
    if (!response.ok) throw new Error('Failed to create team member');
    const result = await response.json();
    return result.data;
  },

  async updateTeamMember(id: string, updates: any) {
    const response = await fetch(`/api/team/${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update team member');
    const result = await response.json();
    return result.data;
  },

  async deleteTeamMember(id: string) {
    const response = await fetch(`/api/team/${id}`, {
      method: 'DELETE'
    });
    if (!response.ok) throw new Error('Failed to delete team member');
    return true;
  },

  // Settings
  async getSettings() {
    const response = await fetch('/api/settings');
    if (!response.ok) throw new Error('Failed to fetch settings');
    const result = await response.json();
    return result.data;
  },

  async updateSettings(settings: any) {
    // Only send the fields the backend expects
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
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    if (!response.ok) throw new Error('Failed to update settings');
    return (await response.json()).success;
  }
};