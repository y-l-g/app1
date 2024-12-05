FROM dunglas/frankenphp

RUN install-php-extensions \
    pdo_mysql 

COPY ./Caddyfile /etc/caddy/caddyfile

COPY ./public /app/public