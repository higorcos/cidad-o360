# Stage 1: build frontend assets
FROM node:22-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# Stage 2: PHP app
FROM php:8.3-fpm-alpine AS app

RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    sqlite \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev

RUN docker-php-ext-install \
    pdo_sqlite \
    pcntl \
    bcmath \
    mbstring \
    zip \
    opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 755 storage bootstrap/cache

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]
