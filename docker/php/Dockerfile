ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm-alpine

# git - for composer
# tzdata - for set timezone from TZ environment variable
RUN apk add --no-cache git tzdata

# NPM
RUN apk add --no-cache npm

# PHP
COPY ./conf.d/custom.ini /usr/local/etc/php/conf.d/
RUN docker-php-ext-install mysqli

# XDEBUG
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN apk del -f .build-deps
ARG XDEBUG_CLIENT_PORT
ARG XDEBUG_IDEKEY
RUN echo 'xdebug.mode=develop,debug' >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo 'xdebug.start_with_request=1' >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo 'xdebug.remote_handler=dbgp' >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo 'xdebug.discover_client_host=1' >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo 'xdebug.client_host=host.docker.internal' >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo -e "xdebug.client_port=${XDEBUG_CLIENT_PORT}" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo -e "xdebug.idekey=$XDEBUG_IDEKEY" >> /usr/local/etc/php/conf.d/xdebug.ini

# COMPOSER
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
