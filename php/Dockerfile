FROM php:7.1-fpm
MAINTAINER Filipe Shigueru <filipe.shigueru@yahoo.com.br>

RUN apt-get update

RUN apt-get install vim -y

RUN apt-get install nodejs -y

RUN apt-get install npm -y

RUN apt-get install git -y

# Some basic extensions
RUN docker-php-ext-install -j$(nproc) json mbstring opcache pdo pdo_mysql mysqli

RUN apt-get install mysql-client -y

# Curl
RUN apt-get install -y libcurl4-openssl-dev
RUN docker-php-ext-install -j$(nproc) curl

# GD
RUN apt-get install -y libpng-dev libjpeg-dev
RUN docker-php-ext-install -j$(nproc) gd

# Intl
RUN apt-get install -y libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer