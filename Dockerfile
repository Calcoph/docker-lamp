FROM php:7.2.2-apache
ADD php.ini /usr/local/etc/php/
ADD db_pass.txt /var/
ADD encr_pswd.txt /var/
RUN docker-php-ext-install mysqli

# sacado de https://www.baeldung.com/ops/docker-cron-job
#Install Cron
RUN apt-get update
RUN apt-get -y install cron

# Add the cron job
RUN crontab -l | { cat; echo "0,30 * * * * bash /home/web/bin/target/release/mantenimiento-bdd"; } | crontab -

# Run the command on container startup
CMD cron
