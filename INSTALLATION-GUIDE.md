# Paper Haven Bookstore - Complete Installation Guide

## Step-by-Step Installation Instructions for XAMPP and Laravel

### Prerequisites Checklist
- [ ] XAMPP installed (includes Apache, MySQL, PHP 8.2+)
- [ ] Composer installed
- [ ] Text editor (VS Code, Sublime Text, etc.)

---

## Part 1: Installing XAMPP

### 1.1 Download XAMPP
1. Visit: https://www.apachefriends.org/
2. Download XAMPP for Windows (version 8.2 or higher)
3. Run the installer

### 1.2 Configure XAMPP
1. Open XAMPP Control Panel
2. Start **Apache** and **MySQL** services
3. Click **Admin** next to MySQL to open phpMyAdmin

---

## Part 2: Database Setup

### 2.1 Create Database
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Click **New** in the left sidebar
3. Database name: `paper_haven_db`
4. Collation: `utf8mb4_general_ci`
5. Click **Create**

---

## Part 3: Installing Composer

### 3.1 Download Composer
1. Visit: https://getcomposer.org/download/
2. Download and run Composer-Setup.exe
3. Follow the installation wizard
4. Verify installation:
   ```bash
   composer --version
   ```

---

## Part 4: Project Installation

### 4.1 Extract Project Files
1. Extract the `paper-haven-bookstore` folder
2. Move it to: `C:\xampp\htdocs\paper-haven-bookstore`

### 4.2 Open Command Prompt
1. Press `Win + R`
2. Type `cmd` and press Enter
3. Navigate to project folder:
   ```bash
   cd C:\xampp\htdocs\paper-haven-bookstore
   ```

### 4.3 Install Dependencies
```bash
composer install
```

This will download all PHP dependencies (may take 5-10 minutes).

### 4.4 Configure Environment
```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4.5 Edit .env File
Open `.env` file in a text editor and verify these settings:

```
APP_NAME="Paper Haven"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paper_haven_db
DB_USERNAME=root
DB_PASSWORD=
```

**Important:** If your MySQL has a password, update `DB_PASSWORD=your_password`

---

## Part 5: Database Migration and Seeding

### 5.1 Run Migrations
```bash
php artisan migrate
```

This creates all necessary tables in the database.

### 5.2 Seed Database
```bash
php artisan db:seed
```

This populates the database with sample books and data.

---

## Part 6: Create Storage Link

```bash
php artisan storage:link
```

This creates a symbolic link for file storage.

---

## Part 7: Start the Application

### 7.1 Start Development Server
```bash
php artisan serve
```

### 7.2 Access the Application
Open your web browser and visit:
- **Homepage:** http://localhost:8000
- **Shop Page:** http://localhost:8000/shop
- **Cart:** http://localhost:8000/cart

---

## Part 8: Testing the Application

### 8.1 Test Basic Features
1. ✅ Browse books on homepage
2. ✅ Click on a book to view details
3. ✅ Add books to cart
4. ✅ Update quantities in cart
5. ✅ Proceed to checkout
6. ✅ Fill customer information
7. ✅ Place order
8. ✅ View order confirmation

### 8.2 Sample Test Data
The database is seeded with:
- 30+ books
- Multiple categories (Self-Help, Business, Finance, Psychology, etc.)
- Books by popular authors (James Clear, Robert Kiyosaki, Napoleon Hill, etc.)
- All books priced at $25-$35
- Stock quantities between 25-70 units

---

## Common Issues and Solutions

### Issue 1: "composer: command not found"
**Solution:** 
- Restart Command Prompt after installing Composer
- Or use full path: `C:\ProgramData\ComposerSetup\bin\composer.bat install`

### Issue 2: "php: command not found"
**Solution:**
- Add PHP to system PATH:
  1. Right-click "This PC" → Properties
  2. Advanced System Settings → Environment Variables
  3. Edit PATH variable
  4. Add: `C:\xampp\php`
- Restart Command Prompt

### Issue 3: "SQLSTATE[HY000] [1045] Access denied"
**Solution:**
- Check MySQL is running in XAMPP
- Verify DB_USERNAME and DB_PASSWORD in .env
- Default XAMPP MySQL has no password (leave DB_PASSWORD empty)

### Issue 4: "419 Page Expired" when submitting forms
**Solution:**
- Clear browser cache
- Run: `php artisan cache:clear`
- Check if CSRF token is present in forms

### Issue 5: Port 8000 already in use
**Solution:**
```bash
php artisan serve --port=8001
```
Then access: http://localhost:8001

### Issue 6: Apache won't start (Port 80 in use)
**Solution:**
- Stop IIS or Skype (they use port 80)
- Or change Apache port:
  1. Open `C:\xampp\apache\conf\httpd.conf`
  2. Change `Listen 80` to `Listen 8080`
  3. Restart Apache

### Issue 7: MySQL won't start (Port 3306 in use)
**Solution:**
- Check if another MySQL service is running
- Stop it from Services (Win + R → services.msc)

---

## File Structure Overview

```
paper-haven-bookstore/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── BookController.php      # Handles book browsing
│   │       ├── CartController.php      # Shopping cart logic
│   │       └── CheckoutController.php  # Order processing
│   └── Models/
│       ├── Book.php                    # Book data model
│       ├── CartItem.php                # Cart item model
│       ├── Order.php                   # Order model
│       └── OrderItem.php               # Order item model
├── database/
│   ├── migrations/                     # Database structure
│   └── seeders/
│       └── BookSeeder.php              # Sample data
├── public/                             # Web server root
├── resources/
│   └── views/                          # Blade templates
│       ├── layouts/
│       │   └── app.blade.php           # Main layout
│       ├── home.blade.php              # Homepage
│       ├── shop.blade.php              # Shop page
│       ├── book-detail.blade.php       # Book details
│       ├── cart.blade.php              # Shopping cart
│       ├── checkout.blade.php          # Checkout form
│       └── order-confirmation.blade.php # Order success
├── routes/
│   └── web.php                         # Application routes
├── .env                                # Environment config
├── composer.json                       # PHP dependencies
└── artisan                             # Laravel CLI tool
```

---

## Database Schema

### Books Table
- id, title, author, description, price, image, stock, isbn, rating, category, timestamps

### Cart Items Table
- id, session_id, book_id, quantity, timestamps

### Orders Table
- id, customer_name, customer_email, customer_address, customer_phone, total, status, timestamps

### Order Items Table
- id, order_id, book_id, quantity, price, timestamps

---

## Admin Operations

### Add New Books
Option 1 - Via phpMyAdmin:
1. Open phpMyAdmin
2. Select `paper_haven_db` database
3. Click `books` table
4. Click **Insert** tab
5. Fill in book details
6. Click **Go**

Option 2 - Via Database Seeder:
1. Edit `database/seeders/BookSeeder.php`
2. Add new book array to $books
3. Run: `php artisan db:seed --class=BookSeeder`

### View Orders
1. Open phpMyAdmin
2. Select `paper_haven_db` database
3. Click `orders` table
4. Browse order records

### Update Stock
```sql
UPDATE books SET stock = stock - 1 WHERE id = 1;
```

---

## Development Tips

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Reset Database
```bash
php artisan migrate:fresh --seed
```
⚠️ Warning: This deletes all data!

### Check Routes
```bash
php artisan route:list
```

### Database Backup
1. phpMyAdmin → paper_haven_db
2. Click **Export**
3. Choose **Quick** method
4. Click **Go**

---

## Production Deployment Notes

Before deploying to production:

1. Set environment:
   ```
   APP_ENV=production
   APP_DEBUG=false
   ```

2. Update APP_URL to your domain

3. Secure database credentials

4. Enable HTTPS

5. Optimize:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## Support and Resources

- **Laravel Documentation:** https://laravel.com/docs
- **Bootstrap Documentation:** https://getbootstrap.com/docs
- **PHP Manual:** https://www.php.net/manual
- **XAMPP FAQ:** https://www.apachefriends.org/faq.html

---

## Credits

- **Framework:** Laravel 11
- **Frontend:** Bootstrap 5
- **Icons:** Font Awesome 6
- **Fonts:** Google Fonts (Playfair Display, Poppins)

---

## License

This project is open-source for educational purposes.

---

**Developed by:** Paper Haven Team  
**Last Updated:** December 2024  
**Version:** 1.0.0
