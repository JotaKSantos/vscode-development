ARG PHP_VERSION
FROM php:$PHP_VERSION-fpm-alpine
WORKDIR /var/www

RUN apk add --no-cache shadow openssl bash mysql-client libpng-dev libpng zlib \
freetype libjpeg-turbo freetype-dev libjpeg-turbo-dev libwebp-dev

RUN docker-php-ext-install pdo pdo_mysql
#RUN docker-php-ext-install gd 
RUN docker-php-ext-install mysqli
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp; \
  docker-php-ext-install gd 

#ativando o xdebug
RUN apk add --no-cache $PHPIZE_DEPS
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo "xdebug.remote_enable=On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart=On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_host=127.0.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port = 9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apk add --no-cache --virtual .build-deps g++ make autoconf yaml-dev
RUN pecl install igbinary-3.1.2 \
pecl install redis-5.1.1
RUN docker-php-ext-enable igbinary.so
RUN docker-php-ext-enable redis.so
RUN apk del --purge .build-deps
ADD redis.ini /usr/local/etc/php/conf.d/redis.ini

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
