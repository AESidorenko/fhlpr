FROM php:8.1-fpm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY . /code

WORKDIR /code

RUN apt-get update && apt-get install -y \
      git \
      unzip \
    && composer install
