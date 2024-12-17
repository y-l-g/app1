FROM dunglas/frankenphp

RUN install-php-extensions \
    pdo_mysql

RUN apt-get install -y nano

COPY ./Caddyfile /etc/caddy/Caddyfile

COPY ./public /app/public