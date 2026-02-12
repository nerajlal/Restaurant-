# 🍽️ Live QR Ordering System - Restaurant Management

A modern, full-featured **QR Code-based Restaurant Ordering & Management System** built with **Laravel 12**. This system enables contactless dining with real-time order tracking, comprehensive analytics, and a premium admin dashboard.

[![Laravel](https://img.shields.io/badge/Laravel-12.0-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## ✨ Key Features

### 🎯 QR Code Ordering System
- **Contactless Ordering**: Customers scan QR codes at tables to access the digital menu
- **Table-Based Sessions**: Each table has a unique QR code for order tracking
- **Real-Time Cart**: Add items, customize quantities, and place orders instantly
- **Order Notes**: Customers can add special instructions for each item

### 📱 Public Website
- **Premium Design**: Modern dark/gold theme with smooth animations
- **Digital Menu**: Filterable menu by categories (Starters, Mains, Desserts, Beverages)
- **Responsive Layout**: Fully optimized for mobile, tablet, and desktop
- **About & Contact Pages**: Restaurant information and location details

### 🎛️ Admin Dashboard (Modern Analytics)
- **Comprehensive Analytics**:
  - Today's revenue and total revenue tracking
  - Order statistics by status (pending, confirmed, preparing, ready, served)
  - Active tables with utilization percentage
  - Average order value calculations
  
- **Interactive Charts** (Chart.js):
  - 📈 Revenue trend (last 7 days) - Line chart
  - 🍩 Order status distribution - Doughnut chart
  - 📊 Top 5 selling items - Horizontal bar chart
  
- **Key Metrics Cards**:
  - Gradient-styled cards with real-time statistics
  - Quick action buttons (Live Orders, Manage Menu)
  - Recent orders table with status badges

### 🔴 Live Orders Management
- **Real-Time Order Monitoring**: Auto-refreshing order display (5-second polling)
- **Audio Alerts**: Customizable alarm sound for new orders with toggle control
- **Status Workflow**: 
  - Pending → Confirmed → Preparing → Ready → Served
  - Quick action buttons for each status transition
- **Order Details**: View items, quantities, prices, customer notes, and table information
- **Visual Indicators**: Color-coded cards and status badges

### 📋 Menu Management
- **Categories**: Create and manage menu categories with images
- **Menu Items**: 
  - Full CRUD operations
  - Price management
  - Descriptions and dietary flags (Vegetarian, Active/Inactive)
  - Image uploads
  
### 🪑 Table Management
- **Table Creation**: Add tables with custom names
- **QR Code Generation**: 
  - Instant SVG QR code generation for each table
  - Downloadable QR codes for printing
  - Unique tokens for secure table access
  
### 🛒 Shopping Cart System
- Session-based cart for customers
- Real-time price calculations
- Quantity adjustments
- Order placement with table association

---

## 🛠️ Technology Stack

### Backend
- **Framework**: Laravel 12
- **PHP**: 8.2+
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **QR Codes**: SimpleSoftwareIO/simple-qrcode

### Frontend
- **Templating**: Blade Templates
- **CSS Framework**: Bootstrap 5
- **Charts**: Chart.js 4.4.0
- **Icons**: FontAwesome
- **Animations**: Custom CSS with gradients

### Development Tools
- **Package Manager**: Composer
- **Asset Bundler**: Vite
- **Testing**: PHPUnit

---

## ⚙️ Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL
- Node.js & NPM

### Step-by-Step Setup

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd Restaurant
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node Dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   
   Update `.env` with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=restaurant
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Run Migrations & Seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```
   
   This will create:
   - Admin user account
   - Sample categories (Starters, Mains, Desserts, Beverages)
   - Sample menu items
   - Test tables
   - Sample orders for testing

8. **Build Frontend Assets**
   ```bash
   npm run build
   ```
   
   For development with hot reload:
   ```bash
   npm run dev
   ```

9. **Start the Application**
   ```bash
   php artisan serve
   ```
   
   Visit: `http://127.0.0.1:8000`

---

## 🔑 Default Credentials

### Admin Account
- **Email**: `admin@example.com`
- **Password**: `password`

### Test User Account
- **Email**: `adi@gmail.com`
- **Password**: `password`

> ⚠️ **Important**: Change these credentials in production!

---

## 📂 Project Structure

```
Restaurant/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       │   ├── DashboardController.php    # Analytics & charts
│   │       │   ├── CategoryController.php     # Category management
│   │       │   ├── MenuItemController.php     # Menu item CRUD
│   │       │   ├── OrderController.php        # Live orders & status
│   │       │   ├── TableController.php        # Table & QR management
│   │       │   └── QrCodeController.php       # QR code generation
│   │       ├── CartController.php             # Shopping cart logic
│   │       ├── HomeController.php             # Public homepage
│   │       └── MenuController.php             # Public menu & QR login
│   └── Models/
│       ├── Category.php
│       ├── MenuItem.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Table.php
│       └── User.php
├── database/
│   ├── migrations/                            # Database schema
│   └── seeders/
│       ├── DatabaseSeeder.php                 # Main seeder
│       ├── MenuSeeder.php                     # Sample menu data
│       ├── TableSeeder.php                    # Sample tables
│       └── OrderSeeder.php                    # Sample orders
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php            # Admin dashboard
│       │   ├── orders/
│       │   │   └── live.blade.php             # Live orders page
│       │   ├── categories/                    # Category views
│       │   ├── menu_items/                    # Menu item views
│       │   └── tables/                        # Table management
│       ├── menu/
│       │   └── index.blade.php                # Public menu
│       ├── cart/
│       │   └── index.blade.php                # Shopping cart
│       ├── home.blade.php                     # Homepage
│       └── layouts/
│           ├── app.blade.php                  # Admin layout
│           └── public.blade.php               # Public layout
├── public/
│   └── sounds/
│       └── alarm.wav                          # Order notification sound
└── routes/
    └── web.php                                # Application routes
```

---

## 🚀 Usage Guide

### For Restaurant Owners/Admins

1. **Login to Admin Panel**
   - Navigate to `/login`
   - Use admin credentials
   - Access dashboard at `/admin/dashboard`

2. **Setup Tables**
   - Go to **Tables** section
   - Create tables with custom names
   - Download QR codes for each table
   - Print and place QR codes on tables

3. **Manage Menu**
   - Create **Categories** (e.g., Starters, Mains)
   - Add **Menu Items** with prices, descriptions, and images
   - Toggle items active/inactive as needed

4. **Monitor Orders**
   - Access **Live Orders** page
   - View real-time order updates
   - Update order status through workflow
   - Audio alerts notify you of new orders

5. **View Analytics**
   - Dashboard shows revenue trends
   - Track top-selling items
   - Monitor table utilization
   - View order statistics

### For Customers

1. **Scan QR Code**
   - Scan the QR code on your table
   - Automatically logged in to table session

2. **Browse Menu**
   - View all available items
   - Filter by categories
   - Read descriptions and prices

3. **Place Order**
   - Add items to cart
   - Adjust quantities
   - Add special notes
   - Submit order

4. **Track Order**
   - Order appears in kitchen system
   - Staff updates status in real-time
   - Wait for order to be served

---

## 🎨 Features Breakdown

### Admin Dashboard Analytics

**Metric Cards:**
- 🟣 **Today's Revenue**: Current day earnings with total revenue
- 🔴 **Today's Orders**: Order count with pending orders
- 🔵 **Active Tables**: Currently occupied tables with utilization %
- 🟢 **Average Order Value**: Mean order amount

**Charts:**
- **Revenue Trend**: 7-day line chart showing daily revenue
- **Order Status**: Doughnut chart showing order distribution
- **Top Sellers**: Horizontal bar chart of best-selling items

### Live Orders System

**Features:**
- Auto-refresh every 5 seconds
- Sound toggle for notifications
- Color-coded status badges
- Quick action buttons
- Customer notes display
- Time tracking (created time)

**Order Workflow:**
```
Pending → Confirmed → Preparing → Ready → Served
```

### QR Code System

**How It Works:**
1. Admin creates a table
2. System generates unique token
3. QR code created with URL: `/table/{token}`
4. Customer scans QR code
5. Redirected to menu with table session
6. Orders automatically linked to table

---

## 🔧 Configuration

### Audio Alerts
- Sound file: `public/sounds/alarm.wav`
- Toggle on/off in Live Orders page
- Loops until orders are cleared

### Database Seeding
- Run `php artisan migrate:fresh --seed` to reset with sample data
- Customize seeders in `database/seeders/`

### Chart Colors
- Modify chart colors in `resources/views/admin/dashboard.blade.php`
- Uses Chart.js configuration

---

## 📊 Database Schema

### Main Tables
- **users**: Admin and customer accounts
- **categories**: Menu categories
- **menu_items**: Food and beverage items
- **tables**: Restaurant tables with QR tokens
- **orders**: Customer orders
- **order_items**: Individual items in orders

---

## 🎯 Roadmap / Future Enhancements

- [ ] Real-time WebSocket integration (replace polling)
- [ ] Payment gateway integration
- [ ] Customer order history
- [ ] Email/SMS notifications
- [ ] Multi-language support
- [ ] Table reservation system
- [ ] Kitchen display system (KDS)
- [ ] Inventory management
- [ ] Staff management
- [ ] Customer feedback system

---

## 🐛 Troubleshooting

### Common Issues

**Issue**: QR codes not generating
- **Solution**: Ensure `simplesoftwareio/simple-qrcode` is installed
- Run: `composer require simplesoftwareio/simple-qrcode`

**Issue**: Charts not displaying
- **Solution**: Check Chart.js CDN in dashboard view
- Verify data is being passed to view

**Issue**: Orders not appearing in Live Orders
- **Solution**: Check database connection
- Verify orders table has data
- Check browser console for errors

**Issue**: Alarm sound not playing
- **Solution**: Ensure `public/sounds/alarm.wav` exists
- Check browser autoplay policies (user interaction required)

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 👨‍💻 Developer

Developed with ❤️ using Laravel

**Tech Stack:**
- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5
- Chart.js
- FontAwesome

---

## 📞 Support

For issues, questions, or suggestions:
- Open an issue on GitHub
- Contact: admin@example.com

---

## 🙏 Acknowledgments

- Laravel Framework
- Chart.js for beautiful charts
- SimpleSoftwareIO for QR code generation
- Bootstrap team for responsive framework
- FontAwesome for icons

---

**⭐ If you find this project useful, please consider giving it a star!**
