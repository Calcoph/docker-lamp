FROM php:7.2.2-apache
ADD php.ini /usr/local/etc/php/
ADD db_pass.txt /var/
ADD encr_pswd.txt /var/
RUN docker-php-ext-install mysqli
