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

# Configure Apache to listen on PORT environment variable
RUN echo 'Listen ${PORT:-80}' > /etc/apache2/ports.conf

# Configure Apache VirtualHost to use PORT
RUN echo '<VirtualHost *:${PORT:-80}>\n\
    ServerAdmin admin@paperhaven.com\n\
    DocumentRoot /var/www/html/public\n\
    \n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    \n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Enable the site
RUN a2ensite 000-default

# Create startup script
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
echo "========================================"\n\
echo "Starting Paper Haven Bookstore"\n\
echo "========================================"\n\
echo "PORT is set to: ${PORT:-80}"\n\
echo ""\n\
\n\
# Cache configuration\n\
echo "Caching configuration..."\n\
php artisan config:cache\n\
\n\
# Run migrations\n\
echo "Running migrations..."\n\
php artisan migrate --force\n\
\n\
echo ""\n\
echo "Starting Apache on port ${PORT:-80}..."\n\
echo "========================================"\n\
\n\
# Start Apache\n\
exec apache2-foreground' > /start.sh && chmod +x /start.sh

# Expose port
EXPOSE ${PORT:-80}

RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf

# Start Apache with startup script
CMD ["/start.sh"]
