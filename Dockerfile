



FROM composer:2.0 as composer

RUN rm -rf /var/www/ && mkdir /var/wwww
WORKDIR /var/www

COPY composer.* /var/www/

RUN composer install



FROM php:7.4-fpm as base

WORKDIR /var/www

ARG APP_ENV=prod
ARG APP_DEBUG=0

COPY . .

ENV APP_ENV $APP_ENV
ENV APP_DEBUG $APP_DEBUG

COPY --from=composer /var/www/ .

CMD [ "php-fpm" ]

FROM nginx

COPY --from=base  /var/www/ /var/www/html

COPY docker/nginx/default.conf /etc/nginx/conf.d
