### **Project Overview**
This project is a web-based platform designed to showcase the services and expertise of AAC Innovation, a company committed to driving technological advancement across Africa. The platform aims to provide users with an intuitive and visually appealing interface to explore the company's offerings, learn about its mission, and engage with its services. The focus is on simplicity, performance, and responsiveness.

---

### **Key Details**
1. **Purpose**: To create a modern, user-friendly website that highlights AAC Innovation's services, mission, and client testimonials.
2. **Frontend Framework**: Vanilla HTML, JavaScript, and Tailwind CSS for styling.
3. **Backend**: PHP for dynamic content rendering and reusable components.
4. **Design Philosophy**: Clean, minimalistic, and responsive design with a focus on accessibility and performance.
5. **Icons**: Use Lucide icons for a lightweight and scalable solution.
6. **Styling**: Tailwind CSS is used for consistent and customizable styling, with a configuration that includes custom themes, animations, and colors.

---

### **Features to Implement**
1. **Homepage**:
   - Hero section with a carousel showcasing key visuals (e.g., team, services, and mission).
   - About section with a description of the company's mission and key points.
   - Services overview with dynamic content highlighting service categories.
   - Featured services section showcasing popular offerings.
   - Testimonials section with client feedback.
   - Quick booking widget for scheduling consultations.

2. **Services Page**:
   - Display a list of services fetched dynamically from the backend.
   - Allow filtering by service categories.
   - Include detailed descriptions, icons, and pricing models for each service.

3. **Booking System**:
   - Booking form for scheduling consultations with validation for required fields.
   - Integration with the backend API to store booking details.
   - Confirmation messages and notifications for successful bookings.

4. **Admin Panel**:
   - Dashboard for viewing key metrics and recent activity.
   - Manage services (CRUD operations).
   - View and manage bookings, including status updates.
   - Configure system settings such as company info, social media links, and business hours.

5. **Reusable Components**:
   - **Header**: Navigation bar with links to Home, About, Services, and Contact pages, along with a logo and call-to-action buttons.
   - **Footer**: Contains company info, quick links, and contact details.

6. **Static Assets**:
   - Include images for the hero carousel and other sections (e.g., team photos, service visuals).

7. **Icons**:
   - Replace FontAwesome with Lucide icons. Use the Lucide CDN or fallback to the `lucide.icon()` method for dynamic rendering.

8. **Responsiveness**:
   - Ensure the design is fully responsive and works seamlessly across devices of all sizes.

---

### **Backend API Endpoints**
1. **Services**:
   - `GET /api/services.php`: Retrieve all active services.
   - `POST /api/services.php`: Create a new service.
   - `PUT /api/services.php?id={id}`: Update an existing service.
   - `DELETE /api/services.php?id={id}`: Delete a service.

2. **Bookings**:
   - `GET /api/bookings.php`: Retrieve all bookings.
   - `POST /api/bookings.php`: Create a new booking.
   - `PUT /api/bookings.php?id={id}`: Update booking details.
   - `DELETE /api/bookings.php?id={id}`: Delete a booking.

3. **Admin**:
   - `GET /api/admin/settings.php`: Retrieve system settings.
   - `PUT /api/admin/settings.php`: Update system settings.

---

### **Prompt for AI**
"Build a web-based platform for AAC Innovation, a company dedicated to driving technological advancement across Africa. The platform should include the following:

1. **Homepage**:
   - A hero section with a carousel showcasing key visuals.
   - An about section describing the company's mission and key points.
   - A services overview section with dynamic content highlighting service categories.
   - A featured services section showcasing popular offerings.
   - A testimonials section with client feedback.
   - A quick booking widget for scheduling consultations.

2. **Services Page**:
   - Display a list of services fetched dynamically from the backend.
   - Allow filtering by service categories.
   - Include detailed descriptions, icons, and pricing models for each service.

3. **Booking System**:
   - A booking form for scheduling consultations with validation for required fields.
   - Integration with the backend API to store booking details.
   - Confirmation messages and notifications for successful bookings.

4. **Admin Panel**:
   - A dashboard for viewing key metrics and recent activity.
   - Manage services (CRUD operations).
   - View and manage bookings, including status updates.
   - Configure system settings such as company info, social media links, and business hours.

5. **Styling**:
   - Use Tailwind CSS for consistent and customizable styling.
   - Include custom themes, animations, and colors in the Tailwind configuration.

6. **Icons**:
   - Use Lucide icons for a lightweight and scalable solution.

7. **Responsiveness**:
   - Ensure the design is fully responsive and works seamlessly across devices of all sizes.

The platform should be built using vanilla HTML, JavaScript, and PHP, with a focus on simplicity, performance, and responsiveness."
