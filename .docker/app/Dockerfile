FROM php:8.1-fpm

WORKDIR /app

ARG USERNAME=carmataxi
ARG USERID=1000
ARG USERGROUPNAME=carmataxi
ARG USERGROUPID=1000

RUN groupadd -g $USERGROUPID -o $USERGROUPNAME &&\
    useradd -m -u $USERID -g $USERGROUPID -o -s /bin/bash $USERNAME &&\
    usermod -aG sudo $USERNAME

RUN apt-get update &&\
    apt-get install -y libzip-dev &&\
    apt-get install -y gnupg2 &&\
    apt-get install -y libpng-dev libfreetype6-dev libjpeg62-turbo-dev &&\
    apt-get install -y --no-install-recommends supervisor &&\
    apt-get install -y default-mysql-client

RUN chgrp -R $USERGROUPNAME /var/log &&\
    chmod -R g+w /var/log

RUN docker-php-ext-install zip &&\
    docker-php-ext-install pdo_mysql &&\
    docker-php-ext-configure gd --with-freetype --with-jpeg &&\
    docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

