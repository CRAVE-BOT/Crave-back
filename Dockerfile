FROM php:8.3-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libonig-dev libxml2-dev

# NodeJS
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Work directory
WORKDIR /var/www

# Copy files
COPY . .

# Install backend dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www

# Expose port
EXPOSE 8000

# Start app
CMD php artisan storage:link && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=8000
