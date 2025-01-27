FROM php:8.2-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y zip unzip git curl

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Instala extensões do PHP
RUN docker-php-ext-install pdo pdo_mysql

# Habilita o módulo rewrite do Apache
RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/desafio

COPY . /var/www/desafio

RUN composer install

RUN composer dump-autoload

RUN chown -R www-data:www-data /var/www/desafio && chmod -R 755 /var/www/desafio

ENV DOCKERIZE_VERSION v0.9.2

RUN apt-get update \
    && apt-get install -y wget \
    && wget -O - https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz | tar xzf - -C /usr/local/bin \
    && apt-get autoremove -yqq --purge wget && rm -rf /var/lib/apt/lists/*

EXPOSE 80
