FROM php:7.2.19-fpm-alpine3.10
WORKDIR /var/www

RUN apk add --no-cache shadow openssl bash mysql-client libpng-dev git
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install gd
RUN docker-php-ext-install mysqli

#ativando o xdebug
RUN apk add --no-cache $PHPIZE_DEPS
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo "xdebug.remote_enable=On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart=On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_host=127.0.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port = 9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www
RUN rm -rf /var/www/html

RUN usermod -u 1000 www-data

RUN ln -s public html

USER www-data

EXPOSE 9000
