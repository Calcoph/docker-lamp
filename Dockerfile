FROM php:7.2.2-apache
ADD php.ini /usr/local/etc/php/
RUN mkdir /home/www-data
RUN chown www-data:www-data /home/www-data
RUN docker-php-ext-install mysqli
