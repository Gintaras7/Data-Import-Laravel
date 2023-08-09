FROM php:8.2-apache

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y libzip-dev libxml2-dev libfreetype6-dev libjpeg-dev libpng-dev libonig-dev \
  && docker-php-ext-install pdo_mysql mysqli mbstring gd iconv soap zip \
  && apt-get install -y mc \
  && apt-get install -y wget \
  && apt-get install -y mariadb-client \
  && apt-get install -y git \
  && apt-get install -y bzip2 \
  && apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file \
  && apt-get install -y gnupg \
  && pecl install mcrypt-1.0.6 ast \ 
  && docker-php-ext-enable mcrypt ast

RUN a2enmod rewrite
ADD 000-default.conf /etc/apache2/sites-available/

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN composer self-update --2

ENV PATH="/var/www/simple-project/composer/vendor/bin:${PATH}"
RUN export PATH=$PATH:/var/www/simple-project/composer/vendor/bin

ENV TERM=xterm

ENV NVM_DIR="$HOME/.nvm"

WORKDIR /var/www/todo

RUN mkdir public

RUN rm -rf /var/www/html