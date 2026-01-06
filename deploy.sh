#!/bin/bash

echo "🚀 Starting Railway Deployment..."

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
until php artisan db:show 2>/dev/null; do
    echo "Database not ready, waiting..."
    sleep 2
done

echo "✅ Database connected!"

# Run migrations
echo "📦 Running database migrations..."
php artisan migrate --force

# Seed database if tables are empty
echo "🌱 Checking if database needs seeding..."
BOOK_COUNT=$(php artisan tinker --execute="echo \App\Models\Book::count();")
if [ "$BOOK_COUNT" -eq "0" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force
else
    echo "✅ Database already seeded ($BOOK_COUNT books found)"
fi

# Clear and cache config
echo "⚙️ Optimizing application..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if not exists
if [ ! -L public/storage ]; then
    echo "🔗 Creating storage symlink..."
    php artisan storage:link
fi

echo "✅ Deployment complete!"
echo "🎉 Paper Haven is ready!"
