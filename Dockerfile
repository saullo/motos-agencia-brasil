FROM php:apache

RUN apt update -y
RUN apt install -y libicu-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql intl

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite headers

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer self-update