# 🚀 Deploy Paper Haven to Railway - Complete Guide

## Prerequisites

Before deploying, make sure you have:
- ✅ A Railway account (free tier available)
- ✅ GitHub account (to connect your repository)
- ✅ Git installed on your computer

---

## 📋 Deployment Methods

### Method 1: Deploy from GitHub (Recommended)

This is the easiest method and enables automatic redeployment when you push changes.

#### Step 1: Push Your Code to GitHub

1. **Create a new repository on GitHub:**
   - Go to https://github.com/new
   - Repository name: `paper-haven-bookstore`
   - Make it Public or Private
   - Click "Create repository"

2. **Push your local code to GitHub:**

```bash
# Navigate to your project
cd C:\xampp\htdocs\paper-haven-bookstore

# Initialize git (if not already done)
git init

# Add all files
git add .

# Commit files
git commit -m "Initial commit - Paper Haven Bookstore"

# Add remote repository (replace YOUR_USERNAME)
git remote add origin https://github.com/YOUR_USERNAME/paper-haven-bookstore.git

# Push to GitHub
git branch -M main
git push -u origin main
```

#### Step 2: Deploy to Railway

1. **Go to Railway:**
   - Visit https://railway.app
   - Click "Start a New Project"
   - Click "Deploy from GitHub repo"

2. **Connect GitHub:**
   - Authorize Railway to access your GitHub
   - Select your `paper-haven-bookstore` repository

3. **Railway will automatically:**
   - Detect it's a Laravel project
   - Read the Dockerfile
   - Start building your application

---

### Method 2: Deploy from Railway CLI

#### Step 1: Install Railway CLI

```bash
# Windows (PowerShell)
iwr https://railway.app/install.ps1 | iex

# macOS/Linux
curl -fsSL https://railway.app/install.sh | sh
```

#### Step 2: Login to Railway

```bash
railway login
```

This opens a browser for authentication.

#### Step 3: Initialize and Deploy

```bash
# Navigate to your project
cd C:\xampp\htdocs\paper-haven-bookstore

# Initialize Railway project
railway init

# Link to your project
railway link

# Deploy
railway up
```

---

## 🗄️ Database Setup

### Add MySQL Database

1. **In your Railway project:**
   - Click "New" → "Database" → "Add MySQL"
   - Railway automatically creates a MySQL database

2. **Railway provides these environment variables automatically:**
   ```
   MYSQL_HOST
   MYSQL_PORT
   MYSQL_DATABASE
   MYSQL_USER
   MYSQL_PASSWORD
   MYSQL_URL
   ```

3. **Your Laravel app will use these automatically!**
   - The `.env.railway` file is already configured
   - Variables are injected at runtime

---

## ⚙️ Environment Variables Setup

### Required Variables

In Railway dashboard, go to your service → Variables tab and add:

```bash
# Application
APP_NAME="Paper Haven"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_WILL_BE_GENERATED

# The URL will be provided by Railway
APP_URL=${RAILWAY_STATIC_URL}

# Database (Railway auto-provides these)
DB_CONNECTION=mysql
DB_HOST=${MYSQL_HOST}
DB_PORT=${MYSQL_PORT}
DB_DATABASE=${MYSQL_DATABASE}
DB_USERNAME=${MYSQL_USER}
DB_PASSWORD=${MYSQL_PASSWORD}

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_STORE=database
```

### Generate APP_KEY

Railway will generate this automatically, but if needed:

```bash
# Run in Railway CLI
railway run php artisan key:generate --show
```

Copy the output and set it as APP_KEY in Railway variables.

---

## 🔧 Post-Deployment Setup

### Run Migrations and Seed Database

**Option 1: Using Railway CLI**
```bash
# Run migrations
railway run php artisan migrate --force

# Seed the database
railway run php artisan db:seed --force
```

**Option 2: Using Railway Dashboard**
Go to your service → Settings → Deploy → Add this to "Start Command":
```bash
sh -c "php artisan migrate --force && php artisan db:seed --force && apache2-foreground"
```

---

## 📁 File Structure for Railway

Your project should have these Railway-specific files:

```
paper-haven-bookstore/
├── Dockerfile                 # Docker configuration
├── docker/
│   └── 000-default.conf      # Apache virtual host
├── railway.json              # Railway configuration
├── .dockerignore             # Files to ignore in Docker
├── .env.railway              # Production environment template
├── deploy.sh                 # Deployment script
└── ... (rest of your Laravel files)
```

All these files are included in your package! ✅

---

## 🌐 Access Your Application

### Get Your URL

1. **In Railway Dashboard:**
   - Go to your service
   - Click "Settings" → "Networking"
   - Click "Generate Domain"

2. **Your app will be available at:**
   ```
   https://your-app-name.up.railway.app
   ```

3. **Set this URL in environment variables:**
   ```
   APP_URL=https://your-app-name.up.railway.app
   ```

---

## 🔄 Automatic Deployments

### Enable Auto-Deploy from GitHub

1. **In Railway Dashboard:**
   - Go to your service
   - Settings → "Deploy"
   - Enable "Automatic Deployments"

2. **Now every time you push to GitHub:**
   ```bash
   git add .
   git commit -m "Your changes"
   git push
   ```
   Railway automatically rebuilds and redeploys! 🎉

---

## 🐛 Troubleshooting

### Issue 1: Build Fails

**Check logs:**
```bash
railway logs
```

**Common fixes:**
- Ensure Dockerfile is in root directory
- Check all dependencies in composer.json
- Verify PHP version compatibility

### Issue 2: Database Connection Error

**Solutions:**
1. Verify MySQL service is running in Railway
2. Check database environment variables are set
3. Ensure variables reference `${MYSQL_*}` not hardcoded values

**Test connection:**
```bash
railway run php artisan db:show
```

### Issue 3: 500 Internal Server Error

**Debug steps:**
1. Enable debug mode temporarily:
   ```
   APP_DEBUG=true
   ```

2. Check logs:
   ```bash
   railway logs
   ```

3. Clear cache:
   ```bash
   railway run php artisan config:clear
   railway run php artisan cache:clear
   railway run php artisan view:clear
   ```

4. Set permissions:
   ```bash
   railway run chmod -R 775 storage bootstrap/cache
   ```

### Issue 4: Images Not Loading

**Solution:**
Images are stored locally in the container. They're already in your `public/images/books/` folder and will be deployed automatically.

To verify:
```bash
railway run ls -la public/images/books/
```

### Issue 5: Migrations Not Running

**Manual migration:**
```bash
# Fresh migration
railway run php artisan migrate:fresh --force

# Seed data
railway run php artisan db:seed --force
```

---

## 💰 Pricing

### Railway Free Tier
- ✅ 500 hours per month (enough for hobby projects)
- ✅ $5 free credit monthly
- ✅ Custom domains
- ✅ Automatic SSL
- ✅ Auto-scaling

### Estimated Costs
For a basic bookstore:
- **Free tier**: $0/month (with usage limits)
- **Hobby plan**: ~$5-10/month
- **Pro plan**: $20+/month (for production)

---

## 🎯 Step-by-Step Deployment Checklist

### Pre-Deployment
- [ ] Code pushed to GitHub
- [ ] All dependencies in composer.json
- [ ] .env.railway configured
- [ ] Dockerfile present
- [ ] Book cover images in public/images/books/

### During Deployment
- [ ] Railway project created
- [ ] GitHub repo connected
- [ ] MySQL database added
- [ ] Environment variables set
- [ ] Domain generated

### Post-Deployment
- [ ] Migrations run successfully
- [ ] Database seeded with 30 books
- [ ] Application loads without errors
- [ ] Can register/login users
- [ ] Can add items to cart
- [ ] Can complete checkout
- [ ] Images load correctly

---

## 🚀 Quick Start Commands

### Initial Deployment
```bash
# 1. Push to GitHub
git init
git add .
git commit -m "Deploy to Railway"
git remote add origin https://github.com/YOUR_USERNAME/paper-haven-bookstore.git
git push -u origin main

# 2. Deploy to Railway (via dashboard or CLI)
railway login
railway init
railway up

# 3. Add MySQL database in Railway dashboard

# 4. Run migrations
railway run php artisan migrate --force
railway run php artisan db:seed --force
```

### Update Deployment
```bash
# Make your changes
git add .
git commit -m "Update features"
git push

# Railway auto-deploys! ✨
```

---

## 📊 Monitoring

### View Logs
```bash
# Real-time logs
railway logs

# Follow logs
railway logs --follow
```

### Check Application Status
```bash
# Database connection
railway run php artisan db:show

# Application info
railway run php artisan about

# List routes
railway run php artisan route:list
```

---

## 🔐 Security Recommendations

### Production Checklist
- [ ] APP_DEBUG=false
- [ ] APP_ENV=production
- [ ] Strong APP_KEY generated
- [ ] HTTPS enabled (automatic on Railway)
- [ ] Database credentials secured (auto by Railway)
- [ ] Sessions using database driver
- [ ] CSRF protection enabled (Laravel default)

### Additional Security
```bash
# Force HTTPS in production
# Add to app/Providers/AppServiceProvider.php boot method:
if ($this->app->environment('production')) {
    \URL::forceScheme('https');
}
```

---

## 🎓 Best Practices

### 1. Use Branches for Development
```bash
# Create development branch
git checkout -b development

# Make changes and push
git push origin development

# Merge to main when ready
git checkout main
git merge development
git push
```

### 2. Database Backups
Railway doesn't auto-backup on free tier. Schedule backups:
```bash
# Export database
railway run php artisan db:backup
```

### 3. Monitor Performance
- Use Railway metrics dashboard
- Enable Laravel logging
- Monitor response times

---

## 📞 Support Resources

### Railway Documentation
- https://docs.railway.app

### Railway Community
- Discord: https://discord.gg/railway
- Twitter: @Railway

### Laravel Deployment
- https://laravel.com/docs/deployment

---

## ✅ Success Indicators

Your deployment is successful when:

1. ✅ Application loads at your Railway URL
2. ✅ Can register new user account
3. ✅ Can login with credentials
4. ✅ Homepage shows 30 books
5. ✅ Book images display correctly
6. ✅ Shopping cart works
7. ✅ Wishlist functions properly
8. ✅ Checkout completes successfully
9. ✅ Order appears in account history
10. ✅ No errors in Railway logs

---

## 🎉 You're Live!

Congratulations! Your Paper Haven Bookstore is now live on Railway!

**Share your URL:**
```
https://your-app.up.railway.app
```

**Next Steps:**
1. Add custom domain (optional)
2. Configure email service (for notifications)
3. Add analytics (Google Analytics)
4. Enable monitoring
5. Set up CI/CD pipeline

---

**Version:** Railway Deployment Guide v1.0  
**Last Updated:** January 3, 2026  
**Status:** Production Ready ✅  
**Platform:** Railway.app 🚂
