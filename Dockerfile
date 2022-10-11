FROM php:7.2.2-apache
ADD php.ini /usr/local/etc/php/
RUN docker-php-ext-install mysqli
