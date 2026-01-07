# 🔧 Railway Deployment Error Fix Guide for Paper Haven

## Common Railway Deployment Errors & Solutions

### ❌ Error 1: Port Binding Issues
**Symptom:** Application crashes with "Address already in use" or port-related errors

**Problem:** Railway expects your app to listen on the `PORT` environment variable, but there might be conflicts between Dockerfile CMD and railway.json configuration.

**Solution:**

Your current setup has a conflict:
- **Dockerfile** line 39: `CMD php artisan migrate --force && apache2-foreground`
- **railway.json** line 8: `"startCommand": "apache2-foreground"`

Apache listens on port 80 by default, but Railway needs it to listen on `$PORT`.

**Fix Option 1: Use Dockerfile Only (Recommended for Apache)**

Update your `Dockerfile`:

```dockerfile
FROM php:8.2-apache

# Disable all MPMs first, then enable only one
RUN a2dismod mpm_event mpm_worker mpm_prefork || true
RUN a2enmod mpm_prefork rewrite

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configure Apache to listen on PORT environment variable
RUN echo 'Listen ${PORT:-80}' > /etc/apache2/ports.conf

# Configure Apache VirtualHost
RUN echo '<VirtualHost *:${PORT:-80}>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Create startup script
RUN echo '#!/bin/bash\n\
echo "PORT is set to: ${PORT:-80}"\n\
php artisan config:cache\n\
php artisan migrate --force\n\
exec apache2-foreground' > /start.sh && chmod +x /start.sh

# Expose port
EXPOSE ${PORT:-80}

# Start Apache
CMD ["/start.sh"]
```

Update your `railway.json` (remove startCommand to use Dockerfile CMD):

```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "DOCKERFILE",
    "dockerfilePath": "Dockerfile"
  },
  "deploy": {
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

**Fix Option 2: Use PHP Built-in Server (Simpler but less production-ready)**

If Apache is causing issues, use PHP's built-in server:

Update `Dockerfile`:

```dockerfile
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && chmod -R 775 storage bootstrap/cache

EXPOSE ${PORT:-8000}

CMD php artisan config:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
```

---

### ❌ Error 2: Missing APP_KEY
**Symptom:** "No application encryption key has been specified"

**Solution:**

1. Generate a key locally:
```bash
php artisan key:generate --show
```

2. Add to Railway environment variables:
```
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
```

---

### ❌ Error 3: Database Connection Failed
**Symptom:** "SQLSTATE[HY000] [2002] Connection refused"

**Solution:**

Railway provides MySQL variables differently. Update your Railway environment variables:

```bash
# In Railway Dashboard → Your Service → Variables
APP_NAME="Paper Haven"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=${RAILWAY_PUBLIC_DOMAIN}

# Database - Use Railway's MySQL service variables
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
```

**Important:** Make sure you've added a MySQL database service in Railway!

---

### ❌ Error 4: Storage/Cache Permission Denied
**Symptom:** "The stream or file could not be opened in append mode"

**Solution:**

Add this to your Dockerfile before the CMD:

```dockerfile
# Ensure proper permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache
```

---

### ❌ Error 5: Composer Dependencies Error
**Symptom:** "Your requirements could not be resolved"

**Solution:**

Check your `composer.json` has correct PHP version:

```json
{
    "require": {
        "php": "^8.2",
        ...
    }
}
```

In Railway, set PHP version explicitly:
```
PHP_VERSION=8.2
```

---

### ❌ Error 6: Build Times Out
**Symptom:** Build exceeds Railway's time limit

**Solution:**

Optimize your Dockerfile:

```dockerfile
# Use multi-stage build
FROM composer:latest as composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs

FROM php:8.2-apache
# ... rest of your setup ...
COPY --from=composer /app/vendor ./vendor
COPY . .
RUN composer dump-autoload --optimize
```

---

## 🔍 Debugging Steps

### Step 1: Check Railway Logs
```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link to your project
railway link

# View logs
railway logs
```

### Step 2: View Build Logs in Dashboard
1. Go to Railway Dashboard
2. Click your service
3. Click "Deployments"
4. Click the failed deployment
5. Read the build and deploy logs

### Step 3: Test Locally with Docker
```bash
# Build the image
docker build -t paper-haven .

# Run it
docker run -p 8000:80 \
  -e APP_KEY=base64:YOUR_KEY \
  -e DB_CONNECTION=sqlite \
  -e DB_DATABASE=/tmp/database.sqlite \
  paper-haven

# Test in browser
curl http://localhost:8000
```

---

## ✅ Recommended Railway Configuration

### Environment Variables (Complete List)
```bash
# Application
APP_NAME="Paper Haven"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_GENERATED_KEY
APP_URL=${RAILWAY_PUBLIC_DOMAIN}
APP_TIMEZONE=UTC

# Database (After adding MySQL service)
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Session & Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database

# Logging
LOG_CHANNEL=errorlog
LOG_LEVEL=error

# Queue
QUEUE_CONNECTION=database
```

### Required Services
1. **MySQL Database**
   - Add via: Railway Dashboard → New → Database → MySQL

2. **Your Application Service**
   - Connected to your GitHub repo
   - Environment variables configured
   - Domain generated

---

## 🚀 Step-by-Step Deployment (After Fixes)

### 1. Update Files
Replace your `Dockerfile` with the recommended version above.

### 2. Update railway.json
```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "DOCKERFILE",
    "dockerfilePath": "Dockerfile"
  },
  "deploy": {
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

### 3. Commit and Push
```bash
git add .
git commit -m "Fix Railway deployment configuration"
git push origin main
```

### 4. Configure Railway
1. Add MySQL database
2. Set all environment variables
3. Generate domain
4. Redeploy

### 5. Verify Deployment
```bash
railway logs

# Should see:
# "Starting Apache..."
# "Application running on port XXXX"
```

---

## 📊 Health Check Endpoints

Add these to verify your deployment:

Create `routes/web.php` addition:
```php
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
        'timestamp' => now(),
    ]);
});
```

Test: `https://your-app.up.railway.app/health`

---

## 🆘 Still Having Issues?

### Get Detailed Error Info

1. **Enable Debug Mode Temporarily:**
   ```
   APP_DEBUG=true
   ```

2. **Check Laravel Logs:**
   ```bash
   railway run cat storage/logs/laravel.log
   ```

3. **Test Database Connection:**
   ```bash
   railway run php artisan db:show
   ```

4. **Test Migrations:**
   ```bash
   railway run php artisan migrate --force --verbose
   ```

### Common Error Messages & Meanings

| Error Message | Meaning | Fix |
|--------------|---------|-----|
| "Address already in use" | Port conflict | Use $PORT variable |
| "Connection refused" | Database not accessible | Check MYSQL variables |
| "Permission denied" | Storage permissions | Fix chmod in Dockerfile |
| "Class not found" | Composer autoload issue | Run composer dump-autoload |
| "Key not specified" | Missing APP_KEY | Generate and set APP_KEY |

---

## 📝 Checklist Before Deployment

- [ ] APP_KEY generated and set
- [ ] All database variables use ${MYSQL*} format
- [ ] Dockerfile listens on $PORT
- [ ] Storage directories have correct permissions
- [ ] MySQL database service added in Railway
- [ ] .env.example updated with production values
- [ ] Migrations run successfully locally
- [ ] No hardcoded localhost URLs

---

## 🎯 Expected Successful Deployment Output

```
==> Building...
    Building Dockerfile
    [+] Building 45.3s (14/14) FINISHED
    => [1/7] FROM php:8.2-apache
    => [2/7] RUN apt-get update && apt-get install...
    => [3/7] COPY --from=composer...
    => [4/7] WORKDIR /var/www/html
    => [5/7] COPY . .
    => [6/7] RUN composer install...
    => [7/7] RUN chmod -R 775 storage...
    => exporting to image

==> Deploying...
    Starting container...
    PORT is set to: 8080
    Configuration cached successfully!
    Nothing to migrate.
    [Tue Jan 07 10:30:00.000000 2026] Apache/2.4.x configured
    Apache started successfully
    
==> Deployment successful!
    Service is running at: https://paper-haven-production.up.railway.app
```

---

**Need More Help?**

Share your specific error message from Railway logs, and I can provide targeted solutions!
