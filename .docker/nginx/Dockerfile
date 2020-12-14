ARG NGINX_VERSION
FROM nginx:$NGINX_VERSION-alpine
WORKDIR /var/www

RUN apk add --no-cache openssl

RUN rm /etc/nginx/conf.d/default.conf

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

#COPY ./nginx.conf /etc/nginx/conf.d -> esta config esta sendo feita pelo template do dockerize