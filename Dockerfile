FROM php:7.2.2-apache
ADD php.ini /usr/local/etc/php/
ADD db_pass.txt /var/
ADD encr_pswd.txt /var/
RUN docker-php-ext-install mysqli
RUN mkdir /etc/apache2/ssl
ADD cert3.pem /etc/apache2/ssl/
ADD key.pem /etc/apache2/ssl/
RUN rm /etc/apache2/sites-available/default-ssl.conf
ADD default-ssl.conf /etc/apache2/sites-available
RUN a2ensite default-ssl
RUN a2enmod ssl
RUN a2enmod headers
RUN service apache2 restart

# sacado de https://www.baeldung.com/ops/docker-cron-job
#Install Cron
RUN apt-get update
RUN apt-get -y install cron

# Add the cron job
RUN echo "0,30 * * * * /home/web/bin/target/release/mantenimiento-bdd" >> /etc/crontab
