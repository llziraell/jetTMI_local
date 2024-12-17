FROM php:8.3-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    libonig-dev \
    zip \
    unzip \
    curl \
    git \
    gnupg \
    nodejs \
    npm \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        intl \
        zip \
        pgsql \
        pdo_pgsql \
        exif \
        mbstring \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug pgsql pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y netcat-openbsd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./ ./

RUN rm -r vendor

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

RUN cp .env.example .env

RUN php artisan key:generate

RUN npm install \
    && npm run build
#    && npm prune --production

RUN chmod +x /var/www/html/entrypoint.sh

RUN php artisan migrate:fresh --seed

EXPOSE 9000 5173

CMD ["/var/www/html/entrypoint.sh"]
