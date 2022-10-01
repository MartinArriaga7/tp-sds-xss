FROM php:8.0.0rc1-fpm

RUN docker-php-ext-install mysqli

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www