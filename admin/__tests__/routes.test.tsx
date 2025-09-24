import React from 'react';
import { render, screen } from '@testing-library/react';
import { BrowserRouter } from 'react-router-dom';
import { describe, it, expect } from 'vitest';
import AdminRoutes from '../index';

// Mock the toast hook
const mockShowToast = vi.fn();
vi.mock('@/hooks/useToast', () => ({
  useToast: () => ({ showToast: mockShowToast })
}));

// Mock the components to avoid complex dependencies
vi.mock('@/components/ui/Card', () => ({
  Card: ({ children, className }: any) => <div className={className}>{children}</div>
}));

vi.mock('@/components/ui/Button', () => ({
  Button: ({ children, onClick, className }: any) => (
    <button onClick={onClick} className={className}>{children}</button>
  )
}));

vi.mock('@/components/ui/Input', () => ({
  Input: (props: any) => <input {...props} />
}));

vi.mock('@/components/ui/Select', () => ({
  Select: ({ children, ...props }: any) => <select {...props}>{children}</select>
}));

vi.mock('@/components/ui/Textarea', () => ({
  Textarea: (props: any) => <textarea {...props} />
}));

vi.mock('@/components/ui/Modal', () => ({
  Modal: ({ isOpen, children, title }: any) => 
    isOpen ? <div role="dialog" aria-label={title}>{children}</div> : null
}));

// Mock the data adapter
vi.mock('../data/adapter', () => ({
  adapter: {
    listBookings: vi.fn().mockResolvedValue([]),
    listContacts: vi.fn().mockResolvedValue([]),
    listServices: vi.fn().mockResolvedValue([]),
    listTeam: vi.fn().mockResolvedValue([]),
    getSettings: vi.fn().mockResolvedValue(null)
  }
}));

// Mock utility functions
vi.mock('@/utils/helpers', () => ({
  cn: (...classes: any[]) => classes.filter(Boolean).join(' '),
  formatDate: (date: string) => new Date(date).toLocaleDateString(),
  formatTime: (time: string) => time,
  generateId: () => 'mock-id-' + Math.random().toString(36).substr(2, 9)
}));

const renderWithRouter = (component: React.ReactElement) => {
  return render(
    <BrowserRouter>
      {component}
    </BrowserRouter>
  );
};

describe('AdminRoutes', () => {
  it('renders without crashing', () => {
    renderWithRouter(<AdminRoutes />);
    expect(screen.getByText('AAC Admin')).toBeInTheDocument();
  });

  it('displays navigation menu', () => {
    renderWithRouter(<AdminRoutes />);
    
    expect(screen.getByText('Dashboard')).toBeInTheDocument();
    expect(screen.getByText('Bookings')).toBeInTheDocument();
    expect(screen.getByText('Contacts')).toBeInTheDocument();
    expect(screen.getByText('Services')).toBeInTheDocument();
    expect(screen.getByText('Team')).toBeInTheDocument();
    expect(screen.getByText('Settings')).toBeInTheDocument();
  });

  it('shows admin panel header', () => {
    renderWithRouter(<AdminRoutes />);
    expect(screen.getByText('Admin Panel')).toBeInTheDocument();
  });
});