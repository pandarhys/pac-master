FROM php:7.4.12-fpm-alpine

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
        sed -i -e "s/^ *memory_limit.*/memory_limit = 4G/g" /usr/local/etc/php/php.ini && \
        sed -i -e "s/^ *upload_max_filesize .*/upload_max_filesize  = 4G/g" /usr/local/etc/php/php.ini && \
        sed -i -e "s/^ *post_max_size .*/post_max_size  = 4G/g" /usr/local/etc/php/php.ini

RUN mkdir -p /var/www/html

RUN apk --no-cache add shadow && usermod -u 1000 www-data

RUN docker-php-ext-install pdo pdo_mysql

ADD  https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions imagick