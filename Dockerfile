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
    nodejs \
    npm

# 🧠 Node.js + npm في بعض الصور ما بتكونش حديثة، الأفضل نثبّت manual:
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# 2️⃣ Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 3️⃣ Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4️⃣ Set working directory
WORKDIR /var/www

# 5️⃣ Copy project files
COPY . .

# 6️⃣ Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# 7️⃣ Install Node modules & Build assets
RUN npm install && npm run build

# 8️⃣ Set correct permissions
RUN chown -R www-data:www-data /var/www

# 9️⃣ Expose port
EXPOSE 8000

# 🔟 Start Laravel server
CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8000
