FROM php:7.3-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY public/ /var/www/html/
# VOLUME /var/www/html  # uncomment to use host files instead of those in the image

EXPOSE 80
