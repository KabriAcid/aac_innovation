# 📌 AAC Innovation - Driving Africa’s Tech Future.

## Problem Statement

The client needs a professional, modern, and responsive corporate website to showcase their technology services. Currently, the company lacks a clear digital presence that communicates its service offerings, pricing models, appointment booking, and communication channels. This gap limits brand visibility and makes it harder for potential clients to understand what the company provides or schedule services.

## Vision

To establish a trusted online platform that highlights the company's expertise in cutting-edge digital solutions, positioning it as a leader in technology services across Africa.

## Mission

To provide innovative, scalable, and accessible digital services in areas such as cybersecurity, fintech, cloud computing, AI, IoT, and strategic consulting—helping businesses and individuals embrace the digital future.

### Design

Provide a mobile-first, responsive/adaptive, tech-feel design application with premium designs and reusable UI and a well structured directory that is gonna accomodate PHP as the backend.

- Tables should be fully responsive (scrollable on mobile with no scrollbars)

### Design System & Branding

- **Color Palette:** Tailwind built-in blue colors (blue-50 to blue-900) with centralized configuration for easy color customization
- **Primary Colors:** Blue-600 (primary), Blue-500 (secondary), with ability to change colors from one configuration file
- **Typography:** Plus Jakarta Sans (CDN integration)
- **Logo:** Use placeholder logo from `public/favicon.png` directory
- **Brand Tone:** Friendly and approachable while maintaining professionalism
- **Visual Assets:** Use Unsplash photos as placeholders (to be replaced with actual images later)

---

## Deliverables (what the AI / dev team will provide)

- A complete, production-ready frontend built with React + TypeScript (Vite) and Tailwind CSS, Lucide, Framer-motion.
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
Goal

Generate a drop-in `admin` directory (React + TypeScript, Vite) for the AAC Innovation project that I can export/import into this repo and then only wire up in `App.tsx` (i.e., add a Route for `/admin/*` and render the generated admin module). The generated output should be self-contained under `admin/` and conform to the project's existing design system, hooks, and patterns.

Scope and deliverables

- Create an `admin/` directory that contains a ready-to-import React module exposing default export `AdminRoutes` (React component) and a single `index.ts` that re-exports. The app should be importable like: `import AdminRoutes from './admin';` and mounted in `App.tsx` at `/admin/*`.
- The `admin/` module should rely only on existing project dependencies and components in `src/components/*`, `src/components/ui/*`, `src/hooks/*`, and `src/utils/*` where appropriate. Avoid introducing new third-party libraries.
- Provide pages: Dashboard, Bookings (list + detail), Contacts (list + detail), Services (list + CRUD scaffold), Team (list + edit), Settings (simple form). Each page should use existing UI primitives (Card, Button, Input, Select, Toast) and patterns (useToast), and be responsive.
- Use the project's Tailwind-based styling and existing utility functions (`cn`, `formatDate`, `formatTime`, `generateId`). Keep classNames consistent with app style.
- Routing: `AdminRoutes` should use `react-router-dom` v6 routes and nested routing (e.g., `/admin`, `/admin/bookings`, `/admin/bookings/:id`, `/admin/contacts`, `/admin/services`, `/admin/team`, `/admin/settings`). Export `AdminRoutes` as default and also export `adminRoutes` array (route definitions) for potential code-splitting.
- Data layer: For now, implement a simple client-side mock data provider inside `admin/data/` that reads from `localStorage` with a small adapter API: `listBookings()`, `getBooking(id)`, `createBooking()`, `updateBooking()`, `listContacts()`, etc. Use `generateId()` and persist changes to `localStorage`. Keep types using the existing `src/types` interfaces where possible (e.g., `Appointment` for bookings). Document how to switch the adapter to the real backend (simple fetch examples).
- Accessibility: Use semantic HTML for tables/lists, buttons, forms; ensure focus management for modals and keyboard navigation where relevant.
- Tests: Add a minimal smoke test file `admin/__tests__/routes.test.tsx` that mounts `AdminRoutes` (using React Testing Library) and asserts the dashboard renders. Keep tests optional; if the project has no test infra, add instructions to run it.
- README: Add `admin/README.md` explaining how to import and mount in `src/App.tsx`, how to switch the data adapter to a real backend, and any assumptions.

Design philosophy / conventions to follow (extracted from codebase)

- Component-first primitives
  - Use existing UI primitives in `src/components/ui/` (Card, Button, Input, Select, Textarea, Checkbox, Toast, Modal) for layout and controls.
  - Keep components small and composable; pages should assemble these primitives rather than reinvent styles.

- Hooks & patterns
  - Use `useToast()` for user feedback (success/error). Reuse `ToastContainer` in Layout for global toasts.
  - Use form handling via controlled inputs and plain React state; where forms are complex, follow current project patterns (Yup + react-hook-form used in forms, but admin can also use controlled forms if simpler).
  - Utilities: use `cn()` from `src/utils/helpers.ts` for conditional classes, `formatDate` / `formatTime` for date/time displays, and `generateId()` for mock IDs.

- Folder and import conventions
  - Project uses absolute imports via `@/` alias. Use the same alias when referencing shared components (e.g., `import { Button } from '@/components/ui/Button';`).
  - Keep all admin files under `admin/` top-level folder to make import/export trivial.

- TypeScript
  - Use the existing types in `src/types/index.ts` (for bookings, contacts, etc.). Keep the admin module strongly typed and export types where helpful.

- Responsiveness and layout
  - Admin layout should include a left sidebar (collapsible) and a main content area. Reuse the Layout/Header primitives where practical or implement a light admin-specific header. Keep spacing and typography consistent with the app.

Concrete implementation notes for the Generator (Bolt Ai)

- Files to create under `admin/` (minimum):
  - `admin/index.tsx` (default export `AdminRoutes`) — mounts `BrowserRouter`-compatible nested routes.
  - `admin/AdminLayout.tsx` — sidebar + header + content area that wraps admin pages.
  - `admin/pages/Dashboard.tsx`
  - `admin/pages/Bookings/List.tsx`
  - `admin/pages/Bookings/Detail.tsx`
  - `admin/pages/Contacts/List.tsx`
  - `admin/pages/Contacts/Detail.tsx`
  - `admin/pages/Services/List.tsx` (with scaffolded create/edit modal or panel)
  - `admin/pages/Team/List.tsx` (simple edit drawer/modal)
  - `admin/pages/Settings.tsx` (form mapping to `system_settings` concept)
  - `admin/data/adapter.ts` (localStorage adapter + exported `adapter` object with CRUD methods)
  - `admin/types.ts` (local type aliases referencing `@/types` where possible)
  - `admin/README.md`
  - optional: `admin/__tests__/routes.test.tsx`

- Code style & exports
  - `admin/index.tsx` should export default `AdminRoutes` and named `adminRoutes` array:
    - default export example: `export default AdminRoutes;`
    - named: `export const adminRoutes = [{ path: '/admin', element: <AdminRoutes/> }, ...]`

- Integration instructions (append to README):
  1. Copy the generated `admin/` folder into the project root.
  2. In `src/App.tsx`, add:

```tsx
import AdminRoutes from './admin';
...
<Route path="/admin/*" element={<AdminRoutes/>} />
```

  3. To connect the admin to your real backend, replace the functions in `admin/data/adapter.ts` with fetch calls to your API (examples included).

- Non-goals / constraints
  - Do not modify `src/App.tsx` or other existing app files in the generator output — the admin module must be import-first and non-invasive.
  - Avoid adding new dependencies; rely on existing project packages (React, react-router-dom, react-hook-form, yup, lucide-react, tailwind CSS). If a small helper is needed, implement it inside `admin/utils`.

Deliver the prompt as a single `prompt.md` file ready to paste into Bolt Ai. The prompt should be action-oriented (tell the generator what files to produce, the exact exports, routing structure, and styling constraints) and include code examples for integration and for switching from the localStorage adapter to fetch-based backend.

Assumptions

- The existing project root uses TypeScript, Vite, Tailwind, React 18, react-router-dom v6, and the `@/` import alias.
- Shared components live under `src/components/*` and primitives under `src/components/ui/*`.
- Types are defined in `src/types/index.ts`.

End of prompt
- **Dev Tools:** ESLint, Prettier, TypeScript config
