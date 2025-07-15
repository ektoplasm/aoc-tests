FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && \
    apt-get install git unzip -y --no-install-recommends && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . ./

RUN composer install --no-interaction --no-scripts --prefer-dist