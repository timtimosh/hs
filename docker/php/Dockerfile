FROM php:7.4-fpm
ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug.so

RUN usermod -u ${GID} www-data