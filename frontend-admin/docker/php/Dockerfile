FROM php:8.1-fpm

COPY . /code

WORKDIR /code

RUN apt-get update && apt-get install -y \
      git \
      unzip \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer install
