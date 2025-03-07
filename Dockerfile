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
    && docker-php-ext-install pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# ✅ Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# ✅ Run Laravel cache optimizations
RUN php artisan config:cache && php artisan route:cache

# ✅ Fix file permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# ✅ Run database migrations automatically
RUN php artisan migrate --force

# ✅ Optionally seed the database (if you have a seeder)
RUN php artisan db:seed --force

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
