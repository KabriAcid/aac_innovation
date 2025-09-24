# AAC Innovation Admin Module

A self-contained React admin panel for managing the AAC Innovation website. This module provides a complete administrative interface for managing bookings, contacts, services, team members, and system settings.

## Features

- **Dashboard**: Overview of key metrics and recent activity
- **Bookings Management**: View, filter, and manage appointment bookings
- **Contacts Management**: Handle contact form submissions and inquiries
- **Services Management**: CRUD operations for service offerings
- **Team Management**: Manage team member profiles and information
- **Settings**: Configure company information, social media, SEO, and business hours
- **Responsive Design**: Mobile-first design that works on all devices
- **Real-time Updates**: Instant feedback with toast notifications

## Installation & Integration

### 1. Copy the Admin Module

Copy the entire `admin/` directory to your project root:

```
your-project/
├── src/
├── admin/           # <- Copy this entire directory
│   ├── index.tsx
│   ├── AdminLayout.tsx
│   ├── pages/
│   ├── data/
│   └── ...
└── ...
```

### 2. Update App.tsx

Add the admin routes to your main application:

```tsx
// src/App.tsx
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import AdminRoutes from './admin'; // Import the admin module

function App() {
  return (
    <Router>
      <Routes>
        {/* Your existing routes */}
        <Route path="/" element={<HomePage />} />
        <Route path="/services" element={<ServicesPage />} />
        <Route path="/contact" element={<ContactPage />} />
        
        {/* Add admin routes */}
        <Route path="/admin/*" element={<AdminRoutes />} />
      </Routes>
    </Router>
  );
}

export default App;
```

### 3. Access the Admin Panel

Navigate to `/admin` in your browser to access the admin panel.

## Data Management

The admin module currently uses localStorage for data persistence with sample data. This makes it easy to test and develop without a backend.

### Sample Data Included

- **Bookings**: 2 sample appointment bookings
- **Contacts**: 2 sample contact inquiries  
- **Services**: 3 sample services (Cybersecurity, Cloud Migration, AI Implementation)
- **Team**: 2 sample team members
- **Settings**: Default company configuration

### Switching to Real Backend

To connect the admin panel to your actual backend API, replace the functions in `admin/data/adapter.ts`:

```typescript
// Example: Replace localStorage with API calls
export const adapter = {
  async listBookings() {
    const response = await fetch('/api/admin/bookings', {
      headers: {
        'Authorization': `Bearer ${getAuthToken()}`,
        'Content-Type': 'application/json'
      }
    });
    if (!response.ok) throw new Error('Failed to fetch bookings');
    return response.json();
  },

  async createBooking(booking) {
    const response = await fetch('/api/admin/bookings', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${getAuthToken()}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(booking)
    });
    if (!response.ok) throw new Error('Failed to create booking');
    return response.json();
  },

  async updateBooking(id, updates) {
    const response = await fetch(`/api/admin/bookings/${id}`, {
      method: 'PUT',
      headers: {
        'Authorization': `Bearer ${getAuthToken()}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(updates)
    });
    if (!response.ok) throw new Error('Failed to update booking');
    return response.json();
  },

  // Similar patterns for other entities...
};
```

## API Endpoints Expected

When connecting to a real backend, the admin expects these endpoints:

### Bookings
- `GET /api/admin/bookings` - List all bookings
- `GET /api/admin/bookings/:id` - Get specific booking
- `POST /api/admin/bookings` - Create new booking
- `PUT /api/admin/bookings/:id` - Update booking
- `DELETE /api/admin/bookings/:id` - Delete booking

### Contacts
- `GET /api/admin/contacts` - List all contacts
- `GET /api/admin/contacts/:id` - Get specific contact
- `POST /api/admin/contacts` - Create new contact
- `PUT /api/admin/contacts/:id` - Update contact status
- `DELETE /api/admin/contacts/:id` - Delete contact

### Services
- `GET /api/admin/services` - List all services
- `GET /api/admin/services/:id` - Get specific service
- `POST /api/admin/services` - Create new service
- `PUT /api/admin/services/:id` - Update service
- `DELETE /api/admin/services/:id` - Delete service

### Team
- `GET /api/admin/team` - List all team members
- `GET /api/admin/team/:id` - Get specific team member
- `POST /api/admin/team` - Create new team member
- `PUT /api/admin/team/:id` - Update team member
- `DELETE /api/admin/team/:id` - Delete team member

### Settings
- `GET /api/admin/settings` - Get system settings
- `PUT /api/admin/settings` - Update system settings

## Dependencies

The admin module uses only existing project dependencies:

- **React** - UI framework
- **React Router DOM** - Client-side routing
- **TypeScript** - Type safety
- **Tailwind CSS** - Styling
- **Lucide React** - Icons
- **Existing UI Components** - From `src/components/ui/`
- **Existing Hooks** - From `src/hooks/`
- **Existing Utils** - From `src/utils/`

## Testing

Run the included smoke test:

```bash
npm test admin/__tests__/routes.test.tsx
```

The test verifies that the admin routes render correctly and display the expected navigation elements.

## File Structure

```
admin/
├── index.tsx                 # Main entry point and routing
├── AdminLayout.tsx          # Layout with sidebar and header
├── pages/
│   ├── Dashboard.tsx        # Dashboard with stats and overview
│   ├── Bookings/
│   │   ├── List.tsx        # Bookings list with search/filter
│   │   └── Detail.tsx      # Individual booking details
│   ├── Contacts/
│   │   ├── List.tsx        # Contacts list with search
│   │   └── Detail.tsx      # Individual contact details
│   ├── Services/
│   │   └── List.tsx        # Services CRUD interface
│   ├── Team/
│   │   └── List.tsx        # Team members CRUD interface
│   └── Settings.tsx         # System settings form
├── data/
│   └── adapter.ts          # Data layer abstraction
├── types.ts                # TypeScript type definitions
├── __tests__/
│   └── routes.test.tsx     # Basic smoke tests
└── README.md               # This file
```

## Customization

### Styling
The admin uses the same Tailwind configuration as your main app. All components follow the established design system with blue color scheme.

### Adding New Pages
1. Create a new component in `admin/pages/`
2. Add the route to `admin/index.tsx`
3. Add navigation link to `AdminLayout.tsx`
4. Add corresponding adapter functions if needed

### Modifying Data Structure
Update the interfaces in `admin/types.ts` and corresponding adapter functions in `admin/data/adapter.ts`.

## Security Considerations

When deploying to production:

1. **Authentication**: Add proper authentication checks
2. **Authorization**: Implement role-based access control
3. **API Security**: Use proper authentication headers
4. **Input Validation**: Validate all form inputs
5. **HTTPS**: Ensure all API calls use HTTPS
6. **Rate Limiting**: Implement API rate limiting

## Support

For questions or issues with the admin module, refer to the main project documentation or contact the development team.