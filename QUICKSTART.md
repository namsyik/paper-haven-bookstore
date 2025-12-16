# Quick Start Guide - Paper Haven Bookstore

## 🚀 5-Minute Setup

### Step 1: Start XAMPP
```
1. Open XAMPP Control Panel
2. Click START for Apache
3. Click START for MySQL
```

### Step 2: Create Database
```
1. Click "Admin" next to MySQL in XAMPP
2. Click "New" in phpMyAdmin
3. Database name: paper_haven_db
4. Click "Create"
```

### Step 3: Extract Project
```
Extract the project folder to:
C:\xampp\htdocs\paper-haven-bookstore
```

### Step 4: Open Command Prompt
```
Windows Key + R
Type: cmd
Press Enter

Type these commands:
cd C:\xampp\htdocs\paper-haven-bookstore
```

### Step 5: Install Dependencies
```bash
composer install
```
⏱️ This takes 5-10 minutes

### Step 6: Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### Step 7: Setup Database
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### Step 8: Start Server
```bash
php artisan serve
```

### Step 9: Visit Website
```
Open browser: http://localhost:8000
```

---

## 🎯 Quick Test

1. ✅ Homepage loads
2. ✅ Click "Explore Now"
3. ✅ Click any book
4. ✅ Click "Add to Cart"
5. ✅ Click cart icon (top right)
6. ✅ Click "Proceed to Checkout"
7. ✅ Fill form and click "Place Order"
8. ✅ See order confirmation

---

## ⚠️ Troubleshooting

**Port 8000 in use?**
```bash
php artisan serve --port=8001
# Visit: http://localhost:8001
```

**Database connection error?**
```
1. Check MySQL is running in XAMPP
2. Verify database name is: paper_haven_db
3. Check .env file: DB_PASSWORD should be empty
```

**Composer not found?**
```
1. Install Composer from: https://getcomposer.org
2. Restart Command Prompt
3. Try again
```

---

## 📊 Sample Data

After running `php artisan db:seed`, you'll have:

- **30+ Books** in various categories
- **Popular Authors:** James Clear, Robert Kiyosaki, Napoleon Hill, Brian Tracy
- **Categories:** Self-Help, Business, Finance, Psychology, Philosophy
- **Price Range:** $25 - $35
- **Stock:** 25-70 units per book

---

## 🎨 Features

✨ **Homepage**
- Hero section with book carousel
- Featured authors
- Recommended books
- Newsletter subscription

🛍️ **Shop Page**
- Filter by category
- Search books
- Sort options
- Pagination

📖 **Book Details**
- Full description
- Related books
- Stock availability
- Add to cart

🛒 **Shopping Cart**
- Update quantities
- Remove items
- Price calculation
- Tax included

💳 **Checkout**
- Customer information form
- Order summary
- Cash on delivery
- Order confirmation

---

## 📝 Default Settings

- **Tax Rate:** 10%
- **Shipping:** $5.00 flat rate
- **Currency:** USD
- **Payment:** Cash on Delivery (COD)

---

## 🔗 Important URLs

- Homepage: http://localhost:8000
- Shop: http://localhost:8000/shop
- Cart: http://localhost:8000/cart
- phpMyAdmin: http://localhost/phpmyadmin

---

## 📚 Next Steps

1. Explore the codebase
2. Customize colors in `/resources/views/layouts/app.blade.php`
3. Add more books in `database/seeders/BookSeeder.php`
4. Modify prices in the seeder file
5. Create custom categories
6. Add product images to `/public/images/books/`

---

## 🆘 Need Help?

1. Check INSTALLATION-GUIDE.md for detailed instructions
2. Check README.md for project documentation
3. Review common errors in the troubleshooting section

---

**Happy Coding! 📖✨**
