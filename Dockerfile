FROM php:8.0-apache

RUN docker-php-ext-install mysqli

ENTRYPOINT [ "/usr/sbin/apache2ctl", "-D", "FOREGROUND" ]