/*
  # Database Schema for AAC Innovation Website

  1. New Tables
    - `contacts` - Stores contact form submissions
      - `id` (int, primary key, auto increment)
      - `first_name` (varchar 100, not null)
      - `last_name` (varchar 100, not null)
      - `email` (varchar 255, not null)
      - `phone` (varchar 20, nullable)
      - `company` (varchar 255, nullable)
      - `service_interest` (varchar 100, nullable)
      - `message` (text, not null)
      - `created_at` (timestamp, default current timestamp)

    - `bookings` - Stores consultation booking requests
      - `id` (int, primary key, auto increment)
      - `client_name` (varchar 255, not null)
      - `client_email` (varchar 255, not null)
      - `client_phone` (varchar 20, not null)
      - `company` (varchar 255, nullable)
      - `service_id` (varchar 100, not null)
      - `consultant_id` (varchar 100, nullable)
      - `scheduled_date` (date, not null)
      - `scheduled_time` (time, not null)
      - `message` (text, nullable)
      - `status` (enum: pending, confirmed, cancelled, completed)
      - `created_at` (timestamp, default current timestamp)
      - `updated_at` (timestamp, default current timestamp on update)

  2. Indexes
    - Index on contacts.email for faster lookups
    - Index on bookings.scheduled_date and scheduled_time for conflict checking
    - Index on bookings.status for filtering

  3. Notes
    - All tables use UTF-8 character set
    - Timestamps are in UTC
    - Email fields are validated at application level
    - Phone numbers stored as strings to handle international formats
*/

-- Create contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    company VARCHAR(255),
    service_interest VARCHAR(100),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_name VARCHAR(255) NOT NULL,
    client_email VARCHAR(255) NOT NULL,
    client_phone VARCHAR(20) NOT NULL,
    company VARCHAR(255),
    service_id VARCHAR(100) NOT NULL,
    consultant_id VARCHAR(100),
    scheduled_date DATE NOT NULL,
    scheduled_time TIME NOT NULL,
    message TEXT,
    status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (client_email),
    INDEX idx_schedule (scheduled_date, scheduled_time),
    INDEX idx_status (status),
    INDEX idx_service (service_id),
    INDEX idx_created_at (created_at),
    UNIQUE KEY unique_booking (scheduled_date, scheduled_time, status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create services table (optional - for dynamic service management)
CREATE TABLE IF NOT EXISTS services (
    id VARCHAR(100) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    features JSON,
    pricing JSON,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample services data (optional)
INSERT IGNORE INTO services (id, title, description, category, features, pricing) VALUES
('penetration-testing', 'Penetration Testing', 'Comprehensive security assessments to identify vulnerabilities in your systems and applications.', 'cybersecurity', 
 JSON_ARRAY('Network penetration testing', 'Web application security testing', 'Mobile app security assessment', 'Social engineering testing', 'Detailed vulnerability reports', 'Remediation recommendations'),
 JSON_OBJECT('model', 'one-time', 'startingPrice', '₦2,125,000', 'description', 'Starting price for basic penetration testing')),

('payment-gateway', 'Payment Gateway Integration', 'Seamless integration of secure payment processing solutions for your business.', 'fintech',
 JSON_ARRAY('Multi-currency support', 'Mobile money integration', 'Card payment processing', 'Real-time transaction monitoring', 'Fraud detection and prevention', 'PCI DSS compliance'),
 JSON_OBJECT('model', 'transaction', 'startingPrice', '2.5% + ₦255', 'description', 'Per transaction fee')),

('cloud-migration', 'Cloud Migration Services', 'Seamless migration of your infrastructure and applications to the cloud.', 'cloud',
 JSON_ARRAY('AWS, Azure, GCP migration', 'Application modernization', 'Data migration and backup', 'Performance optimization', 'Cost optimization strategies', '24/7 migration support'),
 JSON_OBJECT('model', 'one-time', 'startingPrice', '₦4,250,000', 'description', 'Starting price for basic cloud migration'));