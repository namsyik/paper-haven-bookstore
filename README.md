# Paper Haven - E-Commerce Bookstore

A complete Laravel-based e-commerce bookstore web application with Bootstrap frontend and MySQL database.

## Features

- 📚 Browse books by categories and authors
- 🔍 Search functionality
- 🛒 Shopping cart system
- 📦 Checkout and order management
- 💳 Order confirmation
- 📱 Responsive design with Bootstrap
- ⭐ Book ratings display
- 👤 User-friendly interface
- 📖 **E-book store with digital downloads**
- 🎨 **Professional book cover images**
- ℹ️ **Comprehensive About Us page**
- 🏢 **Company timeline and team information**

## Technologies Used

- **Backend**: PHP 8.2+, Laravel 11
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL (via XAMPP)
- **Others**: jQuery, Font Awesome

## Prerequisites

- PHP 8.2 or higher
- Composer
- XAMPP (for MySQL database)
- Node.js & NPM (for asset compilation)

## Installation Steps

### 1. Start XAMPP
- Open XAMPP Control Panel
- Start Apache and MySQL services

### 2. Create Database
- Open phpMyAdmin (http://localhost/phpmyadmin)
- Create a new database named `paper_haven_db`

### 3. Clone/Extract Project
```bash
# If you have the project files, extract them to:
C:\xampp\htdocs\paper-haven-bookstore
```

### 4. Install Dependencies
```bash
cd C:\xampp\htdocs\paper-haven-bookstore
composer install
npm install
```

### 5. Configure Environment
```bash
# Copy the environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 6. Update .env File
Open `.env` and configure database settings:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paper_haven_db
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Run Migrations & Seed Database
```bash
# Create tables
php artisan migrate

# Populate with sample data
php artisan db:seed
```

### 8. Create Storage Link
```bash
php artisan storage:link
```

### 9. Start Development Server
```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

## Project Structure

```
paper-haven-bookstore/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── BookController.php
│   │       ├── CartController.php
│   │       └── CheckoutController.php
│   └── Models/
│       ├── Book.php
│       ├── CartItem.php
│       ├── Order.php
│       └── OrderItem.php
├── database/
│   ├── migrations/
│   │   └── 2024_12_15_000001_create_bookstore_tables.php
│   └── seeders/
│       └── BookSeeder.php
├── public/
│   ├── css/
│   └── images/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── home.blade.php
│       ├── shop.blade.php
│       ├── book-detail.blade.php
│       ├── cart.blade.php
│       ├── checkout.blade.php
│       └── order-confirmation.blade.php
└── routes/
    └── web.php
```

## Usage

### Browsing Books
- Visit homepage to see featured books and author collections
- Navigate to Shop page to view all available books
- Click on any book to view details

### Shopping Cart
- Click "Add to cart" on any book
- View cart by clicking the cart icon in navigation
- Update quantities or remove items from cart

### Checkout
- Proceed to checkout from cart page
- Fill in customer information
- Place order to receive confirmation

## Database Schema

### Books Table
- id, title, author, description, price, image, stock, isbn, rating, category

### Cart Items Table
- id, session_id, book_id, quantity

### Orders Table
- id, customer_name, customer_email, customer_address, customer_phone, total, status

### Order Items Table
- id, order_id, book_id, quantity, price

## Customization

### Adding New Books
1. Access database via phpMyAdmin
2. Insert into `books` table, or
3. Use database seeder to add programmatically

### Changing Theme Colors
Edit `/public/css/custom.css` to modify:
- Primary color: `#8B6F47` (brown)
- Background: `#F5DEB3` (wheat/beige)
- Accent colors

### Adding Payment Gateway
Integrate payment provider in `CheckoutController@store` method

## Troubleshooting

### Issue: Database connection failed
- Ensure MySQL is running in XAMPP
- Check database credentials in `.env`

### Issue: Page not found
- Run `php artisan route:list` to verify routes
- Clear cache: `php artisan cache:clear`

### Issue: Images not displaying
- Run `php artisan storage:link`
- Check file permissions on storage folder

### Issue: Class not found
- Run `composer dump-autoload`

## Credits

- Design inspiration from modern bookstore interfaces
- Bootstrap framework
- Laravel framework

## License

This project is open-source for educational purposes.

---

**Developed for Paper Haven Bookstore**
