 FROM php:8.3-fpm
 
 # 1️⃣ Install system dependencies
 # Install system dependencies
 RUN apt-get update && apt-get install -y \
     git \
     curl \
 @@ -9,37 +9,38 @@ RUN apt-get update && apt-get install -y \
     libonig-dev \
     libxml2-dev \
     zip \
     unzip \
     nodejs \
     npm
     unzip
 
 # 🧠 Node.js + npm في بعض الصور ما بتكونش حديثة، الأفضل نثبّت manual:
 # 🟢 Install Node.js 18 manually (عشان apt القديم)
 RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
     apt-get install -y nodejs
 
 # 2️⃣ Install PHP extensions
 # 🟢 Verify versions
 RUN node -v && npm -v
 
 # Install PHP extensions
 RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
 
 # 3️⃣ Install Composer
 # Install Composer
 COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 
 # 4️⃣ Set working directory
 # Set working directory
 WORKDIR /var/www
 
 # 5️⃣ Copy project files
 # Copy files
 COPY . .
 
 # 6️⃣ Install Laravel dependencies
 # Install Laravel backend
 RUN composer install --no-dev --optimize-autoloader
 
 # 7️⃣ Install Node modules & Build assets
 # ✅ Install Node modules & build Vite
 RUN npm install && npm run build
 
 # 8️⃣ Set correct permissions
 # Set permissions
 RUN chown -R www-data:www-data /var/www
 
 # 9️⃣ Expose port
 # Expose port
 EXPOSE 8000
 
 # 🔟 Start Laravel server
 # Start the server
 CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8000
