# Admin Dashboard Documentation

## Overview
The admin dashboard provides comprehensive management tools for appointments, contact messages, analytics, and sales funnel tracking.

## Access
- **URL**: `/admin`
- **Default Credentials**:
  - Email: `admin@shadesoftx.com`
  - Password: `password123`
  
**⚠️ IMPORTANT**: Change the default password immediately after first login for production use.

## Features

### Dashboard
- Real-time metrics for appointments, messages, and page views
- Conversion rate tracking
- Financial metrics (quotes, sales, close rate)
- Visual charts for appointments and page views (last 30 days)
- Recent activity overview
- Service popularity stats
- Device breakdown

### Appointment Management
- View all appointments with filtering (status, service type, date range, search)
- Detailed appointment view with customer info and timeline
- Status tracking (pending, confirmed, completed, cancelled, no_show)
- Quote and sale amount tracking
- Admin assignment
- Bulk actions (confirm, complete, cancel, assign, delete)
- CSV export

### Message Management
- Inbox view with unread highlighting
- Message status tracking (unread, read, replied, archived)
- Admin assignment
- Admin notes
- Quick actions (email reply, phone call)

### Analytics
- Traffic statistics (total views, unique visitors, avg daily views)
- Daily and hourly traffic charts
- Top pages and referrers
- Device and browser breakdown
- Service popularity tracking
- Date range filtering (7, 30, 90 days)

### Sales Funnel
- Visual funnel representation
- Conversion rates at each stage:
  - Homepage → Service List
  - Service List → Service Details
  - Service Details → Booking Page
  - Booking Page → Completed Booking
- Drop-off analysis
- Bookings by service type

### Settings
- Profile management (name, email)
- Password change
- Account information
- Team management (super admin only)

## User Roles

### Super Admin
- Full access to all features
- Can manage team members
- Can create/delete admin users

### Admin
- Full access to appointments and messages
- Can view analytics
- Cannot manage team members

### Viewer
- Read-only access
- Can view all data but cannot make changes

## Page View Tracking

The dashboard automatically tracks page views with the following information:
- Page URL and name
- Referrer
- IP address
- Device type (mobile, tablet, desktop)
- Session ID

Page views are used for analytics and funnel tracking.

## Technical Details

### Database Tables
- `admin_users` - Admin user accounts
- `page_views` - Page view tracking
- `appointments` - Extended with status, quotes, sales, assignment
- `contact_messages` - Extended with status, notes, assignment

### Middleware
- `admin.auth` - Protects admin routes
- `TrackPageView` - Automatically tracks page views (web routes only)

### Authentication
- Separate admin guard using session driver
- Admin users are separate from regular users
- Remember me functionality

## Deployment Notes

1. Run migrations: `php artisan migrate`
2. Seed admin user: `php artisan db:seed --class=AdminUserSeeder`
3. Change default password immediately
4. Configure environment variables as needed
5. Ensure proper file permissions
6. Set up SSL/HTTPS for production

## Customization

### Colors
The admin dashboard uses Texas-themed colors defined in `/public/css/admin.css`:
- Primary: #C8102E (Texas Red)
- Dark: #1a1a1a
- Accent: #0033A0

### Charts
Charts are powered by Chart.js loaded via CDN. For offline use, download Chart.js locally.

## Support

For issues or questions, contact the development team.
