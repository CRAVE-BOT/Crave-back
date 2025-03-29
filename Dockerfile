FROM php:8.3-fpm

# 1️⃣ Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    gnupg

# 2️⃣ Install Node.js 18 manually
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# 3️⃣ Verify Node & npm versions
RUN node -v && npm -v

# 4️⃣ Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 5️⃣ Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6️⃣ Set working directory
WORKDIR /var/www

# 7️⃣ Copy project files
COPY . .

# 8️⃣ Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# 9️⃣ Install Node modules & build assets
RUN npm install && npm run build

# 🔟 Set correct permissions
RUN chown -R www-data:www-data /var/www

# 🔁 Link storage to public folder
RUN php artisan storage:link

# 🌐 Expose port
EXPOSE 8000

# 🚀 Start the Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
