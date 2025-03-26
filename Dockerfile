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
    unzip

# 🟢 Install Node.js 18 manually (عشان apt القديم)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# 🟢 Verify versions
RUN node -v && npm -v

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

# ✅ Install Node modules & build Vite
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port
EXPOSE 8000

# Start the server
CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8000
