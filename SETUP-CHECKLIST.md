# Paper Haven Bookstore - Setup Checklist

## Pre-Installation Checklist

### Required Software
- [ ] XAMPP 8.2+ installed
- [ ] Composer installed
- [ ] Text editor installed (VS Code, Sublime, etc.)
- [ ] Web browser installed

### System Requirements
- [ ] Windows 7/8/10/11
- [ ] 2GB RAM minimum
- [ ] 500MB free disk space
- [ ] Internet connection (for initial setup)

---

## Installation Checklist

### Step 1: XAMPP Setup
- [ ] XAMPP installed
- [ ] Apache started in XAMPP Control Panel
- [ ] MySQL started in XAMPP Control Panel
- [ ] phpMyAdmin accessible (http://localhost/phpmyadmin)

### Step 2: Database Creation
- [ ] Opened phpMyAdmin
- [ ] Created database named: `paper_haven_db`
- [ ] Database shows in left sidebar

### Step 3: Project Extraction
- [ ] Extracted project folder
- [ ] Moved to: `C:\xampp\htdocs\paper-haven-bookstore`
- [ ] All files present in folder

### Step 4: Composer Installation
- [ ] Composer downloaded
- [ ] Composer installed successfully
- [ ] `composer --version` works in CMD

### Step 5: Install Dependencies
- [ ] Opened Command Prompt
- [ ] Navigated to project folder
- [ ] Ran: `composer install`
- [ ] No errors during installation
- [ ] `vendor/` folder created

### Step 6: Environment Setup
- [ ] Ran: `copy .env.example .env`
- [ ] `.env` file created
- [ ] Ran: `php artisan key:generate`
- [ ] APP_KEY generated in .env
- [ ] Database credentials correct in .env

### Step 7: Database Setup
- [ ] Ran: `php artisan migrate`
- [ ] All 5 tables created successfully
- [ ] Ran: `php artisan db:seed`
- [ ] Sample books added (check phpMyAdmin)
- [ ] Ran: `php artisan storage:link`

### Step 8: Server Start
- [ ] Ran: `php artisan serve`
- [ ] Server running message appears
- [ ] No errors in console

### Step 9: Website Access
- [ ] Opened: http://localhost:8000
- [ ] Homepage loads correctly
- [ ] Books display properly
- [ ] Navigation works

---

## Feature Testing Checklist

### Homepage
- [ ] Hero section displays
- [ ] Book carousel works
- [ ] Author section shows
- [ ] Recommended books display
- [ ] "Explore Now" button works
- [ ] Newsletter form present

### Navigation
- [ ] Logo links to home
- [ ] All menu items clickable
- [ ] Search icon works
- [ ] Cart icon displays
- [ ] Cart count shows "0"
- [ ] Language dropdown works
- [ ] User avatar displays
- [ ] Mobile menu responsive

### Shop Page
- [ ] All books display
- [ ] Grid layout correct
- [ ] Book cards show properly
- [ ] Images placeholder present
- [ ] Prices display
- [ ] Ratings show
- [ ] "Add to cart" buttons work
- [ ] Pagination works
- [ ] Search box functional
- [ ] Category filter works
- [ ] Sort dropdown works
- [ ] Filter results update

### Book Detail Page
- [ ] Click on book opens detail
- [ ] Book image shows
- [ ] Title displays
- [ ] Author shows
- [ ] Description present
- [ ] Price correct
- [ ] Stock status shows
- [ ] ISBN displays
- [ ] Category shows
- [ ] Rating displays
- [ ] Quantity selector works
- [ ] "+" button increases qty
- [ ] "-" button decreases qty
- [ ] Max quantity = stock
- [ ] "Add to Cart" works
- [ ] Related books show
- [ ] Tabs switch properly

### Shopping Cart
- [ ] Cart page accessible
- [ ] Added items appear
- [ ] Book details show
- [ ] Quantities editable
- [ ] Prices calculate correctly
- [ ] Subtotal correct
- [ ] Tax calculated (10%)
- [ ] Total accurate
- [ ] "Update" quantity works
- [ ] "Remove" item works
- [ ] "Clear Cart" works
- [ ] "Continue Shopping" works
- [ ] "Proceed to Checkout" works
- [ ] Empty cart shows message
- [ ] Cart count updates in nav

### Checkout
- [ ] Checkout page loads
- [ ] Order summary shows
- [ ] All cart items listed
- [ ] Prices correct
- [ ] Shipping cost shows ($5)
- [ ] Total includes all costs
- [ ] Form fields present
- [ ] Name field works
- [ ] Email field works
- [ ] Phone field works
- [ ] Address field works
- [ ] Payment method shows
- [ ] Form validation works
- [ ] Required fields checked
- [ ] Email format validated
- [ ] "Back to Cart" works
- [ ] "Place Order" works

### Order Confirmation
- [ ] Confirmation page loads
- [ ] Success icon shows
- [ ] Order number displays
- [ ] Customer info shows
- [ ] Order items listed
- [ ] Prices correct
- [ ] Total matches
- [ ] Order status shows
- [ ] Order date displays
- [ ] Next steps info shows
- [ ] "Back to Home" works
- [ ] "Continue Shopping" works
- [ ] Cart cleared after order
- [ ] Cart count reset to 0

---

## Database Verification Checklist

### Check in phpMyAdmin
- [ ] `books` table has 30+ records
- [ ] Books have titles
- [ ] Books have authors
- [ ] Books have prices
- [ ] Books have stock
- [ ] Books have ISBNs
- [ ] Books have ratings
- [ ] Books have categories
- [ ] `cart_items` table created
- [ ] `orders` table created
- [ ] `order_items` table created
- [ ] `wishlists` table created

---

## Troubleshooting Checklist

### If Homepage Won't Load
- [ ] XAMPP Apache running?
- [ ] XAMPP MySQL running?
- [ ] Server started with `php artisan serve`?
- [ ] Correct URL: http://localhost:8000?
- [ ] Check CMD for errors

### If Database Connection Fails
- [ ] MySQL running in XAMPP?
- [ ] Database `paper_haven_db` exists?
- [ ] .env DB_DATABASE correct?
- [ ] .env DB_USERNAME = root?
- [ ] .env DB_PASSWORD empty?
- [ ] Migrations run successfully?

### If Books Don't Show
- [ ] Database seeded?
- [ ] Check books table in phpMyAdmin
- [ ] Browser console for errors
- [ ] Clear browser cache
- [ ] Run `php artisan cache:clear`

### If Add to Cart Fails
- [ ] Check browser console for errors
- [ ] CSRF token present?
- [ ] Session working?
- [ ] Check cart_items table
- [ ] Server running?

### If Images Don't Display
- [ ] Using placeholder images (normal)
- [ ] Storage link created?
- [ ] Check public/storage folder
- [ ] Check permissions

### If Form Validation Fails
- [ ] Fill all required fields?
- [ ] Email format correct?
- [ ] Phone number format correct?
- [ ] Check error messages
- [ ] Browser console for JS errors

---

## Performance Checklist

### Speed Tests
- [ ] Homepage loads < 2 seconds
- [ ] Shop page loads < 2 seconds
- [ ] Book detail loads < 1 second
- [ ] Cart operations instant
- [ ] No visible lag

### Browser Compatibility
- [ ] Works in Chrome
- [ ] Works in Firefox
- [ ] Works in Edge
- [ ] Works in Safari

### Responsive Design
- [ ] Mobile view (< 768px)
- [ ] Tablet view (768-1024px)
- [ ] Desktop view (> 1024px)
- [ ] Navigation collapses on mobile
- [ ] Content readable on all sizes

---

## Security Checklist

- [ ] CSRF tokens on all forms
- [ ] Input validation working
- [ ] No SQL injection possible
- [ ] XSS protection enabled
- [ ] Session secure
- [ ] Passwords not in .env
- [ ] Debug mode OFF for production
- [ ] Error handling working

---

## Final Verification

### Complete User Journey
- [ ] 1. Visit homepage
- [ ] 2. Browse featured books
- [ ] 3. Click "Explore Now"
- [ ] 4. Use search to find book
- [ ] 5. Click on a book
- [ ] 6. Read description
- [ ] 7. Add to cart (qty: 2)
- [ ] 8. Continue shopping
- [ ] 9. Add another book
- [ ] 10. Click cart icon
- [ ] 11. Review items
- [ ] 12. Update quantity
- [ ] 13. Remove one item
- [ ] 14. Proceed to checkout
- [ ] 15. Fill customer info
- [ ] 16. Review order summary
- [ ] 17. Place order
- [ ] 18. See confirmation
- [ ] 19. Note order number
- [ ] 20. Return to homepage

### Documentation Review
- [ ] README.md present
- [ ] INSTALLATION-GUIDE.md present
- [ ] QUICKSTART.md present
- [ ] PROJECT-SUMMARY.md present
- [ ] All docs readable
- [ ] Instructions clear

---

## Deployment Preparation (Optional)

### For Production
- [ ] APP_ENV=production
- [ ] APP_DEBUG=false
- [ ] Update APP_URL
- [ ] Secure database
- [ ] Run optimizations
- [ ] Test on live server
- [ ] Setup backups
- [ ] Configure SSL

---

## Maintenance Checklist

### Regular Tasks
- [ ] Backup database weekly
- [ ] Check error logs
- [ ] Monitor disk space
- [ ] Update Laravel packages
- [ ] Test major features
- [ ] Review security updates

---

## Sign-Off

### Installation Complete
- [ ] All features working
- [ ] No errors in console
- [ ] Database populated
- [ ] Documentation read
- [ ] Ready to use/customize

**Installation Date:** _______________

**Installed By:** _______________

**Notes:**
________________________________________________
________________________________________________
________________________________________________

---

## Quick Commands Reference

```bash
# Start server
php artisan serve

# Clear cache
php artisan cache:clear

# Reset database
php artisan migrate:fresh --seed

# Check routes
php artisan route:list

# Stop server
Ctrl + C
```

---

## Support Resources

- INSTALLATION-GUIDE.md - Detailed setup
- QUICKSTART.md - Fast setup  
- PROJECT-SUMMARY.md - Features overview
- README.md - Project info

**Need Help?** Check troubleshooting sections in guides!

---

**Checklist Version:** 1.0  
**Last Updated:** December 15, 2024
