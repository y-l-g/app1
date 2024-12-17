FROM dunglas/frankenphp

RUN install-php-extensions \
    pdo_mysql

RUN apt update
RUN apt install -y nano

COPY ./Caddyfile /etc/caddy/Caddyfile

COPY ./public /app/public