FROM dunglas/frankenphp

RUN install-php-extensions \
    pdo_mysql 

COPY ./Caddyfile /etc/caddy/Caddyfile

COPY ./public /app/public