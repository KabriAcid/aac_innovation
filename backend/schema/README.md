# AAC Innovation Database Setup

This directory contains the complete database structure and sample data for the AAC Innovation website backend.

## 📋 Files Overview

### Core Database Files
- **`schema.sql`** - Complete MySQL database schema with all tables, relationships, indexes, views, stored procedures, and triggers
- **`sample-data.sql`** - Sample data including all services, team members, contacts, bookings, and system data
- **`setup.bat`** - Windows batch script for automated database setup
- **`setup.sh`** - Bash script for Linux/Mac automated database setup

## 🚀 Quick Setup (Recommended)

### For Windows (XAMPP):
1. Ensure XAMPP MySQL is running
2. Open Command Prompt/PowerShell in this directory
3. Run the setup script:
   ```cmd
   setup.bat
   ```

### For Linux/Mac:
1. Ensure MySQL is running
2. Open terminal in this directory
3. Make script executable and run:
   ```bash
   chmod +x setup.sh
   ./setup.sh
   ```

## 🔧 Manual Setup

If you prefer to set up manually or the scripts don't work:

### 1. Create Database
```sql
CREATE DATABASE aac_innovation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE aac_innovation;
```

### 2. Run Schema
```bash
mysql -u root -p aac_innovation < schema.sql
```

### 3. Load Sample Data (Optional)
```bash
mysql -u root -p aac_innovation < sample-data.sql
```

## 🗄️ Database Structure

### Core Tables
- **`services`** - All AAC Innovation services with pricing and features
- **`team_members`** - Company team members and consultants
- **`contacts`** - Contact form submissions and leads
- **`bookings`** - Service booking requests and appointments
- **`admin_users`** - Backend administration users
- **`email_logs`** - Email communication tracking
- **`newsletters`** - Newsletter subscriptions
- **`system_settings`** - Application configuration
- **`activity_logs`** - System activity audit trail
- **`booking_history`** - Historical booking status changes

### Key Features
- ✅ **Foreign Key Relationships** - Proper data integrity
- ✅ **Indexes** - Optimized for performance
- ✅ **Views** - Simplified data access
- ✅ **Stored Procedures** - Business logic encapsulation
- ✅ **Triggers** - Automated data updates
- ✅ **UTF8MB4 Charset** - Full Unicode support including emojis

## 📊 Sample Data Included

### Services (19 total)
- **Cybersecurity**: Penetration Testing, Security Consulting
- **Fintech**: Payment Gateway, Digital Wallet Development
- **Cloud & Enterprise**: Cloud Migration, Enterprise Solutions
- **AI & Automation**: AI Chatbots, Process Automation
- **Smart Tech & IoT**: IoT Solutions, Smart Home Automation
- **Strategic**: Digital Transformation, Technology Audit
- **Mobile Development**: iOS, Android, Cross-Platform, Testing
- **Web Development**: Custom Development, E-commerce, Maintenance

### Team Members (3 total)
- John Doe - Chief Technology Officer
- Jane Smith - Cybersecurity Lead  
- Mike Johnson - AI/ML Engineer

### Sample Data
- 5 Contact form submissions
- 4 Booking requests
- Email communication logs
- Newsletter subscriptions
- System activity tracking

## 🔗 Database Connection

### Default XAMPP Configuration
```php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'aac_innovation';
$port = 3306;
```

### Connection String Examples

**PHP (MySQLi)**
```php
$mysqli = new mysqli('localhost', 'root', '', 'aac_innovation');
```

**PHP (PDO)**
```php
$pdo = new PDO('mysql:host=localhost;dbname=aac_innovation;charset=utf8mb4', 'root', '');
```

**Node.js (mysql2)**
```javascript
const mysql = require('mysql2');
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'aac_innovation'
});
```

## 🔍 Verification

After setup, verify your installation:

### Check Tables
```sql
SHOW TABLES;
-- Should show 10 tables
```

### Check Sample Data
```sql
SELECT COUNT(*) FROM services;        -- Should show 19
SELECT COUNT(*) FROM team_members;    -- Should show 3  
SELECT COUNT(*) FROM contacts;        -- Should show 5 (if sample data loaded)
```

### Test Views
```sql
SELECT * FROM active_services LIMIT 5;
SELECT * FROM recent_contacts LIMIT 5;
```

## 🌐 Admin Access

### phpMyAdmin
- URL: `http://localhost/phpmyadmin`
- Username: `root`
- Password: (empty for default XAMPP)
- Database: `aac_innovation`

### MySQL Command Line
```bash
mysql -u root -p
USE aac_innovation;
SHOW TABLES;
```

## 🚨 Troubleshooting

### Common Issues

**MySQL Connection Failed**
- Ensure XAMPP MySQL service is running
- Check MySQL port (default: 3306)
- Verify credentials (default XAMPP: root/empty password)

**Permission Denied**
- Run command prompt as Administrator (Windows)
- Check MySQL user permissions

**Character Set Issues**
- Ensure database uses `utf8mb4` charset
- Check MySQL version (5.7+ recommended)

**File Not Found**
- Ensure you're in the `backend/db` directory
- Check file permissions

### Reset Database
If you need to start over:
```sql
DROP DATABASE IF EXISTS aac_innovation;
-- Then run setup again
```

## 📝 Customization

### Adding New Services
```sql
INSERT INTO services (id, title, description, category, pricing_starting_price, is_active) 
VALUES ('new-service', 'New Service', 'Description', 'category', '₦1,000,000', TRUE);
```

### Adding Team Members
```sql
INSERT INTO team_members (id, name, role, expertise, is_active) 
VALUES ('new-member', 'Name', 'Role', '["Skill1", "Skill2"]', TRUE);
```

### Modifying Schema
- Edit `schema.sql` for structural changes
- Create migration scripts for production updates
- Always backup before making changes

## 🔒 Security Notes

### Production Setup
- Change default MySQL root password
- Create dedicated database user with limited privileges
- Enable SSL connections
- Regular database backups
- Monitor access logs

### Recommended User Setup
```sql
CREATE USER 'aac_app'@'localhost' IDENTIFIED BY 'secure_password';
GRANT SELECT, INSERT, UPDATE, DELETE ON aac_innovation.* TO 'aac_app'@'localhost';
FLUSH PRIVILEGES;
```

## 📞 Support

If you encounter issues:
1. Check XAMPP MySQL is running
2. Verify file paths and permissions
3. Check MySQL error logs
4. Ensure proper character encoding

For additional help, refer to the main project README or contact the development team.

---

**Database Version**: 1.0  
**MySQL Version**: 5.7+ required  
**Character Set**: UTF8MB4  
**Last Updated**: 2024