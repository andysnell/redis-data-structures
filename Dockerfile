FROM php:8.0-cli

LABEL org.opencontainers.image.vendor="WickedByte LLC"
LABEL org.opencontainers.image.authors="Andy Snell <andy@wickedbyte.com>"
LABEL org.opencontainers.image.licenses="MIT"
LABEL org.opencontainers.image.title="Redis Data Structures PHP Runtime"
LABEL org.opencontainers.image.description="PHP 8.0 (cli) for 'More Than a Cache: Redis Data Structures' Examples"
LABEL org.opencontainers.image.source="https://github.com/andysnell/redis-data-structures"
LABEL org.opencontainers.image.version="0.0.1"

WORKDIR /app

ENV COMPOSER_HOME /composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV PATH /composer/vendor/bin:$PATH
ENV PHP_CONF_DIR=/usr/local/etc/php/conf.d

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    apt-transport-https \
    autoconf  \
    build-essential \
    libzip-dev \
    pkg-config \
    redis-tools \
    unzip \
    zip \
    zlib1g-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install redis-5.3.4 && docker-php-ext-enable redis