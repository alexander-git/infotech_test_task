FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    zlib-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    curl \
    bash \
  && docker-php-ext-install pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/application

CMD ["php-fpm"]
