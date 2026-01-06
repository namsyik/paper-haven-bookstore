# 🚂 Railway Quick Start - 5 Minutes to Deploy

## Super Fast Deployment (Recommended)

### Step 1: Push to GitHub (2 minutes)
```bash
# Open terminal in your project folder
cd C:\xampp\htdocs\paper-haven-bookstore

# Initialize and push
git init
git add .
git commit -m "Deploy Paper Haven"

# Create repo on GitHub first, then:
git remote add origin https://github.com/YOUR_USERNAME/paper-haven-bookstore.git
git push -u origin main
```

### Step 2: Deploy on Railway (2 minutes)
1. Go to https://railway.app
2. Click **"Start a New Project"**
3. Click **"Deploy from GitHub repo"**
4. Select **"paper-haven-bookstore"**
5. ✅ Railway starts building!

### Step 3: Add Database (30 seconds)
1. Click **"New"** → **"Database"** → **"Add MySQL"**
2. ✅ Database automatically configured!

### Step 4: Generate Domain (30 seconds)
1. Go to **Settings** → **"Networking"**
2. Click **"Generate Domain"**
3. Copy your URL: `https://paper-haven.up.railway.app`

### Step 5: Run Migrations (30 seconds)
1. Install Railway CLI or use dashboard
2. Run these commands:

**Using Railway CLI:**
```bash
railway login
railway link
railway run php artisan migrate --force
railway run php artisan db:seed --force
```

**Or use Railway Dashboard:**
- Go to service → **Deployments**
- Click latest deployment → **View Logs**
- Click **"Deploy"** dropdown → **"Run command"**
- Enter: `php artisan migrate --force && php artisan db:seed --force`

### 🎉 DONE! Visit Your Site
```
https://your-app.up.railway.app
```

---

## Common Variables to Set

Go to **Variables** tab and ensure these are set:

```env
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
```

Railway auto-provides database variables! ✅

---

## Troubleshooting

**Build failed?**
```bash
railway logs
```

**Database error?**
- Ensure MySQL service is running
- Check it's linked to your app

**500 Error?**
```bash
railway run php artisan config:clear
railway run php artisan migrate --force
```

---

## 📚 Full Guide
See `RAILWAY-DEPLOYMENT.md` for complete documentation.

---

**That's it! Your bookstore is live! 🚀**
