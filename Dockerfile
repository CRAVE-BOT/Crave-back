FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    npm \
    nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy files
COPY . .

# Install Laravel backend
RUN composer install --no-dev --optimize-autoloader

# Copy env file and generate app key
RUN cp .env.example .env
RUN php artisan key:generate

# Cache config
RUN php artisan config:cache



# Build frontend using Vite
RUN npm install
RUN npm run build

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www

# Expose port
EXPOSE 8000

# Start Laravel server
CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8000
