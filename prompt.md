# 📌 AAC Innovation - Driving Africa’s Tech Future.

## Problem Statement

The client needs a professional, modern, and responsive corporate website to showcase their technology services. Currently, the company lacks a clear digital presence that communicates its service offerings, pricing models, appointment booking, and communication channels. This gap limits brand visibility and makes it harder for potential clients to understand what the company provides or schedule services.

## Vision

To establish a trusted online platform that highlights the company's expertise in cutting-edge digital solutions, positioning it as a leader in technology services across Africa.

## Mission

To provide innovative, scalable, and accessible digital services in areas such as cybersecurity, fintech, cloud computing, AI, IoT, and strategic consulting—helping businesses and individuals embrace the digital future.

### Design

Provide a tech-feel design application with premium designs and reusable UI and a well structured directory that is gonna accomodate PHP as the backend.

### Design System & Branding

- **Color Palette:** Tailwind built-in blue colors (blue-50 to blue-900) with centralized configuration for easy color customization
- **Primary Colors:** Blue-600 (primary), Blue-500 (secondary), with ability to change colors from one configuration file
- **Typography:** Plus Jakarta Sans (CDN integration)
- **Logo:** Use placeholder logo from `public/favicon.png` directory
- **Brand Tone:** Friendly and approachable while maintaining professionalism
- **Visual Assets:** Use Unsplash photos as placeholders (to be replaced with actual images later)

---

## Deliverables (what the AI / dev team will provide)

- A complete, production-ready frontend built with React + TypeScript (Vite) and Tailwind CSS.
- Complete React project structure with all boilerplate components and layouts.
- All configuration and scaffold files (see **Configuration & Tooling** section).
- Reusable UI components using Lucide icons and Framer Motion animations.
- Use of React router dom for routings.
- Real-time form validation using React Hook Form.
- Beautiful reusable toast notification component.
- Backend endpoints implemented in PHP with examples for appointment booking, contact form handling, and email notifications.
- Database schema and SQL for MySQL.
- Integration examples for email delivery and calendar sync.
- Deployment-ready instructions (Dockerfile, environment variables, and CI examples).

---

## Website Structure

### 1. Homepage

- Hero section with tagline and CTAs (Explore Services, Book Appointment, Contact Us).
- About Us section (short intro, mission statement).
- Service overview grid with icons and "Learn More" links.
- Quick booking widget (inline date/time picker CTA).

### 2. Services Page

Detailed breakdown of categories:

- Cybersecurity
- Fintech & Digital Payments
- Cloud & Enterprise Solutions
- AI & Automation
- Smart Tech & IoT
- Strategic Services

Each category includes:

- Short intro + benefits
- Sub-services list
- Suggested pricing model(s)
- CTA: Request a Quote / Book Consultation

### 3. Appointments & Booking

- Booking page for scheduling consultations or demos.
- Booking flow: select service → choose consultant/team (optional) → pick date & time → provide contact details → confirm.
- Calendar integration: Google Calendar / iCal export for client & internal team.
- Admin panel to view, approve, reschedule, or cancel bookings.
- Automated email confirmations and reminder notifications (configurable times: e.g., immediate, 24 hours, 1 hour).

### 4. Contact & Communication

- Contact page with form (Name, Email, Phone, Company, Message, Service of Interest).
- Direct contact options: phone number, email address, physical address, social links.
- Support / Contact routing: enquiries → sales, technical → support (email aliases or tagging).

### 5. Notifications & Emails

- Transactional emails for:

  - Booking confirmation
  - Booking reminders
  - Contact form receipt

- Suggested providers: Gmail

### 6. Pricing Models (Optional Page)

- Subscription
- One-time project fees
- Transaction-based fees
- Licensing
- Consulting

### 7. Footer

- Quick navigation links.
- Tagline: AAC Innovations – Driving Africa's Tech Future.
- Copyright and legal links (Privacy Policy, Terms of Service).

---

## Admin / Dashboard (For later)

- Admin dashboard for managing:

  - Bookings (approve, reschedule, cancel)
  - Contact leads (view, tag, export)
  - Service content (add/edit service pages)
  - Users and team members (roles: admin, sales, support)
  - Basic analytics (bookings, leads, conversion rates)

---

## Tech Stack & Libraries

- **Frontend:** React + TypeScript, Vite
- **Styling:** Tailwind CSS
- **Typography:** Plus Jakarta Sans (CDN)
- **Animations & UI:** Framer Motion, Lucide React (icons)
- **Form Validation:** React Hook Form with real-time validation
- **Notifications:** Custom reusable toast component
- **Backend:** PHP (procedural or with framework — examples provided for both plain PHP and Composer-based approaches)
- **Database:** MySQL
- **Emails:** Gmail
- **Calendar:** Google Calendar API / CalDAV / iCal exports
- **Dev Tools:** ESLint, Prettier, TypeScript config

---

## Configuration & Tooling (files the AI will generate)

_The project will include fully populated example config files so the developer can run and deploy the system immediately._

### Frontend Configuration Files

- **Package Management & Build:**

  - `package.json` (with scripts: dev, build, preview, lint, format)
  - `vite.config.ts` (with path aliases, plugins, and optimization)
  - `tsconfig.json` (strict TypeScript configuration)
  - `tsconfig.node.json` (Node.js TypeScript config for Vite)

- **Styling & UI:**

  - `tailwind.config.js` (custom theme, colors, fonts)
  - `postcss.config.js` (Tailwind CSS processing)
  - `src/index.css` (global styles and Tailwind imports)

- **Code Quality:**

  - `.eslintrc.cjs` (TypeScript + React + Tailwind rules)
  - `.prettierrc` (formatting configuration)
  - `.gitignore` (Node.js, build files, environment variables)

- **Environment & Deployment:**
  - `.env.example` (environment variable template)
  - `README.md` (setup, run & build instructions)
  - `Dockerfile` (containerized deployment)

### Frontend Project Structure

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
├── assets/              # Images, icons, and static files
└── styles/              # Additional CSS/styling files
```

### Backend (PHP) Configuration

- **Composer & Dependencies:**

  - `composer.json` (if using Composer-based libraries)
  - `config.example.php` (environment placeholder for DB, SMTP, API keys)

- **API Endpoints:**

  - `api/bookings.php` (booking form handling with validation)
  - `api/contact.php` (contact form handling with email sending)
  - `api/services.php` (service data endpoints)

- **Database:**
  - `migrations/` or `db/schema.sql` (MySQL schema and sample data)
  - `db/connection.php` (database connection configuration)

### Tests & Quality

- **Frontend Testing:**

  - `vitest.config.ts` (Vitest configuration for unit testing)
  - `src/__tests__/` (test files for components)
  - Basic unit test examples for frontend components (Vitest + React Testing Library)

- **Backend Testing:**
  - Sample PHP test file (if using PHPUnit)
  - API endpoint testing examples

---

## Security & Privacy

- Input validation and server-side sanitization for forms (bookings, contact form).
- Secure storage of credentials using environment variables (never commit secrets).
- Privacy: GDPR-friendly contact/lead consent checkbox and privacy policy placement.
- **Note:** Since this is a blog website for now, advanced security measures are not the primary focus.

---

## Accessibility & Performance

- Responsive and adaptive layout and mobile-first design.
- Image optimization and lazy-loading.
- Font-size scaling across devices.
- Lighthouse score considerations and suggested performance budgets.

---

## Content & Copy Guidance (for developer / copywriter)

- Keep headings short and benefit-driven.
- Use service cards with a 1–2 sentence summary and a clear CTA.
- Include case studies or success stories where possible.
- Include legal pages: Privacy Policy, Terms of Service, Cookie Policy.
- Maintain a friendly and approachable tone throughout all content.

---

## Suggested Project Milestones

1. **Project Setup & Configuration**

   - Generate all config files and boilerplate structure
   - Setup development environment and tools

2. **Discovery & Content Finalization**

   - Copy + images preparation
   - Design system implementation

3. **Core Frontend Development**

   - Scaffold frontend + basic pages (Homepage, Services, Contact)
   - Implement reusable UI components and layouts

4. **Backend & Integration**

   - Implement booking flow & backend endpoints
   - Database setup and API integration

5. **Advanced Features**

   - Admin dashboard + notifications
   - Email integration and calendar sync

6. **Quality Assurance**

   - QA, accessibility checks, and performance tuning
   - Testing and bug fixes

7. **Deployment**
   - Deploy to staging → production
   - Documentation and handover
