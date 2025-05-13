# Stage 1: Build frontend assets
FROM node:lts AS nodebuild

WORKDIR /app
COPY . .
RUN npm install && npm run build


# Stage 2: Build PHP/Laravel app
FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev unzip libonig-dev libxml2-dev \
    libcurl4-openssl-dev libjpeg-dev libpng-dev libwebp-dev \
    libfreetype6-dev autoconf pkg-config libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql bcmath curl xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy source code
COPY . .

# Copy built frontend assets
COPY --from=nodebuild /app/public /var/www/html/public

# Install PHP dependencies and optimize Laravel
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

CMD ["php-fpm"]
