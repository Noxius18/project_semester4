FROM php:8.4-fpm

RUN apt-get update && apt-get upgrade -y

RUN apt-get update && \
    apt-get install -y \
    libzip-dev unzip \
    libonig-dev libxml2-dev \
    libcurl4-openssl-dev libjpeg-dev \
    libpng-dev libwebp-dev \
    libfreetype6-dev autoconf \
    pkg-config libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    pdo pdo_mysql \
    bcmath curl \
    xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

CMD [ "php-fpm" ]