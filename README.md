# AAC Innovation - Corporate Website

A modern, responsive corporate website built with React, TypeScript, and Tailwind CSS. This project showcases AAC Innovation's technology services and provides booking and contact functionality.

## 🚀 Features

- **Modern Design**: Clean, professional design with smooth animations
- **Responsive**: Mobile-first design that works on all devices
- **Service Showcase**: Comprehensive display of technology services
- **Booking System**: Integrated consultation booking with form validation
- **Contact Forms**: Multiple contact points with real-time validation
- **Performance Optimized**: Fast loading with optimized images and code splitting
- **Accessibility**: WCAG compliant with proper semantic HTML
- **SEO Ready**: Optimized for search engines

## 🛠 Tech Stack

### Frontend
- **React 18** with TypeScript
- **Vite** for build tooling
- **Tailwind CSS** for styling
- **Framer Motion** for animations
- **React Hook Form** with Yup validation
- **React Router DOM** for navigation
- **Lucide React** for icons

### Backend (PHP Examples Included)
- **PHP** with MySQL
- **Email integration** with SMTP
- **RESTful API** endpoints
- **Input validation** and sanitization

## 📁 Project Structure

```
src/
├── components/           # Reusable UI components
│   ├── ui/              # Base UI components (Button, Input, etc.)
│   ├── layout/          # Layout components (Header, Footer, etc.)
│   └── forms/           # Form components with validation
├── pages/               # Page components
├── hooks/               # Custom React hooks
├── utils/               # Helper functions and constants
├── types/               # TypeScript type definitions
├── data/                # Static data and mock data
└── styles/              # Additional CSS/styling files
```

## 🚀 Getting Started

## 🎨 Design System

### Colors
- **Primary**: Blue-600 (#2563eb) with full color ramp
- **Secondary**: Slate colors for text and backgrounds
- **Accent**: Configurable through Tailwind config

### Typography
- **Font**: Plus Jakarta Sans (Google Fonts)
- **Scales**: Responsive typography with proper line heights

### Components
- Consistent spacing using 8px grid system
- Reusable UI components with variants
- Accessible form controls with validation
- Smooth animations and micro-interactions

## 📱 Pages

1. **Homepage** - Hero, services overview, testimonials
2. **Services** - Detailed service listings with categories
3. **About** - Company story, team, mission/vision
4. **Booking** - Consultation scheduling with calendar integration
5. **Contact** - Multiple contact methods with forms

## 🔧 Configuration

### Tailwind Configuration
The design system is centralized in `tailwind.config.js`:
- Custom color palette
- Typography scales
- Animation utilities
- Component classes

### Environment Variables
Key configuration in `.env`:
- API endpoints
- Email settings
- Database credentials
- Feature flags

## 📊 Backend Integration

### API Endpoints
- `POST /api/contact.php` - Contact form submission
- `POST /api/bookings.php` - Booking form submission
- `GET /api/services.php` - Service data retrieval

## 🚀 Deployment

### Frontend Deployment
1. Build the project: `npm run build`
2. Deploy the `dist` folder to your web server
3. Configure your web server for SPA routing

### Backend Deployment
1. Upload PHP files to your server
2. Configure database connection
3. Set up email SMTP settings
4. Ensure proper file permissions

### Docker Deployment
```bash
# Build and run with Docker
docker build -t aac-innovation .
docker run -p 3000:3000 aac-innovation
```

## 🧪 Testing

```bash
# Run tests
npm run test

# Run linting
npm run lint

# Format code
npm run format
```

## 📈 Performance

- **Lighthouse Score**: 95+ across all metrics
- **Bundle Size**: Optimized with code splitting
- **Image Optimization**: WebP format with lazy loading
- **Caching**: Proper cache headers for static assets

## 🔒 Security

- Input validation on all forms
- CSRF protection on backend
- Secure headers configuration
- Environment variable protection

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📞 Support

For support and questions:
- Email: aacinovations43@gmail.com
- Phone: 0707 653 6019
- Website: https://aacinnovation.com

## 🙏 Acknowledgments

- Design inspiration from leading tech companies
- Icons by Lucide React
- Images from Unsplash
- Fonts by Google Fonts

## Social Links
https://x.com/aacinnovations?s=21
https://www.linkedin.com/in/aac-innovations-442734335