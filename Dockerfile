FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .
RUN composer install --optimize-autoloader --no-dev

RUN chown -R www-data:www-data storage bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=$PORT
