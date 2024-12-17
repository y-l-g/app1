FROM dunglas/frankenphp

RUN install-php-extensions \
    pdo_mysql

RUN apk update
RUN apk add nano

COPY ./Caddyfile /etc/caddy/Caddyfile

COPY ./public /app/public