FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# ✅ Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# ✅ Fix file permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# ✅ Laravel Cache Optimizations
RUN php artisan config:cache && php artisan route:cache

# Expose port 9000
EXPOSE 9000

# ✅ Set entrypoint to run migrations at runtime (not during build)
CMD php artisan migrate --force && php-fpm
