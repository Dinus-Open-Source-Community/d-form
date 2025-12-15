# Gunakan base image PHP 8.2 FPM
FROM php:8.2-fpm

# Install dependencies dasar untuk Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (ambil langsung dari image composer resmi)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set direktori kerja di dalam container
WORKDIR /var/www/html

# Copy file composer untuk caching dependency layer
COPY composer.json composer.lock ./

# Install dependency PHP (vendor)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy seluruh file proyek Laravel ke container
COPY . .

# Pastikan direktori penting Laravel tersedia
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache

# Atur permission supaya Laravel bisa menulis log & cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Jalankan perintah artisan jika dibutuhkan (optional)
# RUN php artisan key:generate || true

# Expose port PHP-FPM
EXPOSE 9000

# Jalankan PHP-FPM sebagai entrypoint
CMD ["php-fpm"]
