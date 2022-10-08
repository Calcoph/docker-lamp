FROM php:7.2.2-apache
ADD php.ini /usr/local/etc/php/
RUN mkdir /home/www-data
RUN chown www-data:www-data /home/www-data
RUN mkdir /home/www-data/uploads
RUN chown www-data:www-data /home/www-data/uploads
RUN docker-php-ext-install mysqli