ARG NODE_VERSION=18.2.0
ARG PHP_VERSION=3.4.0

FROM node:${NODE_VERSION}-alpine as frontend

ARG NODE_REGISTRY=https://registry.npmmirror.com

WORKDIR /app
COPY . .

RUN npm install  --registry=${NODE_REGISTRY}

RUN npm run prod 

FROM trafex/php-nginx:${PHP_VERSION} as laravel
COPY --from=composer /usr/bin/composer /usr/bin/composer

USER root
RUN apk add --no-cache \
      php82-iconv \
      php82-simplexml \
      php82-zip \
      php82-pcntl \
      php82-sodium \
      php82-pdo \
      php82-pdo_mysql \
      php82-posix \
      php82-pecl-redis \
      php82-bcmath 


WORKDIR /var/www/html

COPY --from=frontend /app .
COPY docker/default.conf /etc/nginx/conf.d/default.conf
RUN chown -R nobody.nobody /var/www/html

USER nobody

RUN   composer install --optimize-autoloader --no-interaction --no-progress

