# Restaurant Management System 🍽️

A premium, full-featured restaurant management system built with **Laravel 10**, featuring a stunning **Shopify Polaris-inspired Admin Panel** and a modern public-facing website.

## 🚀 Key Features

### 🌐 Public Website
-   **Premium Design**: Dark/Gold theme with smooth scrolling and animations.
-   **Digital Menu**: Filterable menu by categories (Starters, Mains, Desserts, etc.).
-   **Table Reservations**: Online booking system for customers.
-   **About & Contact**: Informative pages with location and story.
-   **Responsive**: Fully mobile-optimized layout.

### 🛡️ Admin Panel (Polaris Theme)
-   **Shopify Polaris Design**: A clean, professional interface mimicking Shopify's admin.
    -   Sticky Topbar with search and user profile.
    -   Sidebar navigation with clear hierarchy.
    -   Consistent Card-based layouts and Resource Lists.
-   **Dashboard**: Real-time overview of reservations and menu items.
-   **Menu Management**:
    -   **Categories**: Create, edit, and manage menu categories with images.
    -   **Menu Items**: Manage dishes, prices, descriptions, and dietary flags (Vegetarian, Active).
-   **Reservation System**:
    -   View all bookings.
    -   Update status (Confirm, Complete, Cancel) with quick actions.
-   **QR Code Generator**:
    -   Instantly generate and download SVG QR codes linking to the public menu.

## 🛠️ Technology Stack
-   **Backend**: Laravel 10 / PHP 8.2+
-   **Frontend**: Blade Templates, Bootstrap 5, Custom CSS (Polaris Theme)
-   **Database**: MySQL
-   **Authentication**: Laravel Breeze

## ⚙️ Installation

1.  **Clone the repository**
    ```bash
    git clone <repository-url>
    cd Restaurant
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Environment Setup**
    -   Copy `.env.example` to `.env`
    -   Configure your database credentials in `.env`:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=restaurant
        DB_USERNAME=root
        DB_PASSWORD=
        ```

4.  **Generate Key & Migrate**
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```

5.  **Run the Application**
    ```bash
    php artisan serve
    ```
    Visit `http://127.0.0.1:8000` in your browser.

## 🔑 Default Credentials

### Admin / Owner
-   **Email**: `admin@example.com`
-   **Password**: `password`

### Test User
-   **Email**: `adi@gmail.com`
-   **Password**: `password`

## 📂 Project Structure
-   `app/Http/Controllers/Admin`: Admin logic (Dashboard, Categories, Menu, Reservations).
-   `resources/views/admin`: Polaris-themed admin views.
-   `resources/views/layouts`: Public and Guest layouts.
-   `routes/web.php`: Application routes.

---
*Developed with ❤️ using Laravel*
