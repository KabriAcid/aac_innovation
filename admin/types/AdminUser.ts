export interface AdminUser {
  id: string;
  email: string;
  name: string;
  role: 'super_admin' | 'admin' | 'sales' | 'support' | 'viewer';
  lastLogin?: string;
}
