FROM php:8.4-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential libpng-dev \
    libonig-dev libxml2-dev \
    zip unzip \
    git curl libzip-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN curl -sL https://deb.nodesource.com/setup_22.x | bash -
RUN apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www

RUN composer install --optimize-autoloader --no-dev

RUN npm install 
RUN npm run build

RUN chown -R www-data:www-data /var/www/
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000

CMD [ "php-fpm" ]