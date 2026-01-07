ARG CACHEBUST=1
FROM php:8.2-apache
RUN echo "cache bust $CACHEBUST"

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

# Create necessary directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Create startup script with proper PORT handling
RUN cat > /start.sh <<'STARTSCRIPT'
#!/bin/bash
set -e

# Get PORT from environment (Railway provides this dynamically)
PORT=${PORT:-80}

echo "========================================"
echo "Paper Haven Bookstore - Starting"
echo "========================================"
echo "PORT: $PORT"
echo ""

# Configure Apache to listen on the correct port
echo "Configuring Apache..."
echo "Listen $PORT" > /etc/apache2/ports.conf

# Create VirtualHost configuration with the dynamic port
cat > /etc/apache2/sites-available/000-default.conf <<VHOST
<VirtualHost *:$PORT>
    ServerAdmin admin@paperhaven.com
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
VHOST

# Enable the site
a2ensite 000-default > /dev/null 2>&1

echo "Apache configured for port $PORT"
echo ""

# Laravel setup
echo "Setting up Laravel..."

# Cache configuration
if php artisan config:cache 2>/dev/null; then
    echo "✓ Configuration cached"
else
    echo "⚠ Config cache skipped"
fi

# Run migrations
echo "Running migrations..."
if php artisan migrate --force 2>&1; then
    echo "✓ Migrations completed"
else
    echo "⚠ Migrations failed (may be expected on first run)"
fi

echo ""
echo "========================================"
echo "Starting Apache on 0.0.0.0:$PORT"
echo "========================================"
echo ""

# Start Apache
exec apache2-foreground
STARTSCRIPT

# Make startup script executable
RUN chmod +x /start.sh

# Expose port
EXPOSE 80

# Start with our script
CMD ["/start.sh"]
