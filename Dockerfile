
# Use an official PHP image as a base
FROM php:7.4-apache

LABEL org.opencontainers.image.source="https://github.com/nishaurao/listdata.git"


# Install the MySQLi extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install required dependencies
RUN apt-get update && \
    apt-get install -y wget unzip && \
    wget https://getcomposer.org/installer -O composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php



# Install PHPUnit globally
RUN composer global require phpunit/phpunit

# Add Composer global bin directory to PATH
ENV PATH="${PATH}:/root/.composer/vendor/bin"



# Restart Apache to apply changes
RUN service apache2 restart

# Copy your application code into the container
COPY ./src /var/www/html



