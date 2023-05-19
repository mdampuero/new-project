FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    zlib1g-dev \
    nano \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    gnupg \
    build-essential \
    libssl-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libzip-dev \
    zip

#In this place you can specify all the extensions you need.
RUN docker-php-ext-install \
    pdo_mysql \
    mysqli \
    gd \
    mbstring \
    zip


COPY --from=composer:2.0.9 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www