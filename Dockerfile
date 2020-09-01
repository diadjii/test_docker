
FROM composer:2.0 as composer

WORKDIR /app

COPY ./composer.* /app/

RUN composer install

COPY . /app

FROM php:7.4

WORKDIR /app

COPY --from=composer /app .


EXPOSE 1997

CMD php -S localhost:1997 -t public/
